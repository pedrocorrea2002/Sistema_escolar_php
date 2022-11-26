<?php

require_once("../Componente/header.php");
require_once("matricula.php");
require_once("../Utils/valida_formulario.php");

$idaluno = $_POST['cadAluno'];
$idmateria = $_POST['cadMateria'];

if (is_numeric($idaluno) && is_numeric($idmateria)) {
    if (existeMatricula($idaluno, $idmateria)) {
        die("Já existe um cadastro com essa mesma combinação de informações.");
    } else {
        cadastrarMatricula($idaluno,$idmateria);
        header('Location: form_matricula.php');
    }
}
?>