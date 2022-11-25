<?php require("../Componente/header.php") ?>

<body>
    <?php
    require("../Componente/menu.php");
    require_once("aluno.php");
    ?>

    <div class="content">
        <h2>Manutenção de alunos</h2><hr/>
        <form action="proc_ins_aluno.php" method="POST">
            <label>Aluno a cadastrar: <input type="text" name="cadAluno" size="30" maxsize="30" /></label>
            <input type="submit" value="Cadastrar" />
        </form>
        <hr/>
        <?php
        $alunos = listaAlunos();

        echo "<table>" .
            "<thead>" .
            "<tr>" .
            "<th>Identificação</th>" .
            "<th>Nome:</th>" .
            "<th>Exclusão:</th>" .
            "</tr>" .
            "</thead>" .
            "<tbody> ";

        foreach ($alunos as $registro) {
            echo '    <tr>' .
                '        <td><a href=form_aluno.php?alterarid=' . $registro['idaluno'] . '>' . $registro['idaluno'] . '</a></td><br>' .
                '        <td>' . $registro['nmaluno'] . '</td>' .
                ' <td>' .
                '<form action="proc_del_aluno.php" method="POST">' .
                '    <input type="hidden" name="idalunoDEL" value="' . $registro['idaluno'] . '" />' .
                '    <input type="submit" value="Excluir" />' .
                '</form>' .
                '    </tr>';
        }
        ?>

        <tfoot>
            <tr>
                <td colspan="3">
                    <?php
                    if (isset($_GET['upd'])) echo "Registro alterado";
                    if (isset($_GET['del'])) {
                        switch ($_GET['del']) {
                            case "0":
                                echo "o registro não pode ser excluído";
                                break;
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
        <hr />
        <?php
        if (isset($_GET['alterarid'])) {
            echo '<form action="proc_upd_aluno.php" method="POST">';
            echo '    <input type="text" name="nmaluno" value=" ' . getName($_GET['alterarid']) . ' " />';
            echo '    <input type="hidden" name="idalunoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>