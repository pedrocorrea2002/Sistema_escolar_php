<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from materia where lower(dsmateria) like '%";
$novaMateria = "insert into materia(dsmateria) values ('@')";

function selecionaMateria($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listaAvaliacoes()
{
    return selectRegistros("select * from avaliacao order by idavaliacao");
}

function existeMateria($nome)
{
    $retorno = selectRegistros("select * from materia where lower(dsmateria)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarMateria($nome)
{
    global $novaMateria;
    $sql = str_replace("@",$nome,$novaMateria);

    return insereRegistro($sql);
}

function getNameAvaliacao($id)
{
    $retorno = selectRegistros("select * from avaliacao where idavaliacao='" . $id . "'");

    return $retorno[0]['dsavaliacao'];
}

function setNameMateria($id, $nome)
{
    $sql = "UPDATE MATERIA SET dsmateria='" . $nome . "' WHERE idmateria=" . $id;

    return updateRegistro($sql);
}

function deleteMateria($id)
{
    $sql = "DELETE FROM MATERIA  WHERE idmateria=" . $id;   

    return deleteRegistro($sql);
}

?>