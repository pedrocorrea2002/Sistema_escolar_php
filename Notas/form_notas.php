<?php 
    require_once("../Componente/header.php");
    require_once("notas.php");
    require_once("../Aluno/aluno.php");
    require_once("../Avaliacao/avaliacao.php");

    $alunos = listaAlunos();
    $avaliacoes = listaAvaliacoes();
    $notas = listaNotas();
?>

<body>
    <?php
    require_once("../Componente/menu.php");
    ?>

    <div class="content">
        <h2>Administração de notas</h2><hr/>
        <form action="../Notas/proc_ins_notas.php" method="POST">
            <label style="margin-right:20px">
                Aluno:
                <select name="idAluno">
                    <?php foreach($alunos as $aluno){?>
                        <option value="<?php echo $aluno["idaluno"] ?>">
                            <?php echo $aluno["nmaluno"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <label>
                Avaliação:
                <select name="idAvaliacao">
                    <?php foreach($avaliacoes as $avaliacao){?>
                        <option value="<?php echo $avaliacao["idavaliacao"] ?>">
                            <?php echo $avaliacao["dsavaliacao"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <label>
                Nota: 
                <input type="number" name=dsnota>
            </label>
            <input type="submit" value="Cadastrar" />
        </form>
        <?php
            if(isset($_POST['msg_nota']) && isset($_POST['status_nota'])){
                if($_POST['status_nota'] == 0){
                    echo "<p style='color:green; font-weight:bolder'>Nota inserida com sucesso!</p>";
                }else{
                    echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_nota']."</p>";
                }
            }
        ?>
        <hr/>
        <?php

        echo "<table>" .
            "<thead>" .
            "   <tr>" .
            "      <th>Identificador:</th>" .
            "      <th>Aluno:</th>" .
            "      <th>Avaliação:</th>" .
            "      <th>Nota:</th>" .
            "      <th>Exclusão:</th>" .
            "   </tr>" .
            "</thead>" .
            "<tbody> "; 
            
            foreach ($notas as $nota) {
                echo '<tr>' .
                    ' <td><a href=form_notas.php?alterarid=' . $nota['idavaliacaoaluno'] . '>' . $nota['idavaliacaoaluno'] . '</a></td><br>' .
                    ' <td>' . $nota['nmaluno'] . '</td>' .
                    ' <td>' . $nota['dsavaliacao'] . '</td>' .
                    ' <td>' . $nota['nota'] . '</td>' .
                    ' <td>' .
                    '   <form action="proc_del_notas.php" method="POST">' .
                    '       <input type="hidden" name="idnotasDEL" value="' . $nota['idavaliacaoaluno'] . '" />' .
                    '       <input type="submit" value="Excluir" />' .
                    '   </form>' .
                    ' </td>' .
                    '</tr>';
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

                    ?>
                </td>
            </tr>
        </tfoot>
        </table>
        <hr />
        <?php
        if (isset($_GET['alterarid'])) {
            echo '<form action="../Notas/proc_upd_notas.php" method="POST">';

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