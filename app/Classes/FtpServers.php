<?php

namespace App\Classes;

use App\Classes\Eds;
use App\Models\Link;
use App\Models\Domain;
use App\Traits\UrlValid;
use App\Models\ClosePage;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;

class FtpServers
{
    use UrlValid;
    private $typeServer, $conn, $domain_id, $login;
    private $workingDir = "/site/wwwroot/";
    private $local_file;


    public function connect($domain_id)
    {
        extract(Domain::where('id', $domain_id)->first()->toArray());
        $this->conn = ftp_ssl_connect($ftp_url) or die("Couldn't connect to $name ");
        $this->login = ftp_login($this->conn, $ftp_user, Eds::decryption($ftp_password));
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


    public function aliasExists($domain_id, $alias, $long_url)
    {
        $this->connect($domain_id);
        $domain_name = Domain::where('id', $domain_id)->first()->name;

        if ($this->typeServer == 'Nginx') {
            $list = str_replace($this->workingDir, '', ftp_nlist($this->conn, $this->workingDir));
            //dd($list);
            if (in_array($alias, $list)) { //!
                return true; // si existe /alias 
                exit;
            }
        } //nginx


        if ($this->typeServer == 'Apache') {
            $filename = ".htaccess";
            $remote_file = $this->workingDir . $filename;
            $pathApacheStage = "Apache/area-staging/$domain_name";
            $local_file = Storage::disk('local')->path("$pathApacheStage/$filename");

            if (!file_exists($pathApacheStage)) {
                Storage::makeDirectory($pathApacheStage, 0777, true);
            }

            if (ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII)) {
                $content = file($local_file);
            } //ftp_get

            if (count($content) > 0) {
                foreach ($content as $line_num => $lineText) {
                    if (strpos($lineText, 'Redirect') !== false && strpos($lineText, '#') === false) {
                        //if (strpos($lineText, 'Redirect') !== false) {
                        $pieces = explode(" ", $lineText);
                        //dd($pieces[2]);
                        if (array_key_exists(2, $pieces)) {
                            $pieza = $pieces[2];
                            if ($pieza == "/" . strtolower($alias)) {
                                return true;
                                exit;
                            } // if exists as piece
                        }
                    } //onlyRedirect
                } //forEach
            } //if $content
        } //apache

    } //aliasExists


    public function crudAlias($alias, $long_url, $domain_id, $action)
    {
        $this->connect($domain_id);
        $domain_name = Domain::where('id', $domain_id)->first()->name;

        if ($this->typeServer == 'Nginx') {
            $filename = "index.php";
            //backupStart
            $pathNginx = "Nginx/$domain_name/$alias";
            if (!file_exists($pathNginx)) {
                Storage::makeDirectory($pathNginx, 0777, true);
            }
            //backupEnd

            // https://hybridexpert.com/hyb-int-0423/wb-1-f-rg/v2/?test=erick  alias workshop
            $content = '<?php
            $params =  "/?".http_build_query($_GET);
            $long_url = "' . $long_url . '";
            if(strlen($params)>2){
                $long_url = $long_url . $params;
            }
            header("Location: $long_url");
            exit;
            ?>';
            $content2 = "<?php header('Location: " . $long_url . "'); exit; ?>";
            if ($action == 'create') {
                ftp_mkdir($this->conn, $alias);
            }
            if ($action != 'delete') { //means it's create or update
                Storage::disk('local')->put("$pathNginx/$filename", $content); //$filename
                $local_file = Storage::disk('local')->path("$pathNginx/$filename");
                $remote_file = $this->workingDir . "$alias/$filename";
                @ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
            }
            if ($action == 'delete') {
                if (ftp_delete($this->conn, "$alias/$filename")) {
                    ftp_rmdir($this->conn, $alias);
                }
            }
        } //nginxCases

        if ($this->typeServer == 'Apache') {

            $filename = ".htaccess";
            $pathApacheStage = "Apache/area-staging/$domain_name/$filename";
            $local_file = Storage::disk('local')->path($pathApacheStage);
            $remote_file = $this->workingDir . $filename;

            //backupStart
            $backup_folder = "Apache/" . $domain_name;
            $backup_file = Storage::disk('local')->path($backup_folder . '/' . $filename);
            if (!file_exists($backup_file)) {
                Storage::makeDirectory($backup_folder, 0777, true);
            }
            ftp_get($this->conn, $backup_file, $remote_file, FTP_ASCII);
            //backupEnd

            if ($action == 'create') {
                $aliasArray = [];
                $newRedirect = "";
                array_push($aliasArray, "/" . strtolower($alias));
                array_push($aliasArray, "/" . strtoupper($alias));
                array_push($aliasArray, "/" . ucfirst($alias));

                foreach ($aliasArray as $eachVariant) {
                    $newRedirect = "Redirect 302 $eachVariant $long_url";
                    Storage::disk('local')->append($pathApacheStage, $newRedirect);
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

                $content = Storage::disk('local')->get($pathApacheStage);
                if (ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII)) {
                    $newContent = str_replace($arrSearch, $arrReplace, $content);
                    Storage::disk('local')->put($pathApacheStage, $newContent);
                }
            } //actionUpdateDelete
            @ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII);
        } //apacheCases

    } //crudAlias


    public function closePage($page)
    {
        if ($this->urlValid($page->url_page)) {
            $domain_name = Domain::where('id', $page->domain_id)->first()->name;
            $url_page = str_ireplace(['http://', 'https://', $page->domain_name . '/'], '', $page->url_page);
            $this->connect($page->domain_id);
            $filename = "index.php";
            $remote_file = $this->workingDir . $url_page . $filename;
            $path_closepages = "ClosePages/$domain_name";
            $local_file = Storage::disk('local')->path("$path_closepages/$filename");
            if (!file_exists($path_closepages)) {
                Storage::makeDirectory($path_closepages, 0777, true);
            }
            //juan-for-testing ftp_get($this->conn, $local_file, $remote_file, FTP_ASCII);
            $default_waitlist = "https://quizfunnelworkshop.com/notify/";
            $url_waitlist = isset($page->url_waitlist) && !empty($page->url_waitlist) ? $page->url_waitlist : $default_waitlist;
            $this->$local_file = $local_file;
            $this->deleteCode();

            $codeAmount =
                '<?php
                if (isset($_GET["t"]) && $_GET["t"]=="y") {
                    $amount = "1";
                }else{
                    $amount = "99";
                }
            ?>';
            $codeClose = '<!--start-script-->
            <?php
                #redirect
                if(!isset($_GET["test"])){
                header("HTTP/1.1 302 Moved Temporarily");
                header("' . $url_waitlist . '");
                die();
                }
            #end-redirect
            ?>
            <!--end-script-->';
            $allNewCode = $codeClose; // . PHP_EOL . $codeAmount;
            $code_old = file_get_contents($local_file);
            $code_new = $allNewCode . PHP_EOL . $code_old;
            file_put_contents($local_file, $code_new);

            $page->update([
                'done' => 1,
                'code_old' => $code_old,
                'code_new' => $code_new
            ]);

            $texto = "son las : " . date('Y-m-d H:i:s') . " " . $url_waitlist . " pageid=" . $page->id;
            Storage::append("comandos.txt", $texto);
            /*
            if (@ftp_put($this->conn, $remote_file, $local_file, FTP_ASCII)) { 
                $page->update([
                'done' => 1,
                'code_old' => $code_old, 
                'code_new' => $code_new
            ]);
            }//if ftp_put
            */

        } //if urlValid
        return true;
    } // closePage


    public function deleteCode()
    {
        $content = file_get_contents($this->local_file);
        $codeStartAt = strpos($content, '<!--start-script-->');
        $codeEndAt = strrpos($content, '<!--end-script-->');
        if ($codeStartAt !== false && $codeEndAt !== false) {
            $codeSearched = substr($content, $codeStartAt, ($codeEndAt - $codeStartAt));
            $newCode = str_replace($codeSearched . '<!--end-script-->', "", $content);
            file_put_contents($this->local_file, $newCode);
        }
    } // deleteCode






    public function htproceso($domain_name)
    {
        dd("htproceso using $domain_name now disabled");
        $filename = ".htaccess";
        $path = "htproceso/$filename"; //domain_name for real
        $local_file = Storage::disk('local')->path($path);
        //
        $filenameNew = "nuevo.htaccess";
        $pathNew = "htproceso/$filenameNew"; //domain_name for real
        //$pathFile = Storage::disk('local')->path($pathNew);

        if (file_get_contents($local_file)) {
            $content = file($local_file);
            $newArray = $arrCommented = []; // 1035  # 974 # 396sin variaciones
            foreach (Link::all() as $item) {
                array_push($newArray, '/' . $item['alias']);
            }
            foreach ($content as $lineNum => $lineText) {

                if (strpos($lineText, 'Redirect') === false && $lineText != "\r\n") {
                    Storage::disk('local')->append($pathNew, $lineText);
                }

                if (strpos($lineText, 'Redirect') !== false && strpos($lineText, '#') === false) {
                    $pieces = explode(" ", $lineText);
                    if (array_key_exists(2, $pieces)) {
                        $alias = strtolower($pieces[2]);
                        $long_url = $pieces[3];
                        ///studio-access  //ALTER TABLE links MODIFY alias VARCHAR(40) ;
                        if (!in_array($alias, $newArray)) {
                            array_push($newArray, $alias);
                            $newRedirect = "";
                            $newRedirect = "Redirect 302 $alias $long_url";
                            Storage::disk('local')->append($pathNew, $newRedirect);
                            //save into tb.links
                            $fields['domain_id'] = Domain::where('name', $domain_name)->first()->id;
                            $fields['user_id'] = 1;
                            $fields['alias'] = substr($alias, 1);
                            $fields['long_url'] = trim($long_url);
                            $fields['short_url'] = trim("http://$domain_name" . $alias);
                            $fields['created_at'] = "2023-01-01 23:39:53";
                            $fields['updated_at'] = "2023-01-01 23:39:53";
                            Link::create($fields);
                        } //sino existe ya el alias con sus variaciones, entonces lo crea
                    } //if piece2 exist
                } // if line is Redirect 

                if (strpos($lineText, 'Redirect') !== false && strpos($lineText, '#') !== false) {
                    array_push($arrCommented, $lineText); //61
                }
            } //forEach

            Storage::disk('local')->append($pathNew, PHP_EOL . PHP_EOL . PHP_EOL . "# REDIRECTS DISABLED MANUALLY #############################" . PHP_EOL);
            foreach ($arrCommented as $item) {
                Storage::disk('local')->append($pathNew, $item);
            } // foreach commented
            dd($newArray);
        } //ftp_get or file_get_contents


    } //htproccess


} //class
