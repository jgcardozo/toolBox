<?php

namespace App\Classes;

/*
Eds: Encryption and Decryption System
Juan.cardozo@ideaware.co
2022-01-20
*/

define('METHOD', 'AES-256-CBC');
define('SECRET_KEY', '$ideaware@asK!*!IWju4nC4rd0z0');
define('SECRET_IV', '101712');

class Eds
{

    public static function encryption(string $text)
    {
        $output = false;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($text, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function decryption(string $text)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($text), METHOD, $key, 0, $iv);
        return $output;
    }

} //class