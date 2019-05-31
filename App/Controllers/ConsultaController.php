<?php
namespace App\Controllers;
use App\Models\DAO\ProcessosDAO;
class ConsultaController extends Controller{
    public function index(){
        $processo = new ProcessosDAO();
        $arrayprocessos = $processo->getProcessosAguardandoDistribuicao();
        $this->render('consulta/index', $arrayprocessos);
    }
}
?>