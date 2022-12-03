<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
require_once('../Materia/materia.php');

if(isset($_POST['srcMateria']) && !empty(trim($_POST['srcMateria']))){
    $srcMateria = trim($_POST['srcMateria']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcMateria)){
        header("Location: form_Materia.php?filter=$srcMateria");
    }
}else{
    header("Location: form_materia.php");
}
?>