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

function listaMateria()
{
    return selectRegistros("select * from materia order by idmateria");
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

function getNameMateria($id)
{
    $retorno = selectRegistros("select * from materia where idmateria='" . $id . "'");

    return $retorno[0]['dsmateria'];
}

function setMateria($id, $nome)
{
    $sql = "UPDATE MATERIA SET dsmateria='" . $nome . "' WHERE idmateria=" . $id;

    return updateRegistro($sql);
}

function deleteMateria($id)
{
    $sql = "DELETE FROM MATERIA  WHERE idmateria=" . $id;   

    return deleteRegistro($sql);
}

//* PESQUISA UMA LISTA DE MATERIA COM BASE NO NOME PASSADO
function searchMateriasByName($name){
    return selectRegistros("select * from materia where dsmateria like '$name%'");
}
?>