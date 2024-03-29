<?php
require_once("../Login/login.php");
require_once("../Aluno/aluno.php");
require_once("../Utils/valida_formulario.php");

$msg_aluno = "";
$status_aluno = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['dslogin']) && isset($_POST['idaluno'])){
    $dslogin = trim($_POST['dslogin']);
    $idaluno = $_POST['idaluno'];

    //* VERIFICANDO A PRESENÇA DE CÓDIGO MALICIOSO DENTRO DO dslogin
    if(caracteresInvalidos($dslogin)){
        $msg_aluno = $msg_aluno."Usuário inválido!<br>";
        $status_aluno = 1;
    }

    //* VERIFICANDO SE O idaluno É NÚMERO
    if(!is_numeric($idaluno)){
        $msg_aluno = $msg_aluno."Aluno inválido!<br>";
        $status_aluno = 1;
    }

    //* VERIFICANDO SE O USUÁRIO ESTÁ LOGADO
    if(!revalidarLogin()){
        $msg_aluno = $msg_aluno."Você não tem permissão para alterar essa informação, tente novamente! <br>";
        $status_aluno = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO AINDA EXISTE
    try{
        getAluno($idaluno);
    }catch(Exception $e){
        $msg_aluno = $msg_aluno."Aluno não encontrado! <br>";
        $status_aluno = 1;
    }

    //* ALTERANDO
    if($msg_aluno == ""){
        $troca = [
            "velho" => getAluno(getLogin($dslogin)['idaluno'])['nmaluno'],
            "novo" => getAluno($idaluno)['nmaluno']
        ];

        $troca = $troca["velho"].",".$troca["novo"];

        $msg_aluno = AtualizarAluno($dslogin,$idaluno);
    }
}

//* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_update_acesso.php' method='POST'>".
        "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_aluno' name='msg_aluno' />".
        "<input type='hidden' value='$status_aluno' name='status_aluno' />".
        "<input type='hidden' value='$troca' name='troca' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>
