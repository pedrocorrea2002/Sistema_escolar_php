<?php 
require_once("../Componente/header.php");
require_once("../Materia/materia.php");
require_once("avaliacao.php");
require_once("../Componente/menu.php");    

    $materias = listaMateria();   
 ?>

<body>
    <div class="content">
        <h2>Cadastro de Avaliações	</h2><hr/>
        <form action="../Avaliacao/proc_ins_avaliacao.php" method="POST">            
            <label>
                Avaliações:                 
                <select name="dsAvaliacao">
                    <option value="av1">Avaliacao 1</option>
                    <option value="av2">Avaliacao 2</option>
                    <option value="av3">Avaliacao 3</option>
                </select>   
            </label>  

            <label>
                Matéria:
                <select name="idMateria">
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
            <th>Matéria</th>                 
            <th>Excluir</th>
        </thead>
        <tbody>
        <?php
        $avaliacao = listaAvaliacoes();
        foreach ($avaliacao as $registro) {
            echo "<tr>" .

            
                "   <td><a href=form_avaliacao.php?alterarid=".$registro['idavaliacao'].">".$registro['idavaliacao']."</a></td>" .
                "   <td>" . $registro['dsavaliacao'] . "</td>" .
                "   <td>" . $registro['dsmateria'] . "</td>" .
                # ------------------------------------------------
                "   <td>" .
                '   <form action="proc_del_avaliacao.php" method="POST">' .
                '       <input type="hidden" value="' . $registro['idavaliacao'] . '" name="idavaliacaoDEL" />' .
                '       <input type="submit" value="Excluir">' .
                "       </form>" .
                "   </td>" .
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

            //? PREENCHENDO ComboBox DE MATERIA COM A MATERIA DO REGISTRO SELECIONADO
            echo '<label> Matéria: <select name="idmateria">';
                foreach($materias as $materia){
                    echo '<option value="'.$materia["idmateria"].'"';
                    if(getAvaliacao($_GET['alterarid'])['idmateria'] == $materia['idmateria']){echo 'selected';}
                    echo '>'.$materia["dsmateria"].'</option>';
                }
            echo '</select></label>';

            echo '    <input type="text" name="dsavaliacao" value=" ' . getAvaliacao($_GET['alterarid'])['dsavaliacao'] . ' " />';
            echo '    <input type="hidden" name="idavaliacaoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="Alterar" />';
            echo '</form>';
        }
        ?>     
        
    </div>
</body>
</html>




