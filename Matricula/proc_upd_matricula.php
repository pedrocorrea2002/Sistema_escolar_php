<?php 
    require_once("../Componente/header.php");
    require_once("matricula.php");
    require_once("../Utils/valida_formulario.php");

    $id = $_POST['idmatricula'];
    $idaluno = $_POST['idaluno'];
    $idnotas = $_POST['idnotas'];

    if (is_numeric($idaluno) && is_numeric($idnotas)) {
        if (existeMatricula($idaluno, $idnotas)) {
            die("Já existe um cadastro com essa mesma combinação de informações.");
        } else {
            setMatricula($id,$idaluno,$idnotas);
            header('Location: form_matricula.php');
        }
    }
?>


