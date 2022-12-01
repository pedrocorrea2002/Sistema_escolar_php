<?php
require_once("../Login/login.php");

$msg_senha = "";
$status_senha = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if (isset($_POST['nova_senha']) && isset($_POST['repita_senha']) && isset($_POST['dslogin']))
{
    $senha = trim($_POST['nova_senha']);
    $repita = trim($_POST['repita_senha']); //não se esqueçam de validar os campos
    $dslogin = $_POST['dslogin'];
    
    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO dslogin
    if(caracteresInvalidos($dslogin)){
        $msg_aluno = $msg_aluno."Usuário inválido!<br>";
        $status_aluno = 1;
    }

    //* VERIFICADO SE AS SENHAS ESTÃO PREENCHIDAS
    if(empty($senha) || empty($repita)){
        $msg_senha = $msg_senha."Os campos não podem estar vazios! <br>";
        $status_senha = 1;
    }

    //* VERIFICANDO SE A SENHA TEM 10 CARACTERES OU MENOS
    if(strlen($senha) > 10){
        $msg_senha = $msg_senha."A senha deve possuir 10 caracteres ou menos! <br>";
        $status_senha = 1;
    }

    //* VERIFICANDO SE A SENHA TEM 5 CARACTERES OU MAIS
    if(strlen($senha) < 5){
        $msg_senha = $msg_senha."A senha deve possuir 5 caracteres ou mais! <br>";
        $status_senha = 1;
    }
    
    //* VERIFICANDO SE AS DUAS SENHAS CONFEREM
    if ($senha != $repita){
        $msg_senha = $msg_senha."As senhas não conferem! <br>";
        $status_senha = 1;
    }

    //* VERIFICANDO SE O USUÁRIO ESTÁ LOGADO
    if(!revalidarLogin()){
        $msg_senha = $msg_senha."Você não tem permissão para alterar essa informação, tente novamente! <br>";
        $status_senha = 1;
    }

    //* ALTERANDO
    if($msg_senha == ""){
        $msg_aluno = AtualizarSenha($dslogin,md5($senha));
    }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_update_acesso.php' method='POST'>".
        "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_senha' name='msg_senha' />".
        "<input type='hidden' value='$status_senha' name='status_senha' />".
     "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
     "</script>";
?>