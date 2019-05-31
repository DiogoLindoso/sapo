<?php
namespace App\Lib;
class CurlRequest{
    private $ch;
    private $status;
    function __construct(){
        $this->ch=curl_init();
    }    
    public function request($url,$post_data=null){
        
        $this->url=$url;
        $this->post_data=$post_data;
        if(isset($this->post_data)){
            curl_setopt_array($this->ch,[
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => urldecode(http_build_query($this->post_data))
            ]);
        }
            curl_setopt_array($this->ch,[
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_COOKIESESSION => 1,
                CURLOPT_COOKIEFILE => 'cookie.txt',
                CURLOPT_COOKIEJAR => 'cookie.txt',
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_FOLLOWLOCATION => 1
            ]);
        $response = curl_exec($this->ch);
        $this->status = curl_getinfo($this->ch);
        $this->status['curl_erro'] = curl_error($this->ch);

        usleep(200000);
        return $response;
    }
    public function getStatus(){
        return $this->status;
    }
}
?>