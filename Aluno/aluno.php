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

function setNameAluno($id, $nome)
{
    $sql = "UPDATE ALUNO SET NMaluno='" . $nome . "' WHERE idaluno=" . $id;

    return updateRegistro($sql);
}
function deleteAluno($id)
{
    $sql = "DELETE FROM ALUNO  WHERE idaluno=" . $id;   

    return deleteRegistro($sql);
}

?>