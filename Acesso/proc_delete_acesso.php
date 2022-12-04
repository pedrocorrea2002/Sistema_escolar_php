<?php
require_once("../Login/login.php");
require_once("../Utils/valida_formulario.php");

if(isset($_POST['dslogin'])){
    $dslogin = $_POST['dslogin'];
    
    if(caracteresInvalidos($dslogin)){
        header("Location: form_acesso.php?del=3");
        die();
    }

    if ($dslogin != 'admin'){
        ExcluirAcesso($dslogin);
        header("Location: form_acesso.php?del=1");
        die();
    }else {
        header("Location: form_acesso.php?del=2");
        die();
    }
}

header("Location: form_acesso.php");
?>