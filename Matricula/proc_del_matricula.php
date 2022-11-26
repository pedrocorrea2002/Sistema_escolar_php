<?php 
    require_once("../Componente/header.php");
    require_once("aluno.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../Login/login.php"); //verificação da exclusão

    if (isset($_POST['idalunoDEL'])){
        if (caracteresInvalidos($_POST['idalunoDEL'])){
            die("Caracteres inválidos detectados!");
        }
        else{
            $id = trim($_POST['idalunoDEL']);
            if (liberarExclusao($id)){
                if ($id != 1){
                    delID($id);
                    header("Location: form_aluno.php?del=1");
                }else{
                    header("Location: form_aluno.php?del=2");
                }
            }else{
                header("Location: form_aluno.php?del=0");
            } 
        }
    }
?>


