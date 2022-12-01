<?php

require_once("../Componente/header.php");
require_once("avaliacao.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadavaliacao']) && trim($_POST['cadavaliacao']) != "") {
    $valor = trim($_POST['cadavaliacao']);
    if (existeavaliacao($valor)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        $valor = trim($_POST['cadavaliacao']);
        cadastraravaliacao($valor);
        header('Location: form_avaliacao.php');
    }
}
?>