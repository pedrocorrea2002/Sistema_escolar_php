<?php

require_once("../Componente/header.php");
require_once("avaliacao.php");
require_once("../Utils/valida_formulario.php");

if (!caracteresInvalidos($_POST['cadAvaliacao']) && trim($_POST['cadAvaliacao']) != "") {
    $valor = trim($_POST['cadAvaliacao']);
    if (existeavaliacao($valor)) {
        die("Já existe um cadastro com esse nome.");
    } else {
        $valor = trim($_POST['cadAvaliacao']);
        cadastraravaliacao($valor);
        header('Location: form_avaliacao.php');
    }
}
?>