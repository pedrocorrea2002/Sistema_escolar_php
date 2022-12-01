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
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* RETORNA UMA LISTA DE AVALIAÇÕES
function listaAvaliacoes()
{
    $sqlAvaliacao = "SELECT a.idavaliacao, a.dsavaliacao, m.dsavaliacao FROM avaliacao a ".
                         "INNER JOIN avaliacao m ON m.dsavaliacao = m.idavaliacao ".                          
                         "ORDER BY a.idavaliacao";    
    return selectRegistros($sqlAvaliacao);
    
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* VERIFICA SE JÁ EXISTE UMA AVALIAÇÃO COM O NOME ESCOLHIDO
function existeavaliacao($nome)
{
    $retorno = selectRegistros("select * from avaliacao where lower(dsavaliacao)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* CADASTRA AVALIAÇÃO
function cadastraravaliacao($nome)
{
    global $novaavaliacao;
    $sql = str_replace("@",$nome,$novaavaliacao);

    return insereRegistro($sql);
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* RETORNA A AVALIAÇÃO QUE POSSUIR O MESMO id QUE FOI PASSADO
function getAvaliacao($id)
{
    $retorno = selectRegistros("select * from avaliacao where idavaliacao='" . $id . "'");

    return $retorno[0];
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* ATUALIZA AVALIAÇÃO
function setAvaliacao($id, $nome)
{
    $sql = "UPDATE avaliacao SET dsavaliacao='" . $nome . "' WHERE idavaliacao=" . $id;

    return updateRegistro($sql);
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

//* DELETA AVALIAÇÃO
function deleteavaliacao($id)
{
    $sql = "DELETE FROM avaliacao  WHERE idavaliacao=" . $id;   

    return deleteRegistro($sql);
}
//! RENAN DÁ UMA CONFERIDA NA HORA QUE FOR USAR ALGUMA FUNÇÃO DAQUI, EU NÃO CHEGUEI A CONFERIR SE ESTÃO TODAS CERTAS

?>