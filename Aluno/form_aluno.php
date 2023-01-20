<?php 
require_once("../Componente/header.php");
require_once("../Componente/menu.php");
require_once("aluno.php");

$alunos = [];
$filter = "";

//* SE HOUVER FILTRO $alunos, VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
    $alunos = searchAlunosByName($filter);
}else{
    $alunos = listaAlunos();
}
?>

<body>
    <div class="content">
        <h2>Administração de alunos</h2><hr/>
        <!-- FORM DE PESQUISA -->
        <form method="POST" action="./proc_src_aluno">
            <label>
                Pesquisar aluno:
                <input type="text" name="srcAluno" value="<?php echo $filter ?>"/>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        <!-- FORM DE CADASTRO -->
        <form action="proc_ins_aluno.php" method="POST">
            <label>Aluno a cadastrar: <input type="text" name="nmAluno" size="30" maxsize="30" /></label>
            <input type="submit" value="Cadastrar" />
        </form>
        <hr/>
        <?php
            if(isset($_POST['msg_aluno']) && isset($_POST['status_aluno'])){
                if($_POST['status_aluno'] == 0){
                    echo "<p style='color:green; font-weight:bolder'>Aluno criado com sucesso!</p>";
                }else{
                    echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_aluno']."</p>";
                }
            }
        ?>
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

        foreach ($alunos as $aluno) {
            echo '<tr>' .
                 '  <td><a href=form_aluno.php?alterarid=' . $aluno['idaluno'] . '>' . $aluno['idaluno'] . '</a></td>' .
                 '  <td>' . $aluno['nmaluno'] . '</td>' .
                 '  <td>' .
                 '  <form action="proc_del_aluno.php" method="POST" id="button_'.$aluno['idaluno'].'">' .
                 '      <input type="hidden" name="idalunoDEL" value="' . $aluno['idaluno'] . '"/>' .
                 '      <div class="table_button" onClick="document.getElementById(`button_'.$aluno['idaluno'].'`).submit()">Excluir</div>' .
                 '  </form>' .
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
                                echo "o registro está em uso e não pode ser excluído";
                                break;
                            case "1":
                                echo "registro excluído";
                                break;
                            default:
                                echo "Erro interno, tente novamente!";
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
            echo '    <input type="text" name="nmAluno" value="' . getAluno($_GET['alterarid'])['nmaluno'] . '" />';
            echo '    <input type="hidden" name="idalunoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="Alterar" />';
            echo '</form>';
        }

        if(isset($_POST['msg_aluno_upd']) && isset($_POST['status_aluno_upd'])){
            if($_POST['status_aluno_upd'] == 0){
                echo "<p style='color:green; font-weight:bolder'>Aluno alterado com sucesso!</p>";
            }else{
                echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_aluno_upd']."</p>";
            }
        }
        ?>
    </div>
</body>
</html>