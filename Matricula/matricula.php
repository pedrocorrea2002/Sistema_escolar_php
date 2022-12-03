<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from alunomatriculado where lower(nmaluno) like '%";
$novaMatricula = "insert into alunomatriculado(idaluno,idmateria) values (1@,2@)";

function selecionaMatricula($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listaMatriculas()
{
    return selectRegistros(
        'select * from alunomatriculado am '.
        'inner join aluno a on a.idaluno = am.idaluno '.
        'inner join materia m on m.idmateria = am.idmateria '.
        'order by am.idalunomatriculado asc'
    );
}

function existeMatricula($idaluno,$idmateria)
{
    $retorno = selectRegistros("select * from alunomatriculado where idaluno = $idaluno and idmateria = $idmateria");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarMatricula($idaluno,$idmateria)
{
    global $novaMatricula;
    $sql = str_replace("1@",$idaluno,$novaMatricula);
    $sql = str_replace("2@",$idmateria,$sql);

    echo $sql;

    return insereRegistro($sql);
}

function getMatricula($id)
{
    $retorno = selectRegistros("select * from alunomatriculado where idalunomatriculado=$id");

    return $retorno;
}

function setMatricula($id,$idaluno,$idmateria)
{
    $sql = "UPDATE alunomatriculado SET idaluno=$idaluno, idmateria=$idmateria WHERE idalunomatriculado=" . $id;

    return updateRegistro($sql);
}

function deletaMatricula($id)
{
    $sql = "DELETE FROM alunomatriculado WHERE idalunomatriculado = $id";   

    return deleteRegistro($sql);
}

//* PESQUISA UMA LISTA DE MATRÍCULA COM BASE NO NOME DO ALUNO
function searchMatriculasByName($name){
    return selectRegistros(
        'select * from alunomatriculado am '.
        'inner join aluno a on a.idaluno = am.idaluno '.
        'inner join materia m on m.idmateria = am.idmateria '.
        "where a.nmaluno like '$name%'".
        'order by am.idalunomatriculado asc'
    );
}
?>