<?php 
require_once("../Componente/header.php");
require_once("../Materia/materia.php");
require_once("avaliacao.php");

    //$avaliacoes = listaAvaliacoes();
    $materias = listaMateria()   
 ?>

<body>
    <?php
    require("../Componente/menu.php");    
    ?>

    <div class="content">
        <h2>Cadastro de Avaliações	</h2><hr/>
        <form action="../Avaliacao/proc_ins_avaliacao.php" method="POST">
            <label>
                Avaliações: 
                <input type="text" name="cadAvaliacao" size="30" maxsize="30" />
            </label>            
            <label>
                Matéria:
                <select name="CadMateria">
                    <?php foreach($materias as $materia){?>
                        <option value="<?php echo $materia["idmateria"] ?>">
                            <?php echo $materia["dsmateria"] ?>
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
                    "<td>" . $registro['dsavaliacao'] . "</td>" .
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
                    
                    
                    foreach ($avaliacoes as $avalia) {
                        echo '<tr>' .
                             '  <td><a href=../Matricula/form_matricula.php?alterarid=' . $avalia['idalunomatriculado'] . '>' . $avalia['idalunomatriculado'] . '</a></td>' .
                             '  <td>' . $avalia['nmaluno'] . '</td>' .
                             '  <td>' . $avalia['dsmateria'] . '</td>' .
                             '  <td>' .
                                '  <form action="../Matricula/proc_del_matricula.php" method="POST">' .
                                '      <input type="hidden" name="idmatriculaDEL" value="' . $avalia['idalunomatriculado'] . '" />' .
                                '      <input type="submit" value="Excluir" />' .
                                '  </form>' .
                                '</td>' .
                             '</tr>';
                    }
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

            //? PREENCHENDO ComboBox DE MATERIA COM A MATERIA DO REGISTRO SELECIONADO
            echo '<label> Matéria: <select name="idmateria">';
                foreach($materias as $materia){
                    echo '<option value="'.$materia["idmateria"].'"';
                    if(getMatricula($_GET['alterarid'])[0]['idmateria'] == $materia['idmateria']){echo 'selected';}
                    echo '>'.$materia["dsmateria"].'</option>';
                }
            echo '</select></label>';

            echo '    <input type="text" name="dsavaliacao" value=" ' . getNameavaliacao($_GET['alterarid']) . ' " />';
            echo '    <input type="hidden" name="idavaliacaoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="alterar" />';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>