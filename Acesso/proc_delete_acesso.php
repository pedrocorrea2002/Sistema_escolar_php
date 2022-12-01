<?php
require_once("../Login/login.php");

if(isset($_POST['dslogin']))
{
    $deletar = $_POST['dslogin'];
    
    if ($delete != 'admin')
    {
        ExcluirAluno($deletar);
    }
    else header("Location: form_acesso.php?del=admin");

    header("Location: form_acesso.php?del=ok");
}
else
{
    die("falhou");
}

?>