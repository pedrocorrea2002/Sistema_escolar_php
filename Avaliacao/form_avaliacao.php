<?php 
require_once("../Componente/header.php");
require_once("../Materia/materia.php");
require_once("avaliacao.php");
require_once("../Componente/menu.php");    

$materias = listaMateria();   
$avaliacoes = [];
$filterTipo = "";
$filterMateria = "";
$tipoAv= ListaAv();
 
//* SE HOUVER FILTRO, $avaliacoes VIRÁ FILTRADO, SE NÃO, VIRÁ COMPLETO
if(isset($_GET['tipo']) && isset($_GET['materia'])){
    $filterTipo = trim($_GET['tipo']);
    $filterMateria = trim($_GET['materia']);
    $avaliacoes = searchAvaliacoesByTipoAndMateria($filterTipo, $filterMateria);
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
                Pesquisar avaliação por tipo ou matéria:
                <select name="tipo">
                    <option value='' <?php if($filterTipo == ""){echo "selected";}?>></option>
                    <option value='Av1' <?php if($filterTipo == "Av1"){echo "selected";}?>>Av1</option>
                    <option value='Av2' <?php if($filterTipo == "Av2"){echo "selected";}?>>Av2</option>
                    <option value='Av3' <?php if($filterTipo == "Av3"){echo "selected";}?>>Av3</option>
                </select>
                <select name="materia">
                    <option value='' <?php if($filterMateria == ""){echo "selected";}?>></option>
                    <?php
                        foreach($materias as $materia){
                            echo "<option value='".$materia['dsmateria']."'";
                                if($filterMateria == $materia['dsmateria']){
                                    echo ' selected';
                                }   
                            echo ">".$materia['dsmateria']."</option>";
                        }
                    ?>
                </select>
                <input type="text" name="campo" value="tipo" hidden>
                <input type="submit" value="Pesquisar">
            </label>
        </form>
        <hr>
        <!-- FORM DE CADASTRO -->
        <form action="../Avaliacao/proc_ins_avaliacao.php" method="POST">     

            <label name="lblAvaliacao">
                Tipo:                 
                <select name="dsAvaliacao">
                    <?php foreach($tipoAv as $tipoavaliacao){?>
                        <option value="<?php echo $tipoavaliacao["tipoAv"] ?>">
                            <?php echo $tipoavaliacao["tipoAv"] ?>
                        </option>
                    <?php } ?>
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
            <th>Tipo</th>   
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
                "   <td>" .
                '   <form action="proc_del_avaliacao.php" method="POST" id="button_'.$avaliacao['idavaliacao'].'">' .
                '       <input type="hidden" value="' . $avaliacao['idavaliacao'] . '" name="idavaliacaoDEL" />' .
                '       <div class="table_button" onClick="document.getElementById(`button_'.$avaliacao['idavaliacao'].'`).submit()">Excluir</div>' .
                "   </form>" .
                "   </td>" .
                "</tr>";                  
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
            echo '<form action="proc_upd_avaliacao.php" method="POST">';

            //? PREENCHENDO ComboBox DE MATERIA COM A MATERIA DO REGISTRO SELECIONADO
            echo '<label> Matéria: <select name="idMateria">';
                foreach($materias as $materia){
                    echo '<option value="'.$materia["idmateria"].'"';
                    if(getAvaliacao($_GET['alterarid'])['idmateria'] == $materia['idmateria']){echo 'selected';}
                    echo '>'.$materia["dsmateria"].'</option>';
                }
            echo '</select></label>';

// ----------------------------------------------------------------------------------
            //? PREENCHENDO ComboBox DE AVALIACOES COM A AVALIACAO DO REGISTRO SELECIONADO
            echo '<label> Tipo: <select name="dsAvaliacao">';
                foreach($tipoAv as $avaliacao){
                    echo '<option value="'.$avaliacao["tipoAv"].'"';
                    if(getAvaliacao($_GET['alterarid'])['dsavaliacao'] == $avaliacao['tipoAv']){echo 'selected';}
                    echo '>'.$avaliacao["tipoAv"].'</option>';
                }
            echo '    <input type="hidden" name="idAvaliacaoUPD" value="' . $_GET['alterarid'] . '" />';                
            echo '</select></label>';
            

//-------------------------------------------------------------------------------
            echo '    <input type="submit" value="Alterar" />';
           // echo '</form>';
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




