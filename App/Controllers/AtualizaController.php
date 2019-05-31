<?php
namespace App\Controllers;
use App\Models\Dao\UsuarioDao;
use App\Models\Dao\ProcessosDao;
use App\Lib\CurlRequest;
use App\Lib\Scraping;
use App\Lib\Sessao;
class AtualizaController extends Controller{
    private $arrayObjProcessosDAO;
    private $arrayObjProcesso;
    public function index(){
        $this->aguardandodistribuicao();
    }
    
    private function aguardandodistribuicao(){
        $usuarioDAO = new UsuarioDao();
        $usuarioDAO = $usuarioDAO->getLogin(Sessao::getEmail(), Sessao::getSenha());
        
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
                                'coEtapa'=>'3',
                                'coSituacaoProcesso'=>'12',
                                'dtInicio'=>'',
                                'dtFinal'=>''
        );
        $response = $curl->request('http://plataformacarolinabori.mec.gov.br/processo/gerenciar',$dados_consulta);
        $scraper = new Scraping();
        $this->arrayObjProcesso = $scraper->tblprocessos($response);

        $processoDAO = new ProcessosDAO();
        
        foreach ($this->arrayObjProcesso as $processo) {

            $response = $curl->request($processo->getlink());
            $processo = $scraper->detalharProcesso($response, $processo);
            //Se o processo já está no banco
            if ($response = $processoDAO->getProcessosPorCPF($processo->getCpfOuRne())) {
                // Atualiza o prazo para analise
                $processoDAO->updatePrazoParaAnalise($processo,$response[0]->id);
            }else{
                //senão está no banco, saval o processo no banco.
                $processoDAO->setDadosColetados($processo);
            }
        }
        //Se o processo está no banco e não esta bo site, apaga do banco.
        foreach($processoDAO->getProcessosAguardandoDistribuicao() as $processoNoBanco ){
            $arrayObjProcessoCpf = array_column($this->arrayObjProcesso,'cpfOuRne');
            if(!in_array($processoNoBanco->cpf,$arrayObjProcessoCpf)){
                $processoDAO->deleteProcesso($processoNoBanco->id);
            }
        }
        $this->arrayObjProcessosDAO = $processoDAO->getProcessosAguardandoDistribuicao();
    }
    public function getProcessosJSON(){
        $this->aguardandodistribuicao();
        $dadosJSON = json_encode($this->arrayObjProcessosDAO,JSON_UNESCAPED_UNICODE|JSON_FORCE_OBJECT);
        $index = array(
                        'tipo_solicitacao','curso','cpf','prazo_analize'
                    );

        $replace_index = array(
                                'tipo_da_solicitacao','curso_area','cpf_rne','prazo_para_analise'
                            );

        $dadosJSON = str_replace($index, $replace_index, $dadosJSON);

        header("Content-Type: application/json; charset=UTF-8");
        echo $dadosJSON;
    }
    public function getProcssosDAO(){
        return $this->arrayObjProcessosDAO;
    }
}

?>