<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from avaliacao where lower(dsavaliacao) like '%";
$novaavaliacao = "insert into avaliacao(dsavaliacao, idmateria) values ('@dsavaliacao', @idmateria)";

function selecionaavaliacao($nome){
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

// Restorna Select da tabela TIpo avaliacao
function ListaAv()
{
    $sqlAv = "Select * From tipoavaliacao";
    return selectRegistros($sqlAv);
}

//* RETORNA UMA LISTA DE AVALIAÇÕES
function listaAvaliacoes(){
    $sqlAvaliacao = "SELECT * FROM avaliacao A ".
                         "INNER JOIN materia M ON M.idmateria = A.idmateria ".  # INNER JOIN outra_tabela ot ON ot.chave_estrangeira = tb.chave_estrangeira_equivalente                       
                         "ORDER BY A.idavaliacao";
    return selectRegistros($sqlAvaliacao);
}

//* VERIFICA SE JÁ EXISTE UMA AVALIAÇÃO COM O NOME ESCOLHIDO
function existeavaliacao($nome){
    $retorno = selectRegistros("select * from avaliacao where lower(dsavaliacao)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}

//* CADASTRA AVALIAÇÃO
function cadastrarAvaliacao($dsavaliacao, $idmateria){
    global $novaavaliacao;
    $sql = str_replace("@dsavaliacao",$dsavaliacao,$novaavaliacao);
    $sql = str_replace("@idmateria",$idmateria,$sql);
    return insereRegistro($sql);
}

//* RETORNA A AVALIAÇÃO QUE POSSUIR O MESMO id QUE FOI PASSADO
function getAvaliacao($id){
    $retorno = selectRegistros("select * from avaliacao where idavaliacao='" . $id . "'");

    return $retorno[0];
}

//* ATUALIZA AVALIAÇÃO
function updAvaliacao($id, $dsavaliacao, $idmateria){
    $sql = "UPDATE avaliacao SET dsavaliacao = '$dsavaliacao', idmateria = $idmateria WHERE idavaliacao = $id";

    return updateRegistro($sql);
}

//* DELETA AVALIAÇÃO
function deleteavaliacao($id){
    $sql = "DELETE FROM avaliacao  WHERE idavaliacao=" . $id;   

    return deleteRegistro($sql);
}

//* PESQUISA UMA LISTA DE AVALIAÇÃO COM BASE NO NOME PASSADO
function searchAvaliacoesByName($name){
    $sqlAvaliacao = "SELECT * FROM avaliacao A ".
    "INNER JOIN materia M ON M.idmateria = A.idmateria ".  # INNER JOIN outra_tabela ot ON ot.chave_estrangeira = tb.chave_estrangeira_equivalente                       
    "where A.dsavaliacao like '$name%' ORDER BY A.idavaliacao";

    return selectRegistros($sqlAvaliacao);
}

//* VERIFICA SE EXISTE UMA AVALIAÇÃO CADASTRADA PARA UMA TAL MATÉRIA
function existeAvaliacaoMateria($idmateria){
    $avaliacoes = selectRegistros("select * from avaliacao where idmateria = $idmateria");

    if (count($avaliacoes) > 0) return true;
    else return false;
}

?>