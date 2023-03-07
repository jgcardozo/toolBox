<?php

namespace App\Classes;

use App\Classes\Eds;
use App\Models\Domain;
use Illuminate\Support\Facades\Storage;

class FtpServers
{
    private $typeServer, $conn, $domain_id;
    private $workingDir = "/site/wwwroot/";


    public function connect($domain_id)
    {
        extract(Domain::where('id', $domain_id)->first()->toArray());
        $this->conn = ftp_connect($ftp_url) or die("Couldn't connect to $name trying to create in index");
        $login = ftp_login($this->conn, $ftp_user, Eds::decryption($ftp_password));
        ftp_pasv($this->conn, true);
        ftp_chdir($this->conn, $this->workingDir);
        $this->typeServer = $type;
        $this->domain_id = $domain_id;
        return $this->conn;
    } //connect

    /*public function setDomain(int $domain_id)
    {
    $this->domain_id = $domain_id;
    } */

    public function aliasExists($domain_id, $alias, $long_url)
    {
        $conn = $this->connect($domain_id);
        $list = str_replace($this->workingDir, '', ftp_nlist($conn, $this->workingDir));


        if ($this->typeServer == 'Nginx') {
            if (in_array($alias, $list)) {
                return true;  // si existe /alias 
            }else{
                ftp_mkdir($this->conn, $alias);
                $this->createUpdateAlias($alias, $long_url); 
            }
            
        }//nginx

        if ($this->typeServer == 'Apache') {
            $conn = $this->connect($domain_id);
            $domain_name = Domain::where('id', $domain_id)->first()->name;
            $filename = ".htaccess";
            $backup_folder = "Apache/" . $domain_name;
            $backup_file = Storage::disk('local')->path($backup_folder . '/' . $filename);
            $remote_file = $this->workingDir . $filename;

            if (!file_exists($backup_file)) {
                Storage::makeDirectory($backup_folder, 0777, true);
                ftp_get($conn, $backup_file, $remote_file, FTP_ASCII);
            }

            $local_file = Storage::disk('local')->path("Apache/area-staging/$filename");
            if (ftp_get($conn, $local_file, $remote_file, FTP_ASCII)) {
                $content = file($local_file);
            } //ftp_get

            if (count($content) > 0) {
                foreach ($content as $line_num => $lineText) {
                    if (strpos($lineText, 'Redirect') !== false) {
                        $pieces = explode(" ", $lineText);
                        if (strtolower($pieces[2]) == strtolower("/$alias")) {
                            return true; //"this redirect already exists: /$alias";
                        } else {
                            $this->createUpdateAlias($alias, $long_url);
                        }
                    } //only redirects
                } //for
            } //if $content

        } //apache

    } //aliasExists


    public function createUpdateAlias($alias, $long_url)
    {
        if ($this->typeServer == 'Nginx') {
            $content = "<script>window.location.href = '" . $long_url . "';</script>";
            $filename = "index.php";
            Storage::disk('local')->put($filename, $content);
            $local_file = Storage::disk('local')->path($filename);
            $remote_file = $this->workingDir . "$alias/$filename";
            ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
        }

        if ($this->typeServer == 'Apache') {  
            $aliasArray = [];
            array_push($aliasArray, "/" . strtolower($alias));
            array_push($aliasArray, "/" . strtoupper($alias));
            array_push($aliasArray, "/" . ucfirst($alias));

            $newRedirect = "";
            $filename = ".htaccess";
            foreach ($aliasArray as $eachVariant) {
                // Redirect 302 /quizmas https://quizfunnel.com/quizmas/intro
                $newRedirect = "Redirect 302 $eachVariant $long_url"; //.PHP_EOL;
                Storage::disk('local')->append("Apache/area-staging/$filename", $newRedirect);
            } //forEach-Variant
            $local_file = Storage::disk('local')->path("Apache/area-staging/$filename");
            $remote_file = $this->workingDir . $filename;
            //ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
            dd("llego ok");
        } //apache

    } //createUpdateAlias

    public function deleteAlias($domain_id, $alias)
    {
        $conn = $this->connect($domain_id);
        $filename = "index.php";
        if (ftp_delete($this->conn, "$alias/$filename")) {
            ftp_rmdir($this->conn, $alias);
        }
    }


    public function close()
    {
        ftp_close($this->conn);
    }



    //////////////////////////7



    public function listMyFile()
    {

    } // func listMyFile

} //class
