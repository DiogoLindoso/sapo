<?php
namespace App\Models\DAO;
use PDO;
use App\Models\Entidades\Processo;
use App\Models\Entidades\Historico;

class ProcessosDAO extends BaseDAO{

    public function getProcessos(){
        try {
            $query = $this->select("SELECT * FROM processos");
            return $query->fetchall(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao consultar os processos",500);
        }
    }
    public function setProcessos(Processo $processo){
        try{
            $numProcesso    = $processo->getNumProcesso();
            $tipo           = $processo->getTipo();
            $cpfOuRne       = $processo->getCpfOuRne();
            $nome           = $processo->getNome();
            $cursoArea      = $processo->getCursoArea();
            $etapaSituacao  = $processo->getEtapaSituacao();
            $link           = $processo->getLink();
            return $this->insert(
                'processos',
                ":num_processo,:fk_id_usuario,:tipo,:cpf_rne,:nome,:curso_area,:etapa_situacao,:link",
                [
                    ':num_processo'=>$numProcesso,
                    ':fk_id_usuario'=>1,
                    ':tipo'=>$tipo,
                    ':cpf_rne'=>$cpfOuRne,
                    ':nome'=>$nome,
                    ':curso_area'=>$cursoArea,
                    ':etapa_situacao'=>$etapaSituacao,
                    ':link'=>$link
                ]
            );
        }catch(\Exception $e){
            throw new \Exception("Erro ao gravar processo.", 500);
        }
        
    }
    public function getLinks(){
        try {
            $query = $this->select("SELECT num_processo,link FROM processos");
            return $query->fetchall(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao consultar os processos",500);
        }
    }
    public function setHistorico(Historico $historico){
        try{
            $numProcesso = $historico->getNumProcesso();
            $etapa = $historico->getEtapa();
            $situacao = $historico->getSituacao();
            $dataAlteracao = $historico->getDataAlteracao();
            $duracaoDias = $historico->getDuracaoDias();
            $responsavel = $historico->getResponsavel();

            return $this->insert(
                'historico_processo',
                ":num_processo,:etapa,:situacao,:data_alteracao,:duracao_dias,:responsavel",
                [
                    ':num_processo'=>$numProcesso,
                    ':etapa'=>$etapa,
                    ':situacao'=>$situacao,
                    ':data_alteracao'=>$dataAlteracao,
                    ':duracao_dias'=>$duracaoDias,
                    ':responsavel'=>$responsavel
                ]
            );
        }catch(\Exception $e){
            throw new \Exception("Erro ao gravar historico.", 500);
        }
        
    }
    public function duracaoMediaPreSapo(){
        try {
            $query = $this->select("SELECT AVG(media_dias) as media_duracao_dias 
                                    FROM ( 
                                            SELECT AVG(duracao_dias) as media_dias 
                                            FROM historico_processo 
                                            WHERE situacao = 'Encaminhado para o Gestor / Responsável' 
                                                AND data_alteracao < '2018/09/01' 
                                                    GROUP BY num_processo 
                                        ) as avgs");
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro na consulta.", 500);
        }
    }
    public function duracaoMediaPosSapo(){
        try {
            $query = $this->select("SELECT AVG(media_dias) as media_duracao_dias 
                                    FROM ( 
                                            SELECT AVG(duracao_dias) as media_dias 
                                            FROM historico_processo 
                                            WHERE situacao = 'Encaminhado para o Gestor / Responsável' 
                                                AND data_alteracao > '2018/09/01' 
                                                    GROUP BY num_processo 
                                        ) as avgs");
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro na consulta.", 500);
        }
    }
    public function setDadosColetados(Processo $processo){
        try {
            $idUsuario              = 1;
            $tipo                   = $processo->getTipo();
            $tipoDaSolicitacao      = $processo->getTipoDaSolicitacao();
            $cursoArea              = $processo->getCursoArea();
            $nome                   = $processo->getNome();
            $cpfOuRne               = $processo->getCpfOuRne();
            $email                  = $processo->getEmail();
            $nacionalidade          = $processo->getNacionalidade();
            $sexo                   = $processo->getSexo();
            $instituicao            = $processo->getInstituicao();
            $pais                   = $processo->getPais();
            $prazoParaAnalise       = $processo->getPrazoParaAnalise();

            return $this->insert(
                'dados_coletados',
                ":id_usuario,:tipo,:tipo_solicitacao,:curso,:nome,:cpf,:email,:nacionalidade,:sexo,:instituicao,:pais,:prazo_analize",
                [
                    ':id_usuario'=>$idUsuario,
                    ':tipo'=>$tipo,
                    ':tipo_solicitacao'=>$tipoDaSolicitacao,
                    ':curso'=>$cursoArea,
                    ':nome'=>$nome,
                    ':cpf'=>$cpfOuRne,
                    ':email'=>$email,
                    ':nacionalidade'=>$nacionalidade,
                    ':sexo'=>$sexo,
                    ':instituicao'=>$instituicao,
                    ':pais'=>$pais,
                    ':prazo_analize'=>$prazoParaAnalise
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao gravar dados.", 500);
        }
    }
    public function getProcessosAguardandoDistribuicao(){
        try {
            $query = $this->select("SELECT * FROM dados_coletados ORDER BY nome ASC");
            return $query->fetchall(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao consultar os processos",500);
        }
    }
    public function getProcessosPorCPF($cpf){
        try {
            $query = $this->select("SELECT id FROM dados_coletados WHERE cpf='{$cpf}'");
            return $query->fetchall(PDO::FETCH_OBJ);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao consultar os processos",500);
        }
    }
    public function updatePrazoParaAnalise(Processo $processo,$id){
        try {
            $prazoParaAnalise = $processo->getPrazoParaAnalise();
            return $this->update('dados_coletados',
                                ':prazo_analize',
                                [
                                    ':prazo_analize'=>$prazoParaAnalise
                                ],
                                $id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar o processo",500);
        }
    }
    public function deleteProcesso($id){
        try{
            return $this->delete('dados_coletados',$id);
        }catch(\Exception $e){
            throw new Exception("Erro ao apagar processo",500);
        }
    }
}

?>