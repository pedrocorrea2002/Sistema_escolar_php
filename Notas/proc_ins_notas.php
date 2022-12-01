<?php

require_once("../Componente/header.php");
require_once("notas.php");
require_once("../Avaliacao/avaliacao.php");
require_once("../Aluno/aluno.php");
require_once("../Utils/valida_formulario.php");

$msg_nota = "";
$status_nota = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['idAluno']) && isset($_POST['idAvaliacao']) && isset($_POST['nota'])){
    $idaluno = $_POST['idAluno'];
    $idavaliacao = $_POST['idAvaliacao'];
    $nota = trim($_POST['nota']);
    
    //* VERIFICANDO SE TODOS OS CAMPOS SÃO NÚMEROS 
    if(!is_numeric($idaluno) || !is_numeric($idavaliacao) || !is_numeric($nota)){
        $msg_nota = $msg_nota."Valores inválidos!<br>";
        $status_nota = 1;
    }

    //* VERIFICANDO SE A AVALIAÇÃO ESCOLHIDA AINDA EXISTE
    try{
        getAvaliacao($idavaliacao);
    }catch(Exception $e){
        $msg_nota = $msg_nota."Avaliação não encontrada! <br>";
        $status_nota = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO AINDA EXISTE
    try{
        getAluno($idaluno);
    }catch(Exception $e){
        $msg_nota = $msg_nota."Aluno não encontrado! <br>";
        $status_nota = 1;
    }

    echo "msg_nota: $msg_nota";

     if($msg_nota == ""){
        $msg_nota = cadastrarnotas($idaluno, $idavaliacao, $nota);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_notas.php' method='POST'>".
        "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_nota' name='msg_nota' />".
        "<input type='hidden' value='$status_nota' name='status_nota' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>