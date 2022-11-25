<?php
require_once("../Login/login.php");

if (isset($_POST['nova_senha']) && isset($_POST['repita_senha']) && isset($_POST['dslogin']))
{
    $senha = trim($_POST['nova_senha']);
    $repita = trim($_POST['repita_senha']); //não se esqueçam de validar os campos
    $dslogin = $_POST['dslogin'];

    if ($senha == $repita)
    {
        $senha = md5($senha);
        //echo $senha;
        AtualizarSenha($dslogin,$senha);
        header("Location: form_update_acesso.php?senha=ok");

    }
    else
        echo "As senhas não conferem.";


}

?>