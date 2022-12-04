<?php

require_once("../Componente/header.php");
require_once("materia.php");
require_once("../Utils/valida_formulario.php");

$msg_materia = "";
$status_materia = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['dsMateria']) || isset($_POST['idMateriaUPD'])){
    $dsMateria = $_POST['dsMateria'];
    $idMateria = $_POST['idMateriaUPD'];

    //* VERIFICANDO SE idMateria É NÚMERO
    if(!is_numeric($idMateria)){
        $msg_acesso = $msg_acesso."Matéria inválida<br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO nmAluno
    if(caracteresInvalidos($dsMateria)){
        $msg_materia = $msg_materia."Nome inválido! <br>";
        $status_materia = 1;
    }else{
        //* VERIFICANDO SE O NOME ESCOLHIDO JÁ ESTÁ EM USO
        foreach(listaMateria() as $materia){
            if($materia['dsmateria'] == $dsMateria && $materia['idmateria'] != $idMateria){
                $msg_materia = $msg_materia."O nome escolhido já está em uso! <br>";
                $status_materia = 1;
            }
        }
    }

    //* VERIFICANDO SE dsMateria ESTÁ VAZIO
    if($dsMateria == ""){
        $msg_materia = $msg_materia."Campo vazio! <br>";
        $status_materia = 1;
    }

    if($msg_materia == ""){
        $msg_materia = setMateria($idMateria,$dsMateria);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_materia.php' method='POST'>".
        // "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_materia' name='msg_materia_upd' />".
        "<input type='hidden' value='$status_materia' name='status_materia_upd' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>
?>