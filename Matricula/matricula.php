<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from alunomatriculado where lower(nmaluno) like '%";
$novaMatricula = "insert into alunomatriculadp(idaluno,idmateria) values (1@,2@)";

function selecionaMatricula($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listaMatriculas()
{
    return selectRegistros("select * from alunomatriculado am inner join aluno a on a.idaluno = am.idaluno");
}

function existeMatricula($idaluno)
{
    $retorno = selectRegistros("select * from alunomatriculado where idaluno = $idaluno");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarMatricula($idaluno,$idmateria)
{
    global $novaMatricula;
    $sql = str_replace("1@",$idaluno,$novaMatricula);
    $sql = str_replace("2@",$idmateria,$novaMatricula);

    return insereRegistro($sql);
}

// function getName($id)
// {
//     $retorno = selectRegistros("select * from alunomatriculado am inner join aluno a on a.idaluno = am.alunomatricula where am.idalunomatriculado=$id");

//     return $retorno[0]['nmaluno'];
// }

// function setName($id, $nome)
// {
//     $sql = "UPDATE ALUNO SET NMaluno='" . $nome . "' WHERE idaluno=" . $id;

//     return updateRegistro($sql);
// }
function deletaMatricula($id)
{
    $sql = "DELETE FROM alunomatriculado WHERE idalunomatriculado = $id";   

    return deleteRegistro($sql);
}

?>