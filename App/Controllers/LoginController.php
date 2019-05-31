<?php
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
class LoginController extends Controller{
    public function index(){
        $this->renderLogin('login/index');
    }
    public function logar(){
        $usuarioDAO =  new UsuarioDAO();
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        if($usuarioDAO->getLogin($email, $senha)){
            session_start();
            Sessao::gravarLogin();
            Sessao::existeLogin();
            Sessao::setEmail($email);
            Sessao::setSenha($senha);
            $this->redirect('/home/index');
        }else{
            session_destroy();
            Sessao::limparLogin();
            $this->redirect('/');
        }
    
    }
    public function sair(){
        session_start();
        Sessao::limparLogin();
        session_destroy();
        $this->redirect('/');
    }
}
?>