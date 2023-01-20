<?php
require_once("../Componente/header.php");
require_once("matricula.php");
require_once("../Aluno/aluno.php");
require_once("../Materia/materia.php");

$alunos = listaAlunos();
$materias = listaMateria();
$matriculas = [];
$filter = "";

//* SE HOUVER FILTRO $alunos, VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $matriculas = searchMatriculasByName($filter);
} else {
    $matriculas = listaMatriculas();
}
?>

<body>
    <?php
    require_once("../Componente/menu.php");
    ?>

    <div class="content">
        <h2>Administração de matrículas</h2>
        <hr />
        <!-- FORM DE PESQUISA -->
        <form method="POST" action="./proc_src_matricula">
            <label>
                Pesquisar matrículas pelo nome do aluno:
                <input type="text" name="srcMatricula" value="<?php echo $filter ?>"/>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        <!-- FORM DE CADASTRO -->
        <form action="../Matricula/proc_ins_matricula.php" method="POST">
            <label style="margin-right:20px">
                Aluno:
                <select name="idAluno">
                    <?php foreach ($alunos as $aluno) { ?>
                        <option value="<?php echo $aluno["idaluno"] ?>">
                            <?php echo $aluno["nmaluno"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <label>
                Matéria:
                <select name="idMateria">
                    <?php foreach ($materias as $materia) { ?>
                        <option value="<?php echo $materia["idmateria"] ?>">
                            <?php echo $materia["dsmateria"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <input type="submit" value="Cadastrar" />
        </form>
        <?php
            if(isset($_POST['msg_matricula']) && isset($_POST['status_matricula'])){
                if($_POST['status_matricula'] == 0){
                    echo "<p style='color:green; font-weight:bolder'>Matrícula inserida com sucesso!</p>";
                }else{
                    echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_matricula']."</p>";
                }
            }
        ?>
        <hr />
        <?php

        echo "<table>" .
            "<thead>" .
            "   <tr>" .
            "      <th>Identificação</th>" .
            "      <th>Aluno:</th>" .
            "      <th>Matéria:</th>" .
            "      <th>Exclusão:</th>" .
            "   </tr>" .
            "</thead>" .
            "<tbody> ";

        foreach ($matriculas as $matricula) {
            echo '<tr>' .
                '  <td><a href=../Matricula/form_matricula.php?alterarid=' . $matricula['idalunomatriculado'] . '>' . $matricula['idalunomatriculado'] . '</a></td>' .
                '  <td>' . $matricula['nmaluno'] . '</td>' .
                '  <td>' . $matricula['dsmateria'] . '</td>' .
                '  <td>' .
                '  <form action="../Matricula/proc_del_matricula.php" method="POST" id="button_'.$matricula['idalunomatriculado'].'">' .
                '      <input type="hidden" name="idmatriculaDEL" value="' . $matricula['idalunomatriculado'] . '" />' .
                '      <div class="table_button" onClick="document.getElementById(`button_'.$matricula['idalunomatriculado'].'`).submit()">Excluir</div>' .
                '  </form>' .
                '</td>' .
                '</tr>';
        }
        ?>

        <tfoot>
            <tr>
                <td colspan="4">
                    <?php
                    if (isset($_GET['upd'])) echo "Registro alterado";
                    if (isset($_GET['del'])) {
                        switch ($_GET['del']) {
                            case "0":
                                echo "o registro está em uso e não pode ser excluído";
                                break;
                            case "1":
                                echo "registro excluído";
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

            //? PREENCHENDO ComboBox DE ALUNO COM O ALUNO DO REGISTRO SELECIONADO
            echo '<label style="margin-right:20px"> Aluno: <select name="idAluno">';
            foreach ($alunos as $aluno) {
                echo '<option value="' . $aluno["idaluno"] . '"';
                if (getMatricula($_GET['alterarid'])[0]['idaluno'] == $aluno['idaluno']) {
                    echo 'selected';
                }
                echo '>' . $aluno["nmaluno"] . '</option>';
            }
            echo '</select></label>';

            //? PREENCHENDO ComboBox DE MATERIA COM A MATERIA DO REGISTRO SELECIONADO
            echo '<label> Matéria: <select name="idMateria">';
            foreach ($materias as $materia) {
                echo '<option value="' . $materia["idmateria"] . '"';
                if (getMatricula($_GET['alterarid'])[0]['idmateria'] == $materia['idmateria']) {
                    echo 'selected';
                }
                echo '>' . $materia["dsmateria"] . '</option>';
            }
            echo '</select></label>';

            echo '    <input type="hidden" name="idMatricula" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }

        if(isset($_POST['msg_matricula_upd']) && isset($_POST['status_matricula_upd'])){
            if($_POST['status_matricula_upd'] == 0){
                echo "<p style='color:green; font-weight:bolder'>Matrícula alterada com sucesso!</p>";
            }else{
                echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_matricula_upd']."</p>";
            }
        }
        ?>
    </div>
</body>

</html>