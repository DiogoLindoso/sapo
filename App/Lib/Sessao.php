<?php
namespace App\Lib;

class Sessao{
    private static $login;

    public static function gravarMensagem($mensagem,$tipo='info'){
        self::limparMensagem();
        $_SESSION['msg'] = $mensagem;
        $_SESSION['msg-type'] = $tipo;
    }
    public static function limparMensagem(){
        unset($_SESSION['msg']);
        unset($_SESSION['msg-type']);
    }
    public static function existeMensagem(){
        return isset($_SESSION['msg']) ? true : false;
    }
    public static function retornarMensagem(){
        return ($_SESSION['msg']) ? $_SESSION['msg'] : "";
    }
    public static function retornaTipoMensagem(){
        return ($_SESSION['msg']) ? $_SESSION['msg'] : 'info';
    }
    public static function gravarLogin(){
        self::$login=true;
        $_SESSION['login'] = true;
    }
    public static function limparLogin(){
        self::$login = false;
        $_SESSION['login']=false;
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
    }
    public static function existeLogin(){
        if(isset($_SESSION['login']) && $_SESSION['login'] == true ){
            return true;
        }else{
            return false;
        }   
    }
    public static function setEmail($email){
        $_SESSION['email']=$email;
    }
    public static function getEmail(){
        return $_SESSION['email'];
    }
    public static function setSenha($senha){
        $_SESSION['senha'] = $senha;
    }
    public static function getSenha(){
        return $_SESSION['senha'];
    }
}
?>