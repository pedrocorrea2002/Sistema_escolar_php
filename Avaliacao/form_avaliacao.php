<?php require("../Componente/header.php") ?>

<body>
    <?php
    require("../Componente/menu.php");
    require_once("avaliacao.php");
    ?>

    <div class="content">
        <h2>Cadastro de Avaliações	</h2><hr/>
        <form action="proc_ins_avaliacao.php" method="POST">
            <label>Avaliações: <input type="text" name="cadavaliacao" size="30" maxsize="30" /></label>
            
            <label>
                Matéria:
                <select name="idAvaliacao">
                    <?php foreach($avaliacoes as $avaliacao){?>
                        <option value="<?php echo $avaliacao["idavaliacao"] ?>">
                            <?php echo $avaliacao["dsavaliacao"] ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <input type="submit" value="Cadastrar" />

        </form>        

        

        <table style="border: 1px; border-color:black;">
        <thead>
            <th>Identificação</th>
            <th>Avaliação</th>   
            <th>Matéria </th>         
            <th>Atualizar </th>            
            <th> Excluir </th>
        </thead>
        <tbody>

        <?php
        $avaliacao = listaAvaliacoes();
        foreach ($avaliacao as $registro) {
            echo "<tr>" .
                    "<td>" . $registro['idavaliacao'] . "</td>" .
                    "<td>" . $registro['dsavaliacao'] . "</td>" .
                    "<td>" . $registro['dsmateria'] . "</td>" .
                    "<td>" .
                    '<form action="form_upd_avaliacao.php" method="POST">' .
                    '<input type="hidden" value="' . $registro['dsavaliacao'] .  '" name="dsavaliacao" />' .
                    '<input type="submit" value="X">' .
                    "</form>" .
                    "</td>" .
                    "<td>" .
                    '<form action="proc_del_avaliacao.php" method="POST">' .
                    '<input type="hidden" value="' . $registro['dsavaliacao'] .  '" name="dsavaliacao" />' .
                    '<input type="submit" value="X">' .
                    "</form>" .
                    "</td>" .
                    "</tr>";            
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
            echo '<form action="proc_upd_avaliacao.php" method="POST">';
            echo '    <input type="text" name="dsavaliacao" value=" ' . getNameavaliacao($_GET['alterarid']) . ' " />';
            echo '    <input type="hidden" name="idavaliacaoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>