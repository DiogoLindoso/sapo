<?php
namespace App\Lib;
class CurlRequest{
    private $ch;
    private $status;
    function __construct(){
        $this->ch=curl_init();
    }    
    public function request($url,$post_data=null){
        if(isset($post_data)){ //se receber o parametro $post_data 
            curl_setopt_array($this->ch,
            [// definição de configurações da biblioteca curl
                CURLOPT_POST => TRUE, // ativa o envio de paramentros via post
                CURLOPT_POSTFIELDS => urldecode(http_build_query($post_data)) // dados a serem enviados via post
            ]);
        }
            curl_setopt_array($this->ch,
            [// definição de configurações da biblioteca curl
                CURLOPT_URL => $url, // definido o endereço web consulta
                CURLOPT_RETURNTRANSFER => 1, //  retornar a requisicao como string
                CURLOPT_COOKIESESSION => 1, //   defini uma nova sessão
                CURLOPT_COOKIEFILE => 'cookie.txt', //nome do arquivo que contém os dados do cookie.
                CURLOPT_COOKIEJAR => 'cookie.txt', // nome de um arquivo para salvar todos os cookies 
                CURLOPT_SSL_VERIFYPEER => 0, // 0 para impedir que o cURL verifique o certificado SSL
                CURLOPT_FOLLOWLOCATION => 1 // 1 para seguir qualquer cabeçalho "Location:"
            ]);
        $response = curl_exec($this->ch);
        $this->status = curl_getinfo($this->ch);
        $this->status['curl_erro'] = curl_error($this->ch);
        usleep(200000); // aguarda 0,2 segundos
        return $response; // retorna o codigo HTML do endereço web
    }
    public function getStatus(){
        return $this->status;
    }
}
?>