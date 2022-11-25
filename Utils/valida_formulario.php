<?php
/*
Trata-se penas de um modelo didático. Não é uma solução profissional
*/
$tabela_de_erro = array(
    "tams" => "Tamanho de senha inválido!",
    "tamu" => "Tamanho de usuario inválido!",
	"tame" => "Tamanho de e-mail inválido!",
    "inva" => "Caracteres inválidos",
    "nulo" => "Tamanho nulo não suportado",
    "ema1" => "Formato de e-mail inválido",
    "usui" => "Usuário inválido",
    "seni" => "Senha inválida"
);


$tamanhoMaxEmail = 150;
$tamanhoMinSenha = 5;
$tamanhoMinUsuario = 5;

function caracteresInvalidos($valor)
{
    if (strstr($valor, '"')) return true;
    if (strstr($valor, "'")) return true;
    if (strstr($valor, '>')) return true;
    if (strstr($valor, '<')) return true;
    if (strstr($valor, '--')) return true;

    return false;
}

function validaEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }

    return false;
}

function membroValido($valor, $tipo)
{
    global $tabela_de_erro, $tamanhoMaxEmail, $tamanhoMinSenha, $tamanhoMinUsuario;

    if ($valor == "") return $tabela_de_erro["nulo"];

    //falar sobre o break inexistente no código
    switch ($tipo) {
        case "email":
            if (strlen($valor) <= $tamanhoMaxEmail) return $tabela_de_erro["tame"];
            if (!validaEmail($valor)) return $tabela_de_erro["ema1"];
        case "senha":
            if (strlen($valor) < $tamanhoMinSenha) return $tabela_de_erro["tams"];
        case "usuario":
            if (strlen($valor) < $tamanhoMinUsuario) return $tabela_de_erro["tamu"];
        default:
            if (caracteresInvalidos($valor)) return $tabela_de_erro["inva"];
            return "1";
    }


    return "1";
}

function textoLivre($texto)
{
    $tratado = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    return $tratado;
}

//var_dump($tabela_de_erro);
//echo $tabela_de_erro["tama"];
//var_dump(caracteresInvalidos('<'));
//var_dump(membroValido("valorsenha","senha"));
//var_dump(membroValido("valorsenh","senha"));
//var_dump(membroValido("valorsenha<","senha"));
?>