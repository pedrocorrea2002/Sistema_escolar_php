<?php 
    require_once("../Componente/header.php");
    require_once("matricula.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../Login/login.php"); //verificação da exclusão

    if (isset($_POST['idmatriculaDEL'])){
        $id = trim($_POST['idmatriculaDEL']);

        if (liberarExclusao($id)){
            if ($id != 1){
                deletaMatricula($id);
                header("Location: form_matricula.php?del=1");
                exit;
            }else{
                header("Location: form_matricula.php?del=2");
                exit;
            }
        }else{
            header("Location: form_matricula.php?del=0");
            exit;
        } 
    }

    header("Location: form_matricula.php");
?>


