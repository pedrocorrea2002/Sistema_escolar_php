<?php 
require_once("../Componente/header.php");
require_once("../Materia/materia.php");
require_once("avaliacao.php");
require_once("../Componente/menu.php");    

$materias = listaMateria();   
$avaliacoes = [];
$filter = "";

//* SE HOUVER FILTRO $alunos, VIRÁ FILTRADO, SERÃO VIRÁ COMPLETO
if(isset($_GET['filter'])){
$filter = $_GET['filter'];
    $avaliacoes = searchAvaliacoesByName($filter);
}else{
    $avaliacoes = listaAvaliacoes();
}
 ?>

<body>
    <div class="content">
        <h2>Cadastro de Avaliações</h2>
        <hr>
        <!-- FORM DE PESQUISA -->
        <form method="POST" action="./proc_src_avaliacao">
            <label>
                Pesquisar avaliação:
                <input type="text" name="srcAvaliacao" value="<?php echo $filter ?>"/>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        <!-- FORM DE CADASTRO -->
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
        <hr>
        <?php
            if(isset($_POST['msg_avaliacao']) && isset($_POST['status_avaliacao'])){
                if($_POST['status_avaliacao'] == 0){
                    echo "<p style='color:green; font-weight:bolder'>Avaliação criada com sucesso!</p>";
                }else{
                    echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_avaliacao']."</p>";
                }
            }
        ?>

        <table style="border: 1px; border-color:black;">
        <thead>
            <th>Identificação</th>
            <th>Avaliação</th>   
            <th>Matéria</th>                 
            <th>Excluir</th>
        </thead>
        <tbody>
        <?php
        foreach ($avaliacoes as $avaliacao) {
            echo "<tr>" .

            
                "   <td><a href=form_avaliacao.php?alterarid=".$avaliacao['idavaliacao'].">".$avaliacao['idavaliacao']."</a></td>" .
                "   <td>" . $avaliacao['dsavaliacao'] . "</td>" .
                "   <td>" . $avaliacao['dsmateria'] . "</td>" .
                # ------------------------------------------------
                "   <td>" .
                '   <form action="proc_del_avaliacao.php" method="POST">' .
                '       <input type="hidden" value="' . $avaliacao['idavaliacao'] . '" name="idavaliacaoDEL" />' .
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
            echo '<label> Matéria: <select name="idMateria">';
                foreach($materias as $materia){
                    echo '<option value="'.$materia["idmateria"].'"';
                    if(getAvaliacao($_GET['alterarid'])['idmateria'] == $materia['idmateria']){echo 'selected';}
                    echo '>'.$materia["dsmateria"].'</option>';
                }
            echo '</select></label>';

            echo '    <input type="text" name="dsAvaliacao" value=" ' . getAvaliacao($_GET['alterarid'])['dsavaliacao'] . ' " />';
            echo '    <input type="hidden" name="idAvaliacaoUPD" value="' . $_GET['alterarid'] . '" />';
            echo '    <input type="submit" value="Alterar" />';
            echo '</form>';
        }

        if(isset($_POST['msg_avaliacao_upd']) && isset($_POST['status_avaliacao_upd'])){
            if($_POST['status_avaliacao_upd'] == 0){
                echo "<p style='color:green; font-weight:bolder'>Avaliação alterada com sucesso!</p>";
            }else{
                echo "<p style='color:red; font-weight:bolder'>".$_POST['msg_avaliacao_upd']."</p>";
            }
        }
        ?>
    </div>
</body>
</html>




