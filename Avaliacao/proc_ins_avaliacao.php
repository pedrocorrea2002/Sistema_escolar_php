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
        $msg_avaliacao = $msg_avaliacao."Matéria inválida! <br>";
        $status_avaliacao = 1;
    }
    
    //* VERIFICANDO SE s avaliação É as pré selecionadas
    $lista = array("Av1","Av2","Av3");
    if (!in_array($dsAvaliacao, $lista)) {
        $msg_avaliacao = $msg_avaliacao."Avaliação inválida! <br>";
        $status_avaliacao = 1;
    }

    //* VERIFICANDO SE JÁ EXISTE UMA OUTRA AVALIAÇÃO COM OS MESMO CAMPOS
    if($msg_avaliacao == ""){
        foreach(listaAvaliacoes() as $avaliacao){
            if($avaliacao['idmateria'] == $idMateria && $avaliacao['dsavaliacao'] == $dsAvaliacao){
                $msg_avaliacao = $msg_avaliacao."Avaliação já inserida! <br>";
                $status_avaliacao = 1;
            }
        }
    }

    if($msg_avaliacao == ""){ 
        $msg_avalicao = cadastrarAvaliacao($dsAvaliacao, $idMateria);
    }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_avaliacao.php' method='POST'>".
        "<input type='hidden' value='$msg_avaliacao' name='msg_avaliacao' />".
        "<input type='hidden' value='$status_avaliacao' name='status_avaliacao' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";

?>