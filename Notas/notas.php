<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from avaliacaoaluno where lower(notas) like '%";
$novanotas = "insert into avaliacaoaluno(notas) values ('@')";

function selecionanotas($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listanotas()
{
    return selectRegistros("select * from avaliacaoaluno");
}

function existenotas($nome)
{
    $retorno = selectRegistros("select * from avaliacaoaluno where lower(notas)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarnotas($nome)
{
    global $novanotas;
    $sql = str_replace("@",$nome,$novanotas);

    return insereRegistro($sql);
}

function getNamenotas($id)
{
    $retorno = selectRegistros("select * from avaliacaoaluno where notas='" . $id . "'");

    return $retorno[0]['dsnotas'];
}

function setNamenotas($id, $nome)
{
    $sql = "UPDATE avaliacaoaluno SET dsnotas='" . $nome . "' WHERE idnotas=" . $id;

    return updateRegistro($sql);
}

function deletenotas($id)
{
    $sql = "DELETE FROM avaliacaoaluno  WHERE idnotas=" . $id;   

    return deleteRegistro($sql);
}

?>