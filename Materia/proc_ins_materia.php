<?php

require_once("../Componente/header.php");
require_once("materia.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadMateria']) && trim($_POST['cadMateria']) != "") {
    $valor = trim($_POST['cadMateria']);
    if (existeMateria($valor)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        $valor = trim($_POST['cadMateria']);
        cadastrarMateria($valor);
        header('Location: form_Materia.php');
    }
}
?>