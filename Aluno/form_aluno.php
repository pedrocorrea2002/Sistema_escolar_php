<?php 
require_once("../Componente/header.php");
require_once("../Componente/menu.php");
require_once("aluno.php");

$alunos = [];
$filter = "";

//* SE HOUVER FILTRO $alunos VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
    $alunos = searchAlunosByName($filter);
}else{
    $alunos = listaAlunos();
}

?>

<body>
    <div class="content">
        <h2>Manutenção de alunos</h2><hr/>
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
            <label>Aluno a cadastrar: <input type="text" name="cadAluno" size="30" maxsize="30" /></label>
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

        foreach ($alunos as $registro) {
            echo '    <tr>' .
                '        <td><a href=form_aluno.php?alterarid=' . $registro['idaluno'] . '>' . $registro['idaluno'] . '</a></td>' .
                '        <td>' . $registro['nmaluno'] . '</td>' .
                ' <td>' .
                '<form action="proc_del_aluno.php" method="POST">' .
                '    <input type="hidden" name="idalunoDEL" value="' . $registro['idaluno'] . '"/>' .
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
            echo '    <input type="text" name="nmaluno" value=" ' . getAluno($_GET['alterarid'])['nmaluno'] . ' " />';
            echo '    <input type="hidden" name="idalunoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="Alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>