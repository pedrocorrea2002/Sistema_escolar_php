<?php 
    require_once("../Componente/header.php");
    require_once("materia.php");
    require_once("../Utils/valida_formulario.php");
    require_once("../Matricula/matricula.php");
    require_once("../Avaliacao/avaliacao.php");

    if (isset($_POST['idmateriaDEL'])){
        $id = $_POST['idmateriaDEL'];

        if (!is_numeric($id)){
            header("Location: form_materia.php?del=2");
            exit;
        }

        if (existeMatriculaMateria($id) || existeAvaliacaoMateria($id)){
            header("Location: form_materia.php?del=0");
            exit;
        }

        deleteMateria($id);
        header("Location: form_materia.php?del=1");
        exit;
    }

    header("Location: form_materia.php");
?>


