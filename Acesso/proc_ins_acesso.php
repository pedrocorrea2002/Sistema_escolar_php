<?php
require_once("../Login/login.php");
require_once("../Aluno/aluno.php");

$msg_acesso = "";
$status_acesso = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['dslogin']) && isset($_POST['dssenha']) && isset($_POST['dsrepita']) && isset($_POST['idaluno'])){
    $login = trim($_POST['dslogin']);
    $senha = trim($_POST['dssenha']);
    $repita = trim($_POST['dsrepita']);
    $idaluno = $_POST['idaluno'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO login
    if(caracteresInvalidos($login)){
        $msg_acesso = $msg_acesso."Usuário inválido!<br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE A SENHA TEM 10 CARACTERES OU MENOS
    if(strlen($senha) > 10){
        $msg_acesso = $msg_acesso."A senha deve possuir 10 caracteres ou menos! <br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE A SENHA TEM 5 CARACTERES OU MAIS
    if(strlen($senha) < 5){
        $msg_acesso = $msg_acesso."A senha deve possuir 5 caracteres ou mais! <br>";
        $status_acesso = 1;
    }
    
    //* VERIFICANDO SE AS DUAS SENHAS CONFEREM
    if ($senha != $repita){
        $msg_acesso = $msg_acesso."As senhas não conferem! <br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE O USUÁRIO ESTÁ LOGADO
    if(!revalidarLogin()){
        $msg_acesso = $msg_acesso."Você não tem permissão para alterar essa informação, tente novamente! <br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE idaluno É NÚMERO
    if(!is_numeric($idaluno)){
        $msg_acesso = $msg_acesso."Aluno inválidos<br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO ESTÁ SEM USO
    $aluno_achado = false;
    foreach(ListarAlunosValidos() as $aluno){
        if($aluno['idaluno'] == $idaluno){
            $aluno_achado = true;
        }
    }

    if(!$aluno_achado){
        $msg_acesso = $msg_acesso."Aluno não encontrado ou já está em uso! <br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE O USUÁRIO ESCOLHIDO ESTÁ SEM USO
    $login_achado = false;
    foreach(ListarLogins() as $itemLogin){
        if($login['dslogin'] == $login){
            $login_achado = true;
        }
    }

    if($login_achado){
        $msg_acesso = $msg_acesso."O nome de usuário escolhido já está em uso! <br>";
        $status_acesso = 1;
    }

    //* INSERINDO
    if($msg_acesso == ""){
        $msg_acesso = cadastrarLogin($login,md5($senha),$idaluno);
    }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_acesso.php' method='POST'>".
        "<input type='hidden' value='$login' name='login' />".
        "<input type='hidden' value='$msg_acesso' name='msg_acesso' />".
        "<input type='hidden' value='$status_acesso' name='status_acesso' />".
     "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
     "</script>";

?>