<?php
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
class ConfiguracoesController extends Controller{
    public function index(){
        $usuario = new UsuarioDAO();
        $usuario = $usuario->getLogin(Sessao::getEmail(), Sessao::getSenha());
        $_POST['cpf']       = $usuario->cpf;
        $_POST['senha']     = $usuario->senha_cb;
        $_POST['nome']      = $usuario->nome;
        $_POST['sobrenome'] = $usuario->sobrenome;
        $_POST['email']     = $usuario->email_notificacao;
        
        $this->render('configuracoes/index');
    }
    public function salvar(){
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getLogin(Sessao::getEmail(), Sessao::getSenha());
        
        $usuario->cpf               = $_POST['cpf'];
        $usuario->senha_cb          = $_POST['senha'];
        $usuario->nome              = $_POST['nome'];
        $usuario->sobrenome         = $_POST['sobrenome'];
        $usuario->email_notificacao = $_POST['email'];
 
        $usuarioDAO->updateUsuario($usuario);
        $this->redirect('/configuracoes/index');
    }
    public function testeconexao(){
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getLogin(Sessao::getEmail(), Sessao::getSenha());
        $this->login($usuario->cpf, $usuario->senha_cb, true);
        $this->redirect('/configuracoes/index');
        
    }
}
?>