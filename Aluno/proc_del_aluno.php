<?php 
require_once("../Componente/header.php");
require_once("aluno.php");
require_once("../Utils/valida_formulario.php");
require_once("../Login/login.php"); //verificação da exclusão
require_once("../Matricula/matricula.php");
require_once("../Notas/notas.php");

if (isset($_POST['idalunoDEL'])){
    $id = $_POST['idalunoDEL'];

    if (!is_numeric($id)){
        header("Location: form_aluno.php?del=2");
        exit;
    }

    if (!liberarExclusao($id) || existeMatriculaAluno($id) || existeNotaAluno($id)){
        header("Location: form_aluno.php?del=0");
        exit;
    }

    deleteAluno($id);
    header("Location: form_aluno.php?del=1");
    exit;
}

header("Location: form_aluno.php");
?>