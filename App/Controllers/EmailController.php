<?php
namespace App\Controllers;
use App\Lib\EmailAutenticado;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
class EmailController extends AtualizaController{
    private $header;
    private $content;
    private $footer;
    public function sendEmail(){
        $this->header = file_get_contents(PATH.'/App/Views/layouts/email/header.php');
        $this->footer = file_get_contents(PATH.'/App/Views/layouts/email/footer.php');
        $this->index();
        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO = $usuarioDAO->getLogin(Sessao::getEmail(), Sessao::getSenha());

        $emailHTML = $this->getTextoHTML($this->getProcssosDAO());
        $email = new EmailAutenticado();
        $email->enviaEmail($emailHTML,$usuarioDAO->email_notificacao,'Relatório Sapo');
        $this->redirect('/consulta/index');
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

}
?>