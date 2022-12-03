<?php 
    require_once("../Componente/header.php");
    require_once("materia.php");
    require_once("../Utils/valida_formulario.php");

    if (isset($_POST['idMateriaUPD']) && isset($_POST['dsmateria'])){
        if(caracteresInvalidos($_POST['dsmateria'])){
            die("Caracteres inválidos detectados!");
        }else{
            $id = trim($_POST['idMateriaUPD']);
            $nome = trim($_POST['dsmateria']);
            setMateria($id, $nome);
            header("Location: form_materia.php?upd=1");
        }
    }
?>


