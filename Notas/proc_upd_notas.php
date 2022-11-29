<?php 
    require_once("../Componente/header.php");
    require_once("notas.php");
    require_once("../Utils/valida_formulario.php");

    if (isset($_POST['idnotasUPD'])){
        if(caracteresInvalidos($_POST['idnotasUPD'])){
            die("Caracteres inválidos detectados!");
        }else{
            $id = trim($_POST['idnotasUPD']);
            $nome = trim($_POST['dsnotas']);
            setName($id, $nome);
            header("Location: form_notas.php?upd=1");
        }
    }
?>


