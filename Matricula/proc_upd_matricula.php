<?php

require_once("../Componente/header.php");
require_once("../Utils/valida_formulario.php");
require_once("matricula.php");
require_once("../Aluno/aluno.php");
require_once("../Materia/materia.php");

$msg_matricula = "";
$status_matricula = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['idAluno']) && $_POST['idMateria'] && $_POST['idMatricula']){
    $idMatricula = $_POST['idMatricula'];
    $idAluno = $_POST['idAluno'];
    $idMateria = $_POST['idMateria'];

    //* VERIFICANDO SE TODOS OS CAMPOS SÃO NÚMEROS 
    if(!is_numeric($idAluno) || !is_numeric($idMateria) || !is_numeric($idMatricula)){
        $msg_matricula = $msg_matricula."Valores inválidos!<br>";
        $status_matricula = 1;
    }

    //* VERIFICANDO SE A MATRÍCULA ESCOLHIDA AINDA EXISTE
    try{
        if($status_matricula != 1){
            getMatricula($idMatricula);
        }
    }catch(Exception $e){
        $msg_matricula = $msg_matricula."Registro não encontrado, tente novamente!! <br>";
        $status_matricula = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO AINDA EXISTE
    try{
        if($status_matricula != 1){
            getAluno($idaluno);
        }
    }catch(Exception $e){
        $msg_matricula = $msg_matricula."Aluno não encontrado! <br>";
        $status_matricula = 1;
    }

    //* VERIFICANDO SE A MATÉRIA ESCOLHIDA AINDA EXISTE
    try{
        if($status_matricula != 1){
            getMateria($idMateria);
        }
    }catch(Exception $e){
        $msg_matricula = $msg_matricula."Matéria não encontrada! <br>";
        $status_matricula = 1;
    }

    if($msg_matricula == ""){
        $msg_matricula = setMatricula($idMatricula,$idAluno,$idMateria);
     }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_matricula.php' method='POST'>".
        // "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_matricula' name='msg_matricula_upd' />".
        "<input type='hidden' value='$status_matricula' name='status_matricula_upd' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>