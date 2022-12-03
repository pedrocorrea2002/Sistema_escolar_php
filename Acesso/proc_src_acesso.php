<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Login/login.php');

if(isset($_POST['srcAcesso']) && !empty(trim($_POST['srcAcesso']))){
    $srcAcesso = trim($_POST['srcAcesso']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcAcesso)){
        header("Location: form_acesso.php?filter=$srcAcesso");
    }
}else{
    header("Location: form_acesso.php");
}
?>