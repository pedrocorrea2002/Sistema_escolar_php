<?php
require_once("../Componente/header.php");
require_once("../Avaliacao/avaliacao.php");
require_once("../Utils/valida_formulario.php");

$msg_avaliacao = "";
$status_avaliacao = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO


if (isset($_POST['idAvaliacaoUPD']) && isset($_POST['dsAvaliacao']) && isset($_POST['idMateria'])) {    
    $idMateria = $_POST['idMateria'];
    $dsAvaliacao = trim($_POST['dsAvaliacao']);
    $idAvaliacao = $_POST['idAvaliacaoUPD'];


    //* VERIFICANDO SE idaluno É NÚMERO
    if(!is_numeric($idMateria)){
        $msg_avaliacao = $msg_avaliacao."Matéria inválidos<br>";
        $status_avaliacao = 1;
    }
    
    //* VERIFICANDO SE avaliação É as pré selecionadas
    $lista = array("Av1","Av2","Av3");
    if (!in_array($dsAvaliacao, $lista)) {
        $msg_avaliacao = $msg_avaliacao."Avaliação INVÁLIDA! <br>";
        $status_avaliacao = 1;
    }

    if($msg_avaliacao = ""){
        $msg_avaliacao = updAvaliacao($idAvaliacao, $dsAvaliacao, $idMateria);
    }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_avaliacao.php' method='POST'>".
        "<input type='hidden' value='$msg_avaliacao' name='msg_avaliacao_upd' />".
        "<input type='hidden' value='$status_avaliacao' name='status_avaliacao_upd' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";

?>