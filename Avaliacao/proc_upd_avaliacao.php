<?php 
    require_once("../Componente/header.php");
    require_once("avaliacao.php");
    require_once("../Utils/valida_formulario.php");

    if (isset($_POST['idavaliacaoUPD'])){
        if(caracteresInvalidos($_POST['idavaliacaoUPD'])){
            die("Caracteres inválidos detectados!");
        }else{
            $id = trim($_POST['idavaliacaoUPD']);
            $nome = trim($_POST['dsavaliacao']);
            setName($id, $nome);
            header("Location: form_avaliacao.php?upd=1");
        }
    }
?>


