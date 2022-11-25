<?php
    require_once("../login/login.php");
    
    if(!revalidarLogin()) {
      header("Location: ../login/form_login.php?erro=usui");
      //var_dump($_SESSION);
      exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Administração do curso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
