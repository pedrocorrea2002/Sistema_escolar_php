<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Aluno/aluno.php');

echo "fora: ".$_POST['srcAluno'];

if(isset($_POST['srcAluno']) && !empty(trim($_POST['srcAluno']))){
    $srcAluno = trim($_POST['srcAluno']);
    $dslogin = $_SESSION['dslogin'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcAluno)){
        header("Location: form_aluno.php?filter=$srcAluno");
    }
}else{
    header("Location: form_aluno.php");
}
?>