<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Avaliacao/avaliacao.php');

if(isset($_POST['tipo']) && isset($_POST['materia'])){
    $tipo = trim($_POST['tipo']);
    $materia = trim($_POST['materia']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcAvaliacao) && !caracteresInvalidos($campo)){
        header("Location: form_avaliacao.php?tipo=$tipo&materia=$materia");
    }
}else{
    header("Location: form_avaliacao.php");
}
?>