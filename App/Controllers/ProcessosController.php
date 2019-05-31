<?php
namespace App\Controllers;
use App\Models\Dao\ProcessosDao;
use App\Models\Dao\UsuarioDao;
use App\Models\Entidades\Usuario;
use App\Lib\Scraping;
use App\Lib\CurlRequest;
use App\Lib\Sessao;
class ProcessosController extends Controller{
    public function index(){
        $consulta = new ProcessosDAO();
        $processos = $consulta->getProcessos();
        $this->render('processos/index',$processos);
    }
    public function scraping(){
        $usuarioDAO = new UsuarioDao();
        $usuarioDAO = $usuarioDAO->getLogin(Sessao::getEmail(),Sessao::getSenha());
        
        $cpf = $usuarioDAO->cpf;
        $senha = $usuarioDAO->senha_cb;

        $curl = new CurlRequest();
        $post_data = $this->login($cpf,$senha);
        $dados_consulta = array('papeisNaIes'=>'',
                                'nuCpf'=>'',
                                'noUsuario'=>'',
                                'nuProcesso'=>'', 
                                'noCurso'=>'',
                                'tipoTramitacao'=>'',
                                'coTipoSolicitacao'=>'', 
                                'coEtapa'=>'',//3
                                'coSituacaoProcesso'=>'',//12
                                'dtInicio'=>'',
                                'dtFinal'=>''
                            );
        $response = $curl->request('http://plataformacarolinabori.mec.gov.br/processo/gerenciar',$dados_consulta);

        $scraper = new Scraping();
        $arrayObjProcesso = $scraper->tblprocessos($response);
        $processoDAO = new ProcessosDAO();
        foreach ($arrayObjProcesso as $processo) {
            $processoDAO->setProcessos($processo);          
        }
        $arrayObjLinks = $processoDAO->getLinks();
        
        foreach ($arrayObjLinks as $objLink) {
            $response = $curl->request($objLink->link);
            $arrayObjHistorico = $scraper->historicos($response);

            foreach ($arrayObjHistorico as $objHistorico) {
                $objHistorico->setNumProcesso($objLink->num_processo);
                $processoDAO->setHistorico($objHistorico);        
            }
        }
        
    }
}
?>