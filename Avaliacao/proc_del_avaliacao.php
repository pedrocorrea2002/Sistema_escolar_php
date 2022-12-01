<?php 
    require_once("../Componente/header.php");
    require_once("avaliacao.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../avaliacao/avaliacao.php"); //verificação da exclusão

    if (isset($_POST['idavaliacaoDEL'])){
        $id = trim($_POST['idavaliacaoDEL']);
        // liberarExclusao($id)          
                deleteavaliacao($id);
                header("Location: form_avaliacao.php?del=1");
                }
?>


