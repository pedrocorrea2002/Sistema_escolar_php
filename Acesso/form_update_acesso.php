<?php require_once("../Componente/header.php") ?>

<body>
<div class="content">
    <?php 
    require_once("../Componente/menu.php");
    require_once("../Login/login.php");
    ?>
    <h2>Atualizar dados do usuário</h2>
    <hr />
    <form action="proc_update_senha.php" method="POST">
        <p>Alterar senha do usuário <?php echo "<b>".$_POST['dslogin']."</b>:"?></p>
        <input type="hidden" name="dslogin" value="<?php echo $_POST['dslogin']; ?>">
        <label>Digite a senha: <input type="password" name="nova_senha" maxlength=10 /></label> <br />
        <label>Repita a senha: <input type="password" name="repita_senha" maxlength=10 /> </label>
        <br/><br/>
        <input type="submit" value="Alterar senha">
    </form>
    <?php
        if(isset($_POST['msg_senha']) && isset($_POST['status_senha'])){
            if($_POST['status_senha'] == 0){
                echo "<p style='color:green; font-weight:bolder'>Senha alterada com sucesso!</p>";
            }else{
                echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_senha']."</p>";
            }
        }
    ?>
    <hr />
    <form action="proc_upd_alunoacesso.php" method="POST">
        <label>Alterar o aluno vinculado ao usuário <?php echo "<b>".$_POST['dslogin']."</b> para: "?>
        <input type="hidden" name="dslogin" value="<?php echo $_POST['dslogin'] ?>">
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

        <?php
            if(isset($_POST['msg_aluno']) && isset($_POST['status_aluno'])){
                if($_POST['status_aluno'] == 0){
                    echo "<p style='color:green; font-weight:bolder'>Aluno alterado com sucesso!</p>";
                }else{
                    echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_aluno']."</p>";
                }
            }
        ?>
    </form>
</div>