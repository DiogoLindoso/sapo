<?php
namespace App\Models\DAO;
use PDO;
use App\Lib\Sessao;
class UsuarioDAO Extends BaseDAO{
    public function getUsuario($id){
        try {
            $query = $this->select("SELECT * FROM usuarios WHERE id = $id");
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao consultar o usuario",500);
        }
    }
    public function getLogin($email, $senha){
        try {
            $query = $this->select("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao consultar o usuario",500);
        }
    }
    public function listarUsuarios(){
        try {
            $query = $this->select("SELECT * FROM usuarios");
            $result = $query->fetchall(PDO::FETCH_OBJ);
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao consultar o usuario",500);
        }
    }
    public function updateUsuario(\stdClass $usuario){
        try{
            $id                 = $usuario->id;
            $emailNotificacao   = $usuario->email_notificacao;
            $senhaCB            = $usuario->senha_cb;
            $nome               = $usuario->nome;
            $sobrenome          = $usuario->sobrenome;
            $cpf                = $usuario->cpf;
            $response =  $this->update('usuarios',
                                ':email_notificacao,:senha_cb,:nome,:sobrenome,:cpf',
                                [
                                    ':email_notificacao'=>$emailNotificacao,
                                    ':senha_cb'=>$senhaCB,
                                    ':nome'=>$nome,
                                    ':sobrenome'=>$sobrenome,
                                    ':cpf'=>$cpf
                                ],
                                $id);

            Sessao::gravarMensagem('Configurações gravadas com sucesso!','success');
            return $response;
        }catch(\Throwable $th ){
            throw new \Exception("Erro ao atualizar configurações",500);
        }
    }
}
?>