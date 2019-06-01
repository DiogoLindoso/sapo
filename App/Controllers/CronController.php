<?php
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\ProcessosDAO;
use App\Lib\CurlRequest;
use App\Lib\Scraping;
use App\Lib\EmailAutenticado;
class CronController extends Controller{
    private $header;
    private $content;
    private $footer;
    private $arrayObjProcessosDAO;

    public function index(){
        $this->header = file_get_contents(PATH.'/App/Views/layouts/email/header.php'); // template do cabeçalho HTML do e-mail
        $this->footer = file_get_contents(PATH.'/App/Views/layouts/email/footer.php'); // template do rodapé HTML do e-mail
        
        $usuarioDAO = new UsuarioDao(); // instancia um obj tipo usuarioDAO
        $usuarioDAO = $usuarioDAO->listarUsuarios(); // retorna um array de usuarios
        foreach ($usuarioDAO as $usuario) { // para cada usuário
            $this->atualizaProcessos($usuario); // faz uma consulta no portal com os dados do usuario e atualiza no banco se estiver diferente da consulta anterior
            $textoHTML = $this->getTextoHTML($this->getProcssosDAO()); // recebe um array de processos continos no banco e formata como HTML
            $email = new EmailAutenticado(); // instancia um obj do tipo EmailAutenticado
            $email->enviaEmail($textoHTML,$usuario->email_notificacao,'Relatório Sapo'); // recebe um texto de email HTML, email do usuário, e o título do email
        }
    }
    private function getTextoHTML($processosNoBanco){
        $emailHTML='';
        foreach($processosNoBanco as $cada){
            $this->content.="<tr>";
            $this->content.="<td style='padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;'>";
            $this->content.=$cada->tipo;
            $this->content.="</td>";     
            $this->content.="<td style='padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;'>";
            $this->content.=$cada->curso;
            $this->content.="</td>";
            $this->content.="<td style='padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;'>";
            $this->content.=$cada->nome;
            $this->content.="</td>";
            $this->content.="<td style='padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;'>";
            $this->content.=$cada->prazo_analize;
            $this->content.="</td>";
            $this->content.="</tr>";
         }
         $emailHTML.=$this->header;
         $emailHTML.=$this->content;
         $emailHTML.=$this->footer;
         return $emailHTML;
    }
    private function atualizaProcessos($usuario){
        $this->login($usuario->cpf, $usuario->senha_cb);
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
        $curl = new CurlRequest();
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
    private function getProcssosDAO(){
        return $this->arrayObjProcessosDAO;
    }
}
?>