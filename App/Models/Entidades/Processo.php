<?php
namespace App\Models\Entidades;
class Processo{
    private $numProcesso;
    private $tipo;
    private $cpfOuRne;
    private $nome;
    private $cursoArea;
    private $etapaSitacao;
    private $link;
    private $tipoDaSolicitacao;
    private $prazoParaAnalise;
    private $email;
    private $nacionalidade;
    private $sexo;
    private $instituicao;
    private $pais;
    
    public function __get($name){
        return $this->$name;
    }
    public function __isset($name){
        return isset($this->$name);
    }
    public function setNumProcesso($numProcesso){
        $this->numProcesso = trim($numProcesso);
    }
    public function getNumProcesso(){
        return $this->numProcesso;
    }
    public function setTipo($tipo){
        $this->tipo = trim($tipo);
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setCpfOuRne($cpfOuRne){
        $this->cpfOuRne = trim($cpfOuRne);
    }
    public function getCpfOuRne(){
        return $this->cpfOuRne;
    }
    public function setNome($nome){
        $this->nome = trim($nome);
    }
    public function getNome(){
        return $this->nome;
    }
    public function setCursoArea($cursoArea){
        $this->cursoArea = trim($cursoArea);
    }
    public function getCursoArea(){
        return $this->cursoArea;
    }
    public function setEtapaSituacao($etapaSitacao){
        $this->etapaSitacao = trim(preg_replace("/\s{2,}/"," ",$etapaSitacao));
    }
    public function getEtapaSituacao(){
        return $this->etapaSitacao;
    }
    public function setLink($link){
        $this->link = HOST_SCRAP.$link;
    }
    public function getLink(){
        return $this->link;
    }
    public function setTipoDaSolicitacao($tipoDaSolicitacao){
        $this->tipoDaSolicitacao = trim($tipoDaSolicitacao);
    }
    public function getTipoDaSolicitacao(){
        return $this->tipoDaSolicitacao;
    }
    public function setPrazoParaAnalise($prazoParaAnalise){
        $this->prazoParaAnalise = trim($prazoParaAnalise);
    }
    public function getPrazoParaAnalise(){
        return $this->prazoParaAnalise;
    }
    public function setEmail($email){
        $this->email = trim($email);
    }
    public function getEmail(){
        return $this->email;
    }
    public function setNacionalidade($nacionalidade){
        $this->nacionalidade = trim($nacionalidade);
    }
    public function getNacionalidade(){
        return $this->nacionalidade;
    }
    public function setSexo($sexo){
        $this->sexo = trim($sexo);
    }
    public function getSexo(){
        return $this->sexo;
    }
    public function setInstituicao($instituicao){
        $this->instituicao = trim($instituicao);
    }
    public function getInstituicao(){
        return $this->instituicao;
    }
    public function setPais($pais){
        $this->pais = trim($pais);
    }
    public function getPais(){
        return $this->pais;
    }
}
?>