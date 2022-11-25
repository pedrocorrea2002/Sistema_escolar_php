<?php 
    require_once("../Componente/header.php");
    require_once("aluno.php");
    require_once("../Utils/valida_formulario.php");

    if (isset($_POST['idalunoUPD'])){
        if(caracteresInvalidos($_POST['idalunoUPD'])){
            die("Caracteres inválidos detectados!");
        }else{
            $id = trim($_POST['idalunoUPD']);
            $nome = trim($_POST['nmaluno']);
            setName($id, $nome);
            header("Location: form_aluno.php?upd=1");
        }
    }
?>


