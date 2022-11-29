<?php 
    require_once("../Componente/header.php");
    require_once("notas.php");
    require_once("../Aluno/aluno.php");
    require_once("../Materia/materia.php");

    $alunos = listaAlunos();
    $materias = listaMateria()
?>

<body>
    <?php
    require_once("../Componente/menu.php");
    ?>

    <div class="content">
        <h2>Manutenção de notas</h2><hr/>
        <form action="../Matricula/proc_ins_matricula.php" method="POST">
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
                <select name="cadMateria">
                    <?php foreach($materias as $materia){?>
                        <option value="<?php echo $materia["idmateria"] ?>">
                            <?php echo $materia["dsmateria"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <label>
                Nota: 
                <input type="number" name=dsnota> </label>
            <input type="submit" value="Cadastrar" />
        </form>
        <hr/>
        <?php

        echo "<table>" .
            "<thead>" .
            "   <tr>" .
            "      <th>Aluno:</th>" .
            "      <th>Matéria:</th>" .
            "      <th>Nota:</th>" .
            "      <th>Exclusão:</th>" .
            "   </tr>" .
            "</thead>" .
            "<tbody> ";       
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
            echo '<form action="../Matricula/proc_upd_matricula.php" method="POST">';

            // PREENCHENDO ComboBox DE ALUNO COM O ALUNO DO REGISTRO SELECIONADO
            echo '<label style="margin-right:20px"> Aluno: <select name="idaluno">';
                foreach($alunos as $aluno){
                    echo '<option value="'.$aluno["idaluno"].'"';
                    if(getMatricula($_GET['alterarid'])[0]['idaluno'] == $aluno['idaluno']){echo 'selected';}
                    echo'>'.$aluno["nmaluno"].'</option>';
                }
            echo '</select></label>';

            // PREENCHENDO ComboBox DE MATERIA COM A MATERIA DO REGISTRO SELECIONADO
            echo '<label> Matéria: <select name="idmateria">';
                foreach($materias as $materia){
                    echo '<option value="'.$materia["idmateria"].'"';
                    if(getMatricula($_GET['alterarid'])[0]['idmateria'] == $materia['idmateria']){echo 'selected';}
                    echo '>'.$materia["dsmateria"].'</option>';
                }
            echo '</select></label>';

            echo '    <input type="hidden" name="idmatricula" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>