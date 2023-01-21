<?php 
    require_once("../Componente/header.php");
    $login = trim($_SESSION['dslogin']);

    $sql_nmaluno = "SELECT a.nmaluno FROM login l INNER JOIN aluno a ON a.idaluno = l.idaluno WHERE l.dslogin = '$login'";

    $nmaluno = selectRegistros($sql_nmaluno)[0];
    $nmaluno = explode(' ',$nmaluno['nmaluno'])[0];
?>
<body>

<?php require_once("../Componente/menu.php") ?>

    <div class="content">
        <h2>Página inicial. Bem vindo <?php echo $nmaluno?>!</h2>
        <p>Escolha uma opção no menu a esquerda</p>
    </div>
</body>
</html>