<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Matricula/matricula.php');

if(isset($_POST['srcMatricula']) && !empty(trim($_POST['srcMatricula']))){
    $srcMatricula = trim($_POST['srcMatricula']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcMatricula)){
        header("Location: form_matricula.php?filter=$srcMatricula");
    }
}else{
    header("Location: form_matricula.php");
}
?>