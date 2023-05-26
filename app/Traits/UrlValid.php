<?php

namespace App\Traits;

//https://stackoverflow.com/questions/1239068/ping-site-and-return-result-in-php
trait UrlValid
{
    public function urlValid($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 0 || $httpcode == 404) {
            return false;
        } else {
            return true;
        }

    } //urlValid





} //trait