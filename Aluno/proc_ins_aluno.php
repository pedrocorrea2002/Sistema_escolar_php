<?php

require_once("../Componente/header.php");
require_once("aluno.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadAluno']) && trim($_POST['cadAluno']) != "") {
    $nmaluno = trim($_POST['cadAluno']);

    if (existeAluno($nmaluno)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        cadastrarAluno($nmaluno);
        header('Location: form_aluno.php');
    }
}
?>