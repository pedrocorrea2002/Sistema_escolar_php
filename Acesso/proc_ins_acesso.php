<?php
require_once("../Login/login.php");
require_once("../Aluno/aluno.php");

$msg_acesso = "";
$status_acesso = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['dslogin']) && isset($_POST['dssenha']) && isset($_POST['dsrepita']) && isset($_POST['idAluno'])){
    $login = trim($_POST['dslogin']);
    $senha = trim($_POST['dssenha']);
    $repita = trim($_POST['dsrepita']);
    $idAluno = $_POST['idAluno'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO login
    if(caracteresInvalidos($login)){
        $msg_acesso = $msg_acesso."Usuário inválido!<br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DAS SENHAS
    if(caracteresInvalidos($senha) || caracteresInvalidos($repita)){
        $msg_acesso = $msg_acesso."Senhas inválidas!<br>";
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

    //* VERIFICANDO SE idAluno É NÚMERO
    if(!is_numeric($idAluno)){
        $msg_acesso = $msg_acesso."Aluno inválido<br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO ESTÁ SEM USO
    $aluno_achado = false;
    foreach(ListarLogins() as $itemLogin){
        if($itemLogin['idaluno'] == $idAluno){
            $aluno_achado = true;
        }
    }

    if($aluno_achado){
        $msg_acesso = $msg_acesso."Aluno já está em uso! <br>";
        $status_acesso = 1;
    }

    //* VERIFICANDO SE O USUÁRIO ESCOLHIDO ESTÁ SEM USO
    $login_achado = false;
    foreach(ListarLogins() as $itemLogin){
        if($itemLogin['dslogin'] == $login){
            $login_achado = true;
        }
    }

    if($login_achado){
        $msg_acesso = $msg_acesso."O nome de usuário escolhido já está em uso! <br>";
        $status_acesso = 1;
    }

    //* INSERINDO
    if($msg_acesso == ""){
        $msg_acesso = cadastrarLogin($login,md5($senha),$idAluno);
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