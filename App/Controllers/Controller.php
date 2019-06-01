<?php
namespace App\Controllers;
use App\Lib\Sessao;
use App\Lib\CurlRequest;
use App\Lib\Scraping;
abstract class Controller{
    protected $app;
    private $viewVar;

    public function __construct($app){
        $this->setViewParam('nameController',$app->getControllerName());
    }

    public function render($view, $data=null){
        if(Sessao::existeLogin()){
            $viewVar = $this->getViewVar();
            require_once PATH . '/App/Views/layouts/header.php';
            require_once PATH . '/App/Views/layouts/sidebar.php';
            require_once PATH . '/App/Views/layouts/navbar.php';
            require_once PATH . '/App/Views/'. $view . '.php';
            require_once PATH . '/App/Views/layouts/footer.php';
        }else{
            
            Sessao::limparLogin();
            session_unset();
            session_destroy();
            $this->renderLogin('login/index');
        }
        
    }
    public function renderLogin($view){
        $viewVar = $this->getViewVar();
        require_once PATH . '/App/Views/'. $view .'.php';
    }
    public function redirect($view){
        header('Location: http://' . APP_HOST . $view);
        
    }
    public function getViewVar(){
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue){
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }

    function login($cpf,$senha, $teste=false){
        $cpf_hash = base64_encode($cpf); //codifica o cpf em base64
        $senha_hash = base64_encode($senha); //codifica a senha em base64
        $data = array(  'id'        =>  $cpf,
                                'identifier'=>  $cpf_hash,
                                'password'  =>  $senha_hash,
                                'pw'        =>  $senha  );
        $curl = new CurlRequest();
        $curl->request('http://plataformacarolinabori.mec.gov.br/index/acesso'); //requisição para acessar o link
        $respostaLogin = $curl->request('https://ssd.mec.gov.br/ssd-server/servlet/AuthenticationById',$data); //envio de parametros de login para o link
        $status = $curl->getStatus(); // recebe o estatus 
        if(($status['url'] == 'http://plataformacarolinabori.mec.gov.br/') &&
            ($status['http_code'] === 200) ) // verifica se o login obteve êxito
        {   
            Sessao::gravarMensagem('Conexão realiada com sucesso!','success');
            $teste ? '' : Sessao::limparMensagem();
            return $curl->request('http://plataformacarolinabori.mec.gov.br/usuario/alterar-perfil/5/19754'); //acessa o link para acesso aos processos 
        }else{ // caso não tenha êxito
            $scrapping = new Scraping();
            $mensagem = $scrapping->erroLogin($respostaLogin); // extrai a mensagem de erro no login ex: senha incorreta!
            Sessao::gravarMensagem($mensagem,'danger'); // grava a mensagem de erro nas variáveis de sessão
            $teste ? '' : Sessao::limparMensagem();
            return false;
        }
    }
}
?>