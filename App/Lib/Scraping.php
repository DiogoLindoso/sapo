<?php
namespace App\Lib;
use DOMDocument;
use DOMXPath;
use App\Models\Entidades\Processo;
use App\Models\Entidades\Historico;
class Scraping{
    private $dom;
    function __construct(){
        libxml_use_internal_errors(true);
        $this->dom = new DOMDocument();
    }
    public function erroLogin($response){
        $this->dom->loadHTML(mb_convert_encoding($response,'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($this->dom);
        $motivoErro = $xpath->query('//*[@id="fieldset"]/textarea');
        return $motivoErro->item(0)->nodeValue;
    }
    public function tblprocessos($response){
        $this->dom->loadHTML(mb_convert_encoding($response,'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($this->dom);
        $tbody = $xpath->query('/html/body/table/tbody/tr');
        foreach($tbody as $node){
            $processo = new Processo();
            $processo->setNumProcesso($node->childNodes->item(1)->nodeValue);
            $processo->setCpfOuRne($node->childNodes->item(5)->nodeValue);
            $processo->setNome($node->childNodes->item(7)->nodeValue);
            $processo->setCursoArea($node->childNodes->item(9)->nodeValue);
            $processo->setEtapaSituacao($node->childNodes->item(11)->nodeValue);
            $processo->setTipo($node->childNodes->item(3)->nodeValue);
            $processo->setLink($node->childNodes->item(13)->childNodes->item(1)->attributes->getNamedItem('href')->value);
            $arrayObjProcesso[] = $processo;
         }
         return $arrayObjProcesso;
    }
    public function historicos($response){
        $this->dom->loadHTML(mb_convert_encoding($response,'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
        $xpath = new DOMXPath($this->dom);
        $tblhistorico = $xpath->query('//*[@id="historico"]/table/tbody/tr');
        foreach ($tblhistorico as $node) {
            $historico = new Historico();
            $historico->setEtapa($node->childNodes->item(1)->nodeValue);
            $historico->setSituacao($node->childNodes->item(3)->nodeValue);
            $historico->setDataAlteracao($node->childNodes->item(5)->nodeValue);
            $historico->setDuracaoDias($node->childNodes->item(7)->nodeValue);
            $historico->setResponsavel($node->childNodes->item(9)->nodeValue);
            $arrayObjHistorico[] = $historico;
        }
        return $arrayObjHistorico;
    }
    public function processo($response){
        $this->dom->loadHTML(mb_convert_encoding($response,'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($this->dom);
        $containerProcesso = $xpath->query('//*[@id="containerProcesso"]/div');
        
        if($containerProcesso->length > 2){
            $processo = trim($containerProcesso->item(2)->childNodes->item(7)->nodeValue);
        }else{
            $processo = 'null';
        }
        return $processo;
    }
    function detalharProcesso($response, Processo $processo){

        $this->dom->loadHTML(mb_convert_encoding($response,'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
        $xpath = new DOMXPath($this->dom);
        
        $containerSolicitacao = $xpath->query('//*[@id="containerSolicitacao"]');
        $containerIdentifRequerente = $xpath->query('//*[@id="containerIdentifRequerente"]');
        $containerIdentifCursoEst = $xpath->query('//*[@id="containerIdentifCursoEst"]');
        
        $node = $containerSolicitacao->item(0);
        $processo->setTipoDaSolicitacao($node->childNodes->item(1)->childNodes->item(7)->nodeValue);
        $processo->setPrazoParaAnalise($node->childNodes->item(3)->childNodes->item(7)->nodeValue);
        
        $node = $containerIdentifRequerente->item(0);
        $processo->setEmail($node->childNodes->item(5)->childNodes->item(3)->nodeValue);
        $processo->setNacionalidade($node->childNodes->item(13)->childNodes->item(3)->nodeValue);
        $processo->setSexo($node->childNodes->item(15)->childNodes->item(3)->nodeValue);

        $node = $containerIdentifCursoEst->item(0);
        $processo->setInstituicao($node->childNodes->item(1)->childNodes->item(3)->nodeValue);
        $processo->setPais($node->childNodes->item(3)->childNodes->item(3)->nodeValue);
        
        return $processo;
    }
}
?>