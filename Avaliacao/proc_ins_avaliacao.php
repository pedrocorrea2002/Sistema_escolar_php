<?php

require_once("../Componente/header.php");
require_once("../Avaliacao/avaliacao.php");
require_once("../Utils/valida_formulario.php");

$msg_avaliacao = "";
$status_avaliacao = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if (isset($_POST['idMateria']) && isset($_POST['dsAvaliacao'])) {
    $idMateria = $_POST['idMateria'];
    $dsAvaliacao = trim($_POST['dsAvaliacao']);

    //* VERIFICANDO SE idaluno É NÚMERO
    if(!is_numeric($idMateria)){
        $msg_avaliacao = $msg_avaliacao."Matéria inválidos<br>";
        $status_avaliacao = 1;
    }
    
    //* VERIFICANDO SE s avaliação É as pré selecionadas
    $lista = array("av1","av2","av3");
    if (!in_array($dsAvaliacao, $lista)) {
        $msg_avaliacao = $msg_avaliacao."Avaliação INVÁLIDA! <br>";
        $status_avaliacao = 1;
    }

    cadastrarAvaliacao($dsAvaliacao, $idMateria);
    header('Location: form_avaliacao.php');
}

?>