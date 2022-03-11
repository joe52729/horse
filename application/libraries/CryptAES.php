<?php
date_default_timezone_set('Asia/Taipei');
class CryptAES
{
    protected $cipher = MCRYPT_RIJNDAEL_128;
    protected $mode = MCRYPT_MODE_ECB;
    protected $pad_method = NULL;
    protected $secret_key = '';
    protected $iv = '';
 
    public function set_cipher($cipher)
    {
        $this->cipher = $cipher;
    }
 
    public function set_mode($mode)
    {
        $this->mode = $mode;
    }
 
    public function set_iv($iv)
    {
        $this->iv = $iv;
    }
 
    public function set_key($key)
    {
        $this->secret_key = $key;
    }
 
    public function require_pkcs5()
    {
        $this->pad_method = 'pkcs5';
    }
 
    protected function pad_or_unpad($str, $ext)
    {
        if ( is_null($this->pad_method) )
        {
            return $str;
        }
        else
        {
            $func_name = __CLASS__ . '::' . $this->pad_method . '_' . $ext . 'pad';
            if ( is_callable($func_name) )
            {
                $size = mcrypt_get_block_size($this->cipher, $this->mode);
                return call_user_func($func_name, $str, $size);
            }
        }
        return $str;
    }
 
    protected function pad($str)
    {
        return $this->pad_or_unpad($str, '');
    }
 
    protected function unpad($str)
    {
        return $this->pad_or_unpad($str, 'un');
    }
 
    public function encrypt($str)
    {
        $str = $this->pad($str);
        $td = mcrypt_module_open($this->cipher, '', $this->mode, '');
 
        if ( empty($this->iv) )
        {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        }
        else
        {
            $iv = $this->iv;
        }
 
        mcrypt_generic_init($td, $this->secret_key, $iv);
        $cyper_text = mcrypt_generic($td, $str);
        $rt=base64_encode($cyper_text);
        //$rt = bin2hex($cyper_text);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
 
        return $rt;
    }
 
    public function decrypt($str){
        $td = mcrypt_module_open($this->cipher, '', $this->mode, '');
 
        if ( empty($this->iv) )
        {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        }
        else
        {
            $iv = $this->iv;
        }
 
        mcrypt_generic_init($td, $this->secret_key, $iv);
        //$decrypted_text = mdecrypt_generic($td, self::hex2bin($str));
        $decrypted_text = mdecrypt_generic($td, base64_decode($str));
        $rt = $decrypted_text;
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
 
        return $this->unpad($rt);
    }
 
    public static function hex2bin($hexdata) {
        $bindata = '';
        $length = strlen($hexdata);
        for ($i=0; $i < $length; $i += 2)
        {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }
 
    public static function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
 
    public static function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }
}
// require_once("akiaes.php");
//ex:
// $keyStr = "gboaolld2014netN";//key
// $outacc = "lock_value";
// $aes = new CryptAES();
// $aes->set_key($keyStr);
// $aes->require_pkcs5();
// $encText = $aes->encrypt($outacc);//ADD
// $decString = $aes->decrypt($encText);//SOLVE
// echo $encText;


// /*裁切字串*/
// function cut_content($a,$b){
    // $a = strip_tags($a); //去除HTML標籤
    // $sub_content = mb_substr($a, 0, $b, 'UTF-8'); //擷取子字串
    // echo $sub_content;  //顯示處理後的摘要文字
    // /*下方超過顯示 "......"*/
    // if (strlen($a) > strlen($sub_content)) echo "...";
// }

//以上程式已經包裝起來,您可存放在例如:function.php網頁
//往後只要使用include("function.php");
//加上 cut_content($a,$b);即可,不需每次撰寫.
//$a代表欲裁切內容.
//$b代表欲裁切字數(字元數)
// cut_content($dbtype,"5");//使用方式
?>