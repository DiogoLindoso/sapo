<?php
namespace App\Models\DAO;
use App\Lib\ConPDO;

abstract class BaseDAO{
    private $conexao;

    public function __construct(){
        $this->conexao = ConPDO::getConnection();
    }
    public function select($sql){
        if(!empty($sql)){
            return $this->conexao->query($sql);
        }
    }
    public function insert($table, $cols, $values){
        if(!empty($table) && !empty($cols) && !empty($values)){
            $parametros = $cols;
            $colunas = str_replace(":","",$cols);
            $stmt = $this->conexao->prepare("INSERT INTO $table ($colunas) VALUES ($parametros)");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }
    public function update($table, $cols, $values, $id){
        if(!empty($table) && !empty($cols) && !empty($values) && !empty($id)){
            $parametros = $this->fixParamUpdate($cols);
            $colunas = str_replace(":","",$cols);
            $stmt = $this->conexao->prepare("UPDATE $table SET $parametros WHERE id = $id");
            $stmt->execute($values);
            return $stmt->rowCount();
        }
        else {
            return false;
        }
    }
    public function delete($table, $id){
        if(!empty($table) && !empty($id)){
            $stmt = $this->conexao->prepare("DELETE FROM $table WHERE id = $id");
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
    private function fixParamUpdate($parametros){
        $col = explode(",",$parametros);
        $parametros='';
        foreach ($col as $val) {
            $parametros.= str_replace(":","",$val)." = {$val}, ";
        }
        return substr($parametros,0, strlen($parametros)-2);
         
    }
}
?>