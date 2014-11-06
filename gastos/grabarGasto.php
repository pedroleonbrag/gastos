<?php
    date_default_timezone_set('GMT');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();

    $aa = 20.33;
    $gastosModel->grabar_gasto($_POST['tipo_gasto'], $_POST['valor'], $_POST['fecha_gasto'], $_POST['comentarios'], "2009-04-30 10:09:00");

    header('Location: index.php');
?>