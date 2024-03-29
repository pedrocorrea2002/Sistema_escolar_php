<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from aluno where lower(nmaluno) like '%";
$novoAluno = "insert into aluno(nmaluno) values ('@')";

function selecionaAluno($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listaAlunos()
{
    return selectRegistros("select * from aluno");
}

function existeAluno($nome)
{
    $retorno = selectRegistros("select * from aluno where lower(nmaluno)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarAluno($nome)
{
    global $novoAluno;
    $sql = str_replace("@",$nome,$novoAluno);

    return insereRegistro($sql);
}

function getAluno($id)
{
    $retorno = selectRegistros("select * from aluno where idaluno='" . $id . "'");

    return $retorno[0];
}

//* VERIFICA SE EXISTE ALGUM ALUNO COM O NOME PASSADO
function verificaNomeAluno($nmaluno)
{
    $retorno = selectRegistros("select * from aluno where nmaluno = '$nmaluno'");

    if(count($retorno) > 0){
        return true;
    }else{
        return false;
    }
}

//* PESQUISA UMA LISTA DE ALUNO COM BASE NO NOME PASSADO
function searchAlunosByName($name){
    return selectRegistros("select * from aluno where nmaluno like '$name%'");
}

function setAluno($id, $nome)
{
    $sql = "UPDATE ALUNO SET nmaluno='$nome' WHERE idaluno = $id";

    return updateRegistro($sql);
}
function deleteAluno($id)
{
    $sql = "DELETE FROM ALUNO WHERE idaluno = $id";   

    return deleteRegistro($sql);
}

?>