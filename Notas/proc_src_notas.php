<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Notas/notas.php');

if(isset($_POST['srcNota']) && !empty(trim($_POST['srcNota']))){
    $srcNota = trim($_POST['srcNota']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcNota)){
        header("Location: form_notas.php?filter=$srcNota");
    }
}else{
    header("Location: form_notas.php");
}
?>