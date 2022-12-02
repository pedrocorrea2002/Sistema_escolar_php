<?php 
    require_once("../Componente/header.php");
    require_once("avaliacao.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../avaliacao/avaliacao.php"); //verificação da exclusão
    require_once("../Notas/notas.php");

    if (isset($_POST['idavaliacaoDEL'])){
        $id = $_POST['idavaliacaoDEL'];        

        $listaNotas = listaNotas();

        foreach($listaNotas as $nota){
            if($nota['idavaliacao'] == $id){
                header("Location: form_avaliacao.php?del=0");
            }
        }

        deleteavaliacao($id);

        header("Location: form_avaliacao.php?del=1");
    }
?>


