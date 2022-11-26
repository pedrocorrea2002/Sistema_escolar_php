<?php 
    require_once("../Componente/header.php");
    require_once("matricula.php");
    require_once("../Utils/valida_formulario.php");

    $id = $_POST['idmatricula'];
    $idaluno = $_POST['idaluno'];
    $idmateria = $_POST['idmateria'];

    if (is_numeric($idaluno) && is_numeric($idmateria)) {
        if (existeMatricula($idaluno, $idmateria)) {
            die("Já existe um cadastro com essa mesma combinação de informações.");
        } else {
            setMatricula($id,$idaluno,$idmateria);
            header('Location: form_matricula.php');
        }
    }
?>


