<?php
require_once("notas.php");
require_once("../Avaliacao/avaliacao.php");
require_once("../Aluno/aluno.php");

$msg_nota = "";
$status_nota = 0; //! 0 - EXECUTADO, 1 - ERRO ENCONTRADO

if(isset($_POST['idaluno']) && isset($_POST['idavaliacao']) && isset($_POST['nota']) && isset($_POST['idavaliacaoaluno'])){
    $idaluno = $_POST['idaluno'];
    $idavaliacao = $_POST['idavaliacao'];
    $nota = trim($_POST['nota']);
    $id = $_POST['idavaliacaoaluno'];
    
    //* VERIFICANDO SE TODOS OS CAMPOS SÃO NÚMEROS 
    if(!is_numeric($idaluno) || !is_numeric($idavaliacao) || !is_numeric($nota) || !is_numeric($id)){
        $msg_nota = $msg_nota."Valores inválidos!<br>";
        $status_nota = 1;
    }

    //* VERIFICANDO SE A NOTA ESCOLHIDA EXISTE ESCOLHIDA AINDA EXISTE
    try{
        getNotas($id); 
    }catch(Exception $e){
        $msg_nota = $msg_nota."Registro não encontrado, tente novamente! <br>";
        $status_nota = 1;
    }

    //* VERIFICANDO SE A AVALIAÇÃO ESCOLHIDA AINDA EXISTE
    try{
        getAvaliacao($idavaliacao); 
    }catch(Exception $e){
        $msg_nota = $msg_nota."Avaliação não encontrado! <br>";
        $status_nota = 1;
    }

    //* VERIFICANDO SE O ALUNO ESCOLHIDO AINDA EXISTE
    try{
        getAluno($idaluno);
    }catch(Exception $e){
        $msg_nota = $msg_nota."Aluno não encontrada! <br>";
        $status_nota = 1;
    }

    echo "msg_nota: $msg_nota";

     if($msg_nota == ""){
        $msg_nota = setNotas($id, $idaluno, $idavaliacao, $nota);
     }
}

// //* RETORNANDO RESPOSTA PARA O FORMULÁRIO
echo "<form id='form' action='form_notas.php' method='POST'>".
        "<input type='hidden' value='$dslogin' name='dslogin' />".
        "<input type='hidden' value='$msg_nota' name='msg_nota_upd' />".
        "<input type='hidden' value='$status_nota' name='status_nota_upd' />".
      "</form>";

echo "<script>".
        "document.getElementById('form').submit()".
      "</script>";
?>