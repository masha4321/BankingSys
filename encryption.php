<?php

//Encryption/decryption based on passed string
function encrypt_decrypt($action, $string)
{
    $output = false;
    $encrypt_method = "AES-128-CTR";
    $secret_key = 'GeeksforGeeks';
    $secret_iv = '1234567891011121';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes 
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
