<?php require_once("../Componente/header.php") ?>

<body>
<div class="content">
    <?php 
    require_once("../Componente/menu.php");
    require_once("../Login/login.php");
    ?>
    <h2>Atualize sua senha:</h2>
    <hr />
    <form action="proc_update_senha.php" method="POST">
        <input type="hidden" name="dslogin" value="<?php echo $_POST['dslogin']; ?>">
        <label>Digite a senha:<input type="password" name="nova_senha" maxlength=10 /></label> <br />
        <label>Repita a senha:<input type="password" name="repita_senha" maxlength=10 /> </label>
        <br />
        <input type="submit" value="Alterar senha">
    </form>
    <hr />
    <form action="proc_upd_alunoacesso.php" method="POST">
        <input type="hidden" name="dslogin" value="<?php echo $_POST['dslogin'] ?>">
        <label>Escolha qual aluno atribuir para <?php echo $_POST['dslogin'] ?>
        <select name="idaluno">
            <option selected></option>
            <?php
            $alunos = ListarAlunosValidos();

            foreach ($alunos as $aluno) {
                echo '<option value="' . $aluno['idaluno'] . '">' . $aluno['nmaluno'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Atualizar">
    </form>
</div>