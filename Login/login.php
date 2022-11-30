<?php
    require_once("../Utils/mysql.php");
    require_once("../Utils/valida_formulario.php");

    function cadastrarLogin($dslogin, $dssenha, $idaluno){
        if(membroValido($dslogin,"usuario")!="1") die("Erro no usuário");
        if(membroValido($dssenha,"senha")!="1") die("Erro na senha");

        $sqlInsert = "insert into login(dslogin,dssenha,idaluno) values ('@nome','@senha','@id')";

        $sql = str_replace("@nome",$dslogin,$sqlInsert);
        $sql = str_replace("@senha",md5($dssenha),$sql);
        $sql = str_replace("@id",$idaluno,$sql);

        insereRegistro($sql);
    }

    function verificarLogin($dslogin, $dssenha){
        $sqlValida = "Select * from login where dslogin='@login' and dssenha='@senha'";
        $sql = str_replace("@login",$dslogin,$sqlValida);
        $sql = str_replace("@senha",md5($dssenha),$sql);

        $login = selectRegistros($sql);

        if(count($login) > 0) return true;
        else return false;
    }

    //? VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function revalidarLogin(){
        session_name(md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        session_start();

        if (empty($_SESSION['token']) || empty($_SESSION['dssenha']) || empty($_SESSION['dslogin'])){
            return false;
        }

        $tokenBody = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        
        if ($_SESSION['token'] != $tokenBody){
            return false;
        }

        $sqlValida = "Select * from login where dslogin='@login' and dssenha='@senha'";
        $sql = str_replace("@login",$_SESSION['dslogin'],$sqlValida);
        $sql = str_replace("@senha",md5($_SESSION['dssenha']),$sql);

        $login = selectRegistros($sql);

        if(count($login) > 0) return true;
        else return false;
    }

    function liberarExclusao($id){
        $sql = "SELECT * FROM login WHERE idaluno=" . $id;

        $login = selectRegistros($sql);

        if(count($login) > 0) return false;
        else return true;
    }

    function listarLogins(){
        return selectRegistros("select * from login");
    }

    function ListarAlunosValidos(){
        $sql = "select * " .
                "from aluno a " .
                "where a.idaluno not in (select idaluno from login l where l.idaluno = a.idaluno) ";

        return selectRegistros($sql);
    }

    function ListarTodosLogin(){
        $sql = "select l.dslogin," .
                " l.dssenha," .
                " l.idaluno," .
                " a.nmaluno" .
                " from login l," .
                " aluno a" .
                " where l.idaluno = a.idaluno";

        return selectRegistros($sql);
    }

    function ExcluirAluno($valor){
        $sql = "delete from login where dslogin = '$valor'";

        return deleteRegistro($sql);
    }

    function AtualizarSenha($dslogin, $senhaMD5){
        $sql = 'update login ' .
               " set dssenha = '$senhaMD5'" . 
               " where dslogin = '$dslogin'";

        return updateRegistro($sql);
    }

    function AtualizarAluno($dslogin, $idaluno){
        $sql = 'update login '.
               " set idaluno = $idaluno".
               " where dslogin = '$dslogin'";

        return updateRegistro($sql);
    }
?>