<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Administração do curso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body style="padding: 0px; margin: 0px;">
    <div class="grid-container">
        <div class="header">
            <h2>Administração do curso</h2>
        </div>

        <div class="left">&nbsp;</div>
        <div class="middle">
            <?php
            include('../Utils/valida_formulario.php');
            ?>
            <form action="proc_login.php" method="POST">
                <label><input type="text" name="dslogin" placeholder="Digite aqui seu nome de usuário"/></label> <br />
                <label><input type="password" name="dssenha" placeholder="Digite aqui sua senha"/></label> <br />
                <div class="button-box">
                    <input class="button" type="submit" value="Acessar" />
                </div>
            </form>

            <?php
            if (isset($_GET['erro'])) {
                if (array_key_exists($_GET['erro'], $tabela_de_erro)) {
                    echo '<br /><span style="color:red; font-weight:bold">' . $tabela_de_erro[$_GET['erro']] . '</span><br />';
                }
            }
            ?>
        </div>
        <div class="right">&nbsp;</div>
    </div>

</body>
</html>