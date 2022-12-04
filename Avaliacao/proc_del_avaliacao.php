<?php 
    require_once("../Componente/header.php");
    require_once("avaliacao.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../avaliacao/avaliacao.php"); //verificação da exclusão
    require_once("../Notas/notas.php");

    if (isset($_POST['idavaliacaoDEL'])){
        $id = $_POST['idavaliacaoDEL'];        

        if(!is_numeric($id)){
            header("Location: form_avaliacao.php?del=2");
            exit;
        }

        if(existeNotaAvaliacao($id)){
            header("Location: form_avaliacao.php?del=0");
            exit;
        }

        deleteavaliacao($id);
        header("Location: form_avaliacao.php?del=1");
        exit;
    }

    header("Location: form_avaliacao.php");
?>


