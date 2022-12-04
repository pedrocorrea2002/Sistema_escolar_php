<?php 
require_once("../Componente/header.php");
require_once("notas.php");
require_once("../Utils/valida_formulario.php");

if (isset($_POST['idnotasDEL'])){
    $id = trim($_POST['idnotasDEL']);

    if(!is_numeric($id)){
        header("Location: form_notas.php?del=1");
        exit;
    }

    deletenota($id);
    header("Location: form_notas.php?del=0");
    exit;
}

header("Location: form_notas.php");
?>


