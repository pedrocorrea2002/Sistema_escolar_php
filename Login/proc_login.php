<?php

require_once('login.php');

if (empty($_POST['dslogin']) || empty($_POST['dssenha'])){
    header('Location: form_login.php');
    exit;
}

require_once("../Utils/valida_formulario.php");

if (membroValido($_POST['dslogin'],"usuario") != "1"){
    header('Location: form_login.php?erro=usui');
    exit;

    if (membroValido($_POST['dssenha'],"senha") != "1"){
        header('Location: form_login.php?erro=seni');
        exit;
    }
}
/*else{
    echo "aqui else erro<br />";
    //header('Location: form_login.php?erro=usui');
    exit;
}*/


$login = trim($_POST['dslogin']);
$senha = trim($_POST['dssenha']);


if (verificarLogin($login, $senha)){
    //var_dump($login . " " . $senha);

    $token = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    //var_dump(md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

    //var_dump($_SERVER['REMOTE_ADDR']);

    //var_dump($_SERVER['HTTP_USER_AGENT']);

    //var_dump($_SERVER);

    //die("pausa");

    session_name($token);

    session_start();

    $_SESSION['dslogin'] = $login;
    $_SESSION['dssenha'] = $senha;
    $_SESSION['token'] = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    //var_dump($_SESSION);
    header('Location: ../index/form_inicial.php');
}else{
    header('Location: form_login.php?erro=usui');
}
