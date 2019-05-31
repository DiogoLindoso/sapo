<?php
namespace App\Models\Entidades;
use DateTime;
class Historico{
    private $numProcesso;
    private $etapa;
    private $situacao;
    private $dataAlteracao;
    private $duracaoDias;
    private $responsavel;
    
    public function setNumProcesso($numProcesso){
        $this->numProcesso = trim($numProcesso);
    }
    public function getNumProcesso(){
        return $this->numProcesso;
    }
    public function setEtapa($etapa){
        $this->etapa = trim($etapa);
    }
    public function getEtapa(){
        return $this->etapa;
    }
    public function setSituacao($situacao){
        $this->situacao = trim($situacao);
    }
    public function getSituacao(){
        return $this->situacao;
    }
    public function setDataAlteracao($dataAlteracao){
        $dataAlteracao = trim($dataAlteracao);
        $this->dataAlteracao = DateTime::createFromFormat("d/m/Y", $dataAlteracao)->format('Y-m-d');
    }
    public function getDataAlteracao(){
        return $this->dataAlteracao;
    }
    public function setDuracaoDias($duracaoDias){
        $this->duracaoDias = trim($duracaoDias);
    }
    public function getDuracaoDias(){
        return $this->duracaoDias;
    }
    public function setResponsavel($responsavel){
        $this->responsavel = trim($responsavel);
    }
    public function getResponsavel(){
        return $this->responsavel;
    }
}
?>