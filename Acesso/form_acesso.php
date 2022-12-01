<?php require_once("../Componente/header.php");
require_once("../Componente/menu.php");
require_once("../Login/login.php");
?>

<div class="content">
    <h2>Manutenção de alunos </h2>
    <hr />

    <form action="proc_ins_acesso.php" method="POST">
        <label>Usuário: <input type="text" name=dslogin> </label>
        <label>Senha: <input type="password" name=dssenha> </label>
        <label>Repita a senha: <input type="password" name=dsrepita> </label>
        <select name="idaluno">
            <option selected></option>

            <?php
            $alunos = ListarAlunosValidos();

            foreach ($alunos as $aluno) {
                echo '<option value="' . $aluno['idaluno'] . '">' . $aluno['nmaluno'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="cadastrar">
    </form>

    <?php
        if(isset($_POST['msg_acesso']) && isset($_POST['status_acesso'])){
            if($_POST['status_acesso'] == 0){
                echo "<p style='color:green; font-weight:bolder'>Acesso inserido com sucesso!</p>";
            }else{
                echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_acesso']."</p>";
            }
        }
    ?>

    <hr />

    <table style="border: 1px; border-color:black;">
        <thead>
            <th>Usuário</th>
            <th>Senha</th>
            <th>Aluno</th>
            <th>Atualizar </th>
            <th> Excluir </th>
        </thead>
        <tbody>
            
            <?php
            $listagem = ListarTodosLogin();
            foreach ($listagem as $login) {
                echo "<tr>" .
                    "<td>" . $login['dslogin'] . "</td>" .
                    "<td>" . $login['dssenha'] . "</td>" .
                    "<td>" . $login['nmaluno'] . "</td>" .
                    "<td>" .
                    '<form action="form_update_acesso.php" method="POST">' .
                    '<input type="hidden" value="' . $login['dslogin'] .  '" name="dslogin" />' .
                    '<input type="submit" value="X">' .
                    "</form>" .
                    "</td>" .
                    "<td>" .
                    '<form action="proc_delete_acesso.php" method="POST">' .
                    '<input type="hidden" value="' . $login['dslogin'] .  '" name="dslogin" />' .
                    '<input type="submit" value="X">' .
                    "</form>" .
                    "</td>" .
                    "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"></td>
            </tr>
        </tfoot>
    </table>
</div>