<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$user = 'root';
$password = '';
$database = 'escola_php';

# O hostname deve ser localhost no nosso exemplo
# lembre de iniciar o Apache e o Mysql 
$hostname = "localhost"; 

$sqlDeTeste = " select 'true' VAL" .
              " from DUAL;";

function iniciaConexao()
{
    global $user, $password, $database, $hostname;
    # Conecta com o servidor de banco de dados 
    $con = mysqli_connect( $hostname, $user, $password ) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    return $con;
}

function testaConexao()
{
    global $sqlDeTeste;
    $con = iniciaConexao();

    $resultado = mysqli_query($con , $sqlDeTeste);

    $registros = mysqli_num_rows($resultado);

    while ($f = mysqli_fetch_array($resultado))
    {
        echo 'Tivemos ' . $registros . ' registro(s) acessados pela função. ' . $f['VAL']; 
    }

    mysqli_close($con);
}



function insereRegistro($insert)
{
    $con = iniciaConexao();

    if (mysqli_query($con, $insert)) {
        echo "Inserido com sucesso";
    }
    else {
        echo "Erro: " . $insert . "<br />" . mysqli_error($con);
    }

    $rows = mysqli_affected_rows($con);
    mysqli_close($con);

    return $rows;
}



function deleteRegistro($delete)
{
    $con = iniciaConexao();

    if (mysqli_query($con, $delete)) {
        echo "Excluído com sucesso";
    }
    else {
        echo "Erro: " . $delete . "<br />" . mysqli_error($con);
    }

    $rows = mysqli_affected_rows($con);
    mysqli_close($con);

    return $rows;
}



function selectRegistros($select)
{
    $con = iniciaConexao();

    $resultado = mysqli_query($con , $select);
    
    $rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
    mysqli_close($con);
    
    return $rows;
}


function updateRegistro($update)
{
    $con = iniciaConexao();

    if (mysqli_query($con, $update)) {
        echo "Atualizado com sucesso";
    }
    else {
        echo "Erro: " . $update . "<br />" . mysqli_error($con);
    }

    $rows = mysqli_affected_rows($con);
    mysqli_close($con);

    return $rows;
}


//testaConexao();
//var_dump(insereRegistro("insert into aluno(nmaluno) values('aula online')"));
//var_dump(selectRegistros('SELECT * FROM ALUNO'));
//deleteRegistro('delete from aluno where idaluno = 5');
//var_dump(updateRegistro('update aluno set nmaluno="123456" where idaluno = 3'));

?>
