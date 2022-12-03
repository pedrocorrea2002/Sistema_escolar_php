<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Avaliacao/avaliacao.php');

if(isset($_POST['srcAvaliacao']) && !empty(trim($_POST['srcAvaliacao']))){
    $srcAvaliacao = trim($_POST['srcAvaliacao']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcAvaliacao)){
        header("Location: form_avaliacao.php?filter=$srcAvaliacao");
    }
}else{
    header("Location: form_avaliacao.php");
}
?>