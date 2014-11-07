<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();

    $aa = 20.33;
    $gastosModel->grabar_gasto($_POST['tipo_gasto'], $_POST['valor'], $_POST['fecha_gasto'], $_POST['comentarios'], date("Y-m-d H:i:s"));

    header('Location: index.php');
?>