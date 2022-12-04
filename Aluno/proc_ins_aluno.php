<?php

require_once("../Componente/header.php");
require_once("aluno.php");
require_once("../Utils/valida_formulario.php");

$msg_aluno = "";
$status_aluno = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['nmAluno'])){
    $nmAluno = trim($_POST['nmAluno']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO nmAluno
    if(caracteresInvalidos($nmAluno)){
        $msg_aluno = $msg_aluno."Nome inválido! <br>";
        $status_aluno = 1;
    }else{
        //* VERIFICANDO SE O NOME ESCOLHIDO JÁ ESTÁ EM USO
        if(verificaNomeAluno($nmAluno)){
            $msg_aluno = $msg_aluno."O nome escolhido já está em uso! <br>";
            $status_aluno = 1;
        }
    }

    //* VERIFICANDO SE nmAluno ESTÁ VAZIO
    if($nmAluno == ""){
        $msg_aluno = $msg_aluno."Campo vazio! <br>";
        $status_aluno = 1;
    }

    if($msg_aluno == ""){
        $msg_aluno = cadastrarAluno($nmAluno);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_aluno.php' method='POST'>".
        // "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_aluno' name='msg_aluno' />".
        "<input type='hidden' value='$status_aluno' name='status_aluno' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>