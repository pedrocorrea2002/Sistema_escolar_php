<?php 
    require_once("../Componente/header.php");
    require_once("materia.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../Materia/materia.php"); //verificação da exclusão

    if (isset($_POST['idmateriaDEL'])){
        $id = trim($_POST['idmateriaDEL']);
        // liberarExclusao($id)          
                deleteMateria($id);
                header("Location: form_materia.php?del=1");
                }
?>


