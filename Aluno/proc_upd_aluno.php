<?php
require_once("../Componente/header.php");
require_once("aluno.php");
require_once("../Utils/valida_formulario.php");

$msg_aluno = "";
$status_aluno = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['nmAluno']) && isset($_POST['idalunoUPD'])){
    $idAluno = $_POST['idalunoUPD'];
    $nmAluno = trim($_POST['nmAluno']);

    //* VERIFICANDO SE idAluno É NÚMERO
    if(!is_numeric($idAluno)){
        $msg_aluno = $msg_aluno."Aluno inválido! <br>";
        $status_aluno = 1;
    }

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO nmAluno
    if(caracteresInvalidos($nmAluno)){
        $msg_aluno = $msg_aluno."Nome inválido! <br>";
        $status_aluno = 1;
    }else{
        //* VERIFICANDO SE O NOME ESCOLHIDO JÁ ESTÁ EM USO
        foreach(listaAlunos() as $aluno){
            if($aluno['nmaluno'] == $nmAluno && $aluno['idaluno'] != $idAluno){
                $msg_aluno = $msg_aluno."O nome escolhido já está em uso! <br>";
                $status_aluno = 1;
            }
        }
    }

    //* VERIFICANDO SE nmAluno ESTÁ VAZIO
    if($nmAluno == ""){
        $msg_aluno = $msg_aluno."Campo vazio! <br>";
        $status_aluno = 1;
    }

    if($msg_aluno == ""){
        $msg_aluno = setAluno($idAluno,$nmAluno);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_aluno.php' method='POST'>".
        // "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_aluno' name='msg_aluno_upd' />".
        "<input type='hidden' value='$status_aluno' name='status_aluno_upd' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>