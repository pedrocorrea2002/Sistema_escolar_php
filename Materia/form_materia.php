<?php 
require_once("../Componente/header.php");
require_once("materia.php");

$materias = [];
$filter = "";

//* SE HOUVER FILTRO $alunos, VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if(isset($_GET['filter'])){
$filter = $_GET['filter'];
    $materias = searchMateriasByName($filter);
}else{
    $materias = listaMateria();
}
?>

<body>
    <?php
    require("../Componente/menu.php");
    require_once("materia.php");
    ?>

    <div class="content">
        <h2>Administração de matérias</h2>
        <hr>
        <!-- FORM DE PESQUISA -->
        <form method="POST" action="./proc_src_materia">
            <label>
                Pesquisar matéria:
                <input type="text" name="srcMateria" value="<?php echo $filter ?>"/>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        <!-- FORM DE CADASTRO -->
        <form action="proc_ins_materia.php" method="POST">
            <label>Materia a cadastrar: <input type="text" name="cadMateria" size="30" maxsize="30" /></label>
            <input type="submit" value="Cadastrar" />
        </form>
        <hr />

        <!-- FORM DE PESQUISA -->
        <form method="POST" action="./proc_src_materia">
            <label>
                Pesquisar matéria:
                <input type="text" name="srcMateria" value="<?php echo $filter ?>"/>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        
        <?php
        echo "<table>" .
            "<thead>" .
            "<tr>" .
            "<th>Identificação</th>" .
            "<th>Nome:</th>" .
            "</tr>" .
            "</thead>" .
            "<tbody> ";

        foreach ($materias as $materia) {
            echo '    <tr>' .
                '        <td><a href=form_materia.php?alterarid=' . $materia['idmateria'] . '>' . $materia['idmateria'] . '</a></td>' .
                '        <td>' . $materia['dsmateria'] . '</td>' .
                ' <td>' .
                '<form action="proc_del_materia.php" method="POST">' .
                '    <input type="hidden" name="idmateriaDEL" value="' . $materia['idmateria'] . '" />' .
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
            echo '<form action="proc_upd_materia.php" method="POST">';
            echo '    <input type="text" name="dsmateria" value=" ' . getNameMateria($_GET['alterarid']) . ' " />';
            echo '    <input type="hidden" name="idmateriaUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>