<?php
require_once("../Utils/mysql.php");

$sqlSelect = "select * from avaliacaoaluno where lower(notas) like '%";
$novanotas = "insert into avaliacaoaluno(idaluno, idavaliacao, nota) values (@idaluno,@idavaliacao,@nota)";


function selecionanotas($nome)
{
    global $sqlSelect;
    $sql = $sqlSelect . strtolower($nome) . "%'";

    return selectRegistros($sql);
}

function listanotas()
{
    $sqlAvaliacaoAluno = "SELECT aa.idavaliacaoaluno, av.dsavaliacao, al.nmaluno, aa.nota, aa.idavaliacao FROM avaliacaoaluno aa ".
                         "INNER JOIN avaliacao av ON av.idavaliacao = aa.idavaliacao ".
                         "INNER JOIN aluno al ON al.idaluno = aa.idaluno ". 
                         "ORDER BY aa.idavaliacaoaluno";
    
    return selectRegistros($sqlAvaliacaoAluno);
}

function existenotas($nome)
{
    $retorno = selectRegistros("select * from avaliacaoaluno where lower(notas)='" . strtolower($nome) . "'");

    if (count($retorno) > 0) return true;
    else return false;
}
function cadastrarnotas($idAluno, $idavaliacao, $nota)
{
    global $novanotas;
    $sql = str_replace('@idaluno', $idAluno, $novanotas);
    $sql = str_replace('@idavaliacao', $idavaliacao, $sql);
    $sql = str_replace('@nota', $nota, $sql);

    return insereRegistro($sql);
}

function getNotas($id)
{
    $retorno = selectRegistros("select * from avaliacaoaluno where idavaliacaoaluno = $id");

    return $retorno[0];
}

function setNotas($id, $idaluno, $idavaliacao, $nota)
{
    $sql = "UPDATE avaliacaoaluno SET idaluno = $idaluno, idavaliacao = $idavaliacao, nota = $nota WHERE idavaliacaoaluno = $id";

    return updateRegistro($sql);
}

function deletenota($id)
{
    $sql = "DELETE FROM avaliacaoaluno WHERE idavaliacaoaluno = $id";

    return deleteRegistro($sql);
}

//* PESQUISA UMA LISTA DE NOTAS COM BASE NO NOME DO ALUNO
function searchNotasByName($name){
    $sqlAvaliacaoAluno = "SELECT aa.idavaliacaoaluno, av.dsavaliacao, al.nmaluno, aa.nota, aa.idavaliacao FROM avaliacaoaluno aa ".
                         "INNER JOIN avaliacao av ON av.idavaliacao = aa.idavaliacao ".
                         "INNER JOIN aluno al ON al.idaluno = aa.idaluno ". 
                         "where al.nmaluno like '$name%'".
                         "ORDER BY aa.idavaliacaoaluno";

    return selectRegistros($sqlAvaliacaoAluno);
}

//* VERIFICA SE EXISTE UMA NOTA CADASTRADA PARA UMA TAL ALUNO
function existeNotaAluno($idaluno){
    $notas = selectRegistros("select * from avaliacaoaluno where idaluno = $idaluno");

    if (count($notas) > 0) return true;
    else return false;
}

//* VERIFICA SE EXISTE UMA NOTA CADASTRADA PARA UMA TAL AVALIAÇÃO
function existeNotaAvaliacao($idavaliacao){
    $notas = selectRegistros("select * from avaliacaoaluno where idavaliacao = $idavaliacao");

    if (count($notas) > 0) return true;
    else return false;
}

?>