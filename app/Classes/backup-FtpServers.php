<?php

namespace App\Classes;

use App\Classes\Eds;
use App\Models\Link;
use App\Models\Domain;
use Illuminate\Support\Facades\Storage;

class FtpServers
{
    private $typeServer, $conn, $domain_id, $login, $pass;
    private $workingDir = "/site/wwwroot/";


    public function connect($domain_id)
    {
        //dd(Domain::where('id', $domain_id)->first()->toArray());
        extract(Domain::where('id', $domain_id)->first()->toArray());
        $this->conn = ftp_ssl_connect($ftp_url) or die("Couldn't connect to $name trying to create in index");
        $this->login = ftp_login($this->conn, $ftp_user, Eds::decryption($ftp_password));
        $this->pass = Eds::decryption($ftp_password);
        ftp_pasv($this->conn, true);
        ftp_chdir($this->conn, $this->workingDir);
        $this->typeServer = $type;
        $this->domain_id = $domain_id;
        return $this->conn;
    } //connect

    public function close()
    {
        ftp_close($this->conn);
    } // close connection

    /*public function setDomain(int $domain_id)
    {
    $this->domain_id = $domain_id;
    } */

    public function aliasExists($domain_id, $alias, $long_url)
    {
        $this->connect($domain_id); //esta $conn

        dd("conn:".$this->conn." login:".$this->login." pass:".$this->pass);

        if ($this->typeServer == 'Nginx') {
            //$list = str_replace($this->workingDir, '', ftp_nlist($this->conn, $this->workingDir));
            $list = ftp_nlist($this->conn, $this->workingDir);

            if ($list) { //funciona con test.askmethod que es nginx, pq no con asktxt.me  ?
                if (in_array($alias, $list)) { //!
                    return true; // si existe /alias 
                    exit;
                }
            }

        } //nginx

        if ($this->typeServer == 'Apache') {
            $domain_name = Domain::where('id', $domain_id)->first()->name;
            $filename = ".htaccess";
            $backup_folder = "Apache/" . $domain_name;
            $backup_file = Storage::disk('local')->path($backup_folder . '/' . $filename);
            $remote_file = $this->workingDir . $filename;

            if (!file_exists($backup_file)) {
                Storage::makeDirectory($backup_folder, 0777, true);
                ftp_get($this->conn, $backup_file, $remote_file, FTP_ASCII);
            }

            $local_file = Storage::disk('local')->path("Apache/area-staging/$filename");
            if (ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII)) {
                $content = file($local_file);
            } //ftp_get

            if (count($content) > 0) {
                foreach ($content as $line_num => $lineText) {
                    if (strpos($lineText, "Redirect 302 /" . strtolower($alias)) !== false) {
                        return true;
                        exit;
                    }
                }
            } //if $content

        } //apache

    } //aliasExists


    public function crudAlias($alias, $long_url, $domain_id, $action)
    {
        $this->connect($domain_id);

        if ($this->typeServer == 'Nginx') {
            $filename = "index.php";
            $contentjs = "<script>window.location.href = '" . $long_url . "';</script>";
            $content = "<?php header('Location: " . $long_url . "'); exit; ?>";
            if ($action == 'create') {
                ftp_mkdir($this->conn, $alias);
            }
            if ($action != 'delete') { //means it's create or update
                Storage::disk('local')->put($filename, $content);
                $local_file = Storage::disk('local')->path($filename);
                $remote_file = $this->workingDir . "$alias/$filename";
                ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
            }
            if ($action == 'delete') {
                if (ftp_delete($this->conn, "$alias/$filename")) {
                    ftp_rmdir($this->conn, $alias);
                }
            }
        } //nginxCases

        if ($this->typeServer == 'Apache') {

            $filename = ".htaccess";
            $local_file = Storage::disk('local')->path("Apache/area-staging/$filename");
            $remote_file = $this->workingDir . $filename;

            if ($action == 'create') {
                $aliasArray = [];
                $newRedirect = "";
                array_push($aliasArray, "/" . strtolower($alias));
                array_push($aliasArray, "/" . strtoupper($alias));
                array_push($aliasArray, "/" . ucfirst($alias));

                foreach ($aliasArray as $eachVariant) {
                    $newRedirect = "Redirect 302 $eachVariant $long_url";
                    Storage::disk('local')->append("Apache/area-staging/$filename", $newRedirect);
                } //forEach-Variant
            }

            if ($action != 'create') { //means its delete or update

                if ($action == 'delete') {
                    $arrSearch = [
                        "Redirect 302 /" . strtolower($alias) . " $long_url",
                        "Redirect 302 /" . strtoupper($alias) . " $long_url",
                        "Redirect 302 /" . ucfirst($alias) . " $long_url",
                    ];
                    $arrReplace = "";
                }
                if ($action == 'update') {
                    $current_long_url = Link::where('alias', strtolower($alias))->first()->long_url;
                    $arrSearch = [
                        "Redirect 302 /" . strtolower($alias) . " $current_long_url",
                        "Redirect 302 /" . strtoupper($alias) . " $current_long_url",
                        "Redirect 302 /" . ucfirst($alias) . " $current_long_url",
                    ];
                    $arrReplace = [
                        "Redirect 302 /" . strtolower($alias) . " $long_url",
                        "Redirect 302 /" . strtoupper($alias) . " $long_url",
                        "Redirect 302 /" . ucfirst($alias) . " $long_url",
                    ];
                }

                $content = Storage::disk('local')->get("Apache/area-staging/$filename");
                if (ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII)) {
                    $newContent = str_replace($arrSearch, $arrReplace, $content);
                    Storage::disk('local')->put("Apache/area-staging/$filename", $newContent);
                }
            } //actionUpdateDelete
            ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
        } //apache

    } //crudAlias

    public function deleteAlias($domain_id, $alias, $long_url)
    {
        $this->connect($domain_id);
        if ($this->typeServer == 'Nginx') {
            $filename = "index.php";
            if (ftp_delete($this->conn, "$alias/$filename")) {
                ftp_rmdir($this->conn, $alias);
            }
        } //nginxDel

        if ($this->typeServer == 'Apache') {
            $filename = ".htaccess";
            $arrSearch = [
                "Redirect 302 /" . strtolower($alias) . " $long_url",
                "Redirect 302 /" . strtoupper($alias) . " $long_url",
                "Redirect 302 /" . ucfirst($alias) . " $long_url",
            ];
            $arrReplace = "";
            $content = Storage::disk('local')->get("Apache/area-staging/$filename");
            $local_file = Storage::disk('local')->path("Apache/area-staging/$filename");
            $remote_file = $this->workingDir . $filename;
            if (ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII)) {
                $newContent = str_replace($arrSearch, $arrReplace, $content);
                Storage::disk('local')->put("Apache/area-staging/$filename", $newContent);
            }
            ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
        } //apacheDel

    } //deleteAlias








} //class
