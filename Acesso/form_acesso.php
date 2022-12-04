<?php require_once("../Componente/header.php");
require_once("../Componente/menu.php");
require_once("../Login/login.php");

$logins = [];
$filter = "";

//* SE HOUVER FILTRO $logins, VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $logins = searchAcessosByUsuario($filter);
} else {
    $logins = ListarTodosLogin();
}
?>

<div class="content">
    <h2>Administração de acessos</h2>
    <hr>
    <!-- FORM DE PESQUISA -->
    <form method="POST" action="./proc_src_acesso">
        <label>
            Pesquisar acesso:
            <input type="text" name="srcAcesso" value="<?php echo $filter ?>" />
            <input type="submit" value="Pesquisar">
        </label>
    </form>
    <hr>
    <!-- FORM DE CADASTRO -->
    <form action="proc_ins_acesso.php" method="POST">
        <label>Usuário: <input type="text" name=dslogin> </label>
        <label>Senha: <input type="password" name=dssenha> </label>
        <label>Repita a senha: <input type="password" name=dsrepita> </label>
        <select name="idAluno">
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
    if (isset($_POST['msg_acesso']) && isset($_POST['status_acesso'])) {
        if ($_POST['status_acesso'] == 0) {
            echo "<p style='color:green; font-weight:bolder'>Acesso inserido com sucesso!</p>";
        } else {
            echo "<p style='color:red; font-weight:bolder'>" . $_POST['msg_acesso'] . "</p>";
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
            foreach ($logins as $login) {
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
                <td colspan="5">
                    <?php
                    if (isset($_GET['del'])) {
                        switch ($_GET['del']) {
                            case "1":
                                echo "registro excluído";
                                break;
                            case "2":
                                echo "O administrador não pode ser excluído";
                                break;
                            default:
                                echo "comando inválido";
                        }
                    }
                ?></td>
            </tr>
        </tfoot>
    </table>
</div>