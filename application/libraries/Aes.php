<?php

Class MyAES
{
 private $app_cc_aes_key;
 private $app_cc_aes_iv;

 function __construct()
 {
   $hash_string = 'cola-secret-key'; // 可以由外部帶入
   if(is_null($hash_string)) {
     return false;
   }
   $hash = hash('SHA384', $hash_string, true);
   $this->app_cc_aes_key = substr($hash, 0, 32);
   $this->app_cc_aes_iv = substr($hash, 32, 16);
 }

 public function encrypt($data)
 {
   return base64_encode(self::aes256_cbc_encrypt($data, $this->app_cc_aes_key, $this->app_cc_aes_iv));
 }

 // return false for failure
 public function decrypt($data)
 {
   return self::aes256_cbc_decrypt(base64_decode($data), $this->app_cc_aes_key, $this->app_cc_aes_iv);
 }

 // this for AES-256
 private function check_key_and_iv_len($key, $iv)
 {
   if(32 !== strlen($key)) {
     return false;
   }
   if(16 !== strlen($iv)) {
     return false;
   }

   return true;
 }

 private function aes256_cbc_encrypt($data, $key, $iv)
 {
   if(!self::check_key_and_iv_len($key, $iv)) {
     return false;
   }

   $padding = 16 - (strlen($data) % 16);
   $data .= str_repeat(chr($padding), $padding);
   return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
 }

 private function aes256_cbc_decrypt($data, $key, $iv)
 {
   if(!self::check_key_and_iv_len($key, $iv)) {
     return false;
   }

   $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
   $padding = ord($data[strlen($data) - 1]);
   return substr($data, 0, -$padding);
 }
}