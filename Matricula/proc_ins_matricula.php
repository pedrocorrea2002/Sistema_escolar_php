<?php

require_once("../Componente/header.php");
require_once("aluno.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadAluno']) && trim($_POST['cadAluno']) != "") {
    $valor = trim($_POST['cadAluno']);
    if (existeAluno($valor)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        $valor = trim($_POST['cadAluno']);
        cadastrarAluno($valor);
        header('Location: form_aluno.php');
    }
}
?>