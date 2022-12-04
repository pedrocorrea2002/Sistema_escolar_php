<?php

require_once("../Componente/header.php");
require_once("materia.php");
require_once("../Utils/valida_formulario.php");

$msg_materia = "";
$status_materia = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['dsMateria'])){
    $dsMateria = $_POST['dsMateria'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO nmAluno
    if(caracteresInvalidos($dsMateria)){
        $msg_materia = $msg_materia."Nome inválido! <br>";
        $status_materia = 1;
    }else{
        //* VERIFICANDO SE O NOME ESCOLHIDO JÁ ESTÁ EM USO
        if(verificaNomeMateria($dsMateria)){
            $msg_materia = $msg_materia."O nome escolhido já está em uso! <br>";
            $status_materia = 1;
        }
    }

    //* VERIFICANDO SE dsMateria ESTÁ VAZIO
    if($dsMateria == ""){
        $msg_materia = $msg_materia."Campo vazio! <br>";
        $status_materia = 1;
    }

    if($msg_materia == ""){
        $msg_materia = cadastrarMateria($dsMateria);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_materia.php' method='POST'>".
        // "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_materia' name='msg_materia' />".
        "<input type='hidden' value='$status_materia' name='status_materia' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>
?>