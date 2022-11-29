<?php

require_once("../Componente/header.php");
require_once("notas.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadnotas']) && trim($_POST['cadnotas']) != "") {
    $valor = trim($_POST['cadnotas']);
    if (existenotas($valor)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        $valor = trim($_POST['cadnotas']);
        cadastrarnotas($valor);
        header('Location: form_notas.php');
    }
}
?>