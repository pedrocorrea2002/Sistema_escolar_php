<?php
require_once('../Componente/header.php'); //* ESSE HEADER ESTÁ SENDO CHAMADO SÓ PARA PEGAR dslogin DO USUÁRIO LOGADO
require_once('../Utils/mysql.php');
require_once('../Utils/valida_formulario.php');
<<<<<<< HEAD
require_once('../Materia/materia.php');

if(isset($_POST['srcMateria']) && !empty(trim($_POST['srcMateria']))){
    $srcMateria = trim($_POST['srcMateria']);

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcMateria)){
        header("Location: form_Materia.php?filter=$srcMateria");
=======
require_once('materia.php');

echo "fora: ".$_POST['srcMateria'];

if(isset($_POST['srcMateria']) && !empty(trim($_POST['srcMateria']))){
    $srcMateria = trim($_POST['srcMateria']);
    $dslogin = $_SESSION['dslogin'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO srcAluno
    if(!caracteresInvalidos($srcMateria)){
        header("Location: form_materia.php?filter=$srcMateria");
>>>>>>> 8e00485073b29e7c50c2370f420a4644edbeada3
    }
}else{
    header("Location: form_materia.php");
}
?>