<?php
namespace App\Controllers;
use App\Lib\Sessao;
use App\Models\Dao\ProcessosDAO;
class HomeController extends Controller{
    public function index(){
        $processosDAO   = new ProcessosDAO();
        
        $pre = $processosDAO->duracaoMediaPreSapo();
        $_POST['media-pre'] = $pre->media_duracao_dias;
        
        $pos = $processosDAO->duracaoMediaPosSapo();
        $_POST['media-pos'] = $pos->media_duracao_dias;

        $this->render('home/index');
    }
}
?>