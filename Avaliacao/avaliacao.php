<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from avaliacao where lower(dsavaliacao) like '%";
$novaavaliacao = "insert into avaliacao(dsavaliacao) values ('@')";

function selecionaavaliacao($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listaAvaliacoes()
{
    $sqlAvaliacao = "SELECT a.idavaliacao, a.dsavaliacao, m.dsavaliacao FROM avaliacao a ".
                         "INNER JOIN avaliacao m ON m.dsavaliacao = m.idavaliacao ".                          
                         "ORDER BY a.idavaliacao";    
    return selectRegistros($sqlAvaliacao);
    
}

function existeavaliacao($nome)
{
    $retorno = selectRegistros("select * from avaliacao where lower(dsavaliacao)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastraravaliacao($nome)
{
    global $novaavaliacao;
    $sql = str_replace("@",$nome,$novaavaliacao);

    return insereRegistro($sql);
}

function getAvaliacao($id)
{
    $retorno = selectRegistros("select * from avaliacao where idavaliacao='" . $id . "'");

    return $retorno[0];
}

function setAvaliacao($id, $nome)
{
    $sql = "UPDATE avaliacao SET dsavaliacao='" . $nome . "' WHERE idavaliacao=" . $id;

    return updateRegistro($sql);
}

function deleteavaliacao($id)
{
    $sql = "DELETE FROM avaliacao  WHERE idavaliacao=" . $id;   

    return deleteRegistro($sql);
}

?>