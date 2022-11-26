<?php 
    require_once("../Componente/header.php");
    require_once("matricula.php");
    require_once("../Aluno/aluno.php");

    $alunos = listaAlunos();
    $matriculas = listaMatriculas();
?>

<body>
    <?php
    require_once("../Componente/menu.php");
    ?>

    <div class="content">
        <h2>Manutenção de matrículas</h2><hr/>
        <form action="proc_ins_matricula.php" method="POST">
            <label style="margin-right:20px">
                Aluno:
                <select name="cadAluno">
                    <?php foreach($alunos as $aluno){?>
                        <option value="<?php echo $aluno["idaluno"] ?>">
                            <?php echo $aluno["nmaluno"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <label>
                Matéria:
                <select name="cadAluno">
                    <?php foreach($alunos as $aluno){?>
                        <option value="<?php echo $aluno["idaluno"] ?>">
                            <?php echo $aluno["nmaluno"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <input type="submit" value="Cadastrar" />
        </form>
        <hr/>
        <?php

        echo "<table>" .
            "<thead>" .
            "<tr>" .
            "<th>Identificação</th>" .
            "<th>Nome:</th>" .
            "<th>Exclusão:</th>" .
            "</tr>" .
            "</thead>" .
            "<tbody> ";

        foreach ($matriculas as $registro) {
            echo '    <tr>' .
                '        <td><a href=form_matricula.php?alterarid=' . $registro['idaluno'] . '>' . $registro['idaluno'] . '</a></td><br>' .
                '        <td>' . $registro['nmaluno'] . '</td>' .
                ' <td>' .
                '<form action="proc_del_matricula.php" method="POST">' .
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
            echo '<form action="proc_upd_matricula.php" method="POST">';
            echo '    <input type="text" name="nmaluno" value=" ' . getName($_GET['alterarid']) . ' " />';
            echo '    <input type="hidden" name="idalunoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>