<?php
namespace App\Lib;
use Mail_mime;
use Mail;
use Pear;
use App\Lib\Sessao;
//include('Mail.php');
//include('Mail/mime.php');
class EmailAutenticado{
    
    function enviaEmail($texto_html,$endereco_email,$assunto){
        $text = "Relatório SAPO";
        $crlf = "\n";
        $mime = new Mail_mime($crlf);
        $mime->setTXTBody($text);
        $mime->setHTMLBody($texto_html);
        
        $mimeparams['text_encoding']="7bit";
        $mimeparams['text_charset']="UTF-8";
        $mimeparams['html_charset']="UTF-8";
        
        $body = $mime->get($mimeparams);
        $recipients[] = $endereco_email;
        $headers['To'] = $endereco_email;
        //$headers['Cc'] = '<cópia>';
        //$headers['Bcc'] = '<cópia oculta>';
        $headers['From'] = EMAIL_USERNAME;
        //$headers['Subject'] = "Relatório SAPO";
        $headers['Subject'] = $assunto;
        $sub = '=?UTF-8?B?'.base64_encode($headers['Subject']).'?=';
        // codificando em utf-8
        $headers['Subject'] = $sub;
        $headers = $mime->headers($headers);
        $params['host'] = EMAIL_HOST;
        $params['port'] = EMAIL_PORT;
        $params['auth'] = EMAIL_AUTH;
        $params['username'] = EMAIL_USERNAME;
        $params['password'] = EMAIL_PASSWORD;
        // codificando em utf-8
        $params['text_encoding'] = '7bit';
        $params['text_charset'] = 'UTF-8';
        $params['html_charset'] = 'UTF-8';
        $params['head_charset'] = 'UTF-8';

        //$mail_object =& Mail::factory('smtp', $params);
        $mail_object = Mail::factory('smtp', $params);
        $rs = $mail_object->send($recipients, $headers, $body);
        
        if (PEAR::isError($rs)) {
            echo $rs->getMEssage()."\n";
            Sessao::gravarMensagem($rs->getMEssage(),'danger');
        }
        else {
                Sessao::gravarMensagem("E-mail enviado!",'success');
                return true;
        }
    }
}
?>
