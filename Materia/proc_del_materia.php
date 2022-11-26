<?php 
    require_once("../Componente/header.php");
    require_once("materia.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../Materia/materia.php"); //verificação da exclusão

    if (isset($_POST['idmateriaDEL'])){
        $id = trim($_POST['idmateriaDEL']);
        if (liberarExclusao($id)){
            if ($id != 1){
                deleteMateria($id);
                header("Location: form_materia.php?del=1");
            }else{
                header("Location: form_materia.php?del=2");
            }
        }else{
            header("Location: form_materia.php?del=0");
        } 
    }
?>


