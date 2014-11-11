<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
	$search = $_POST['search'];

	$a_gastos_coment = $gastosModel->get_gastos_comment($search);
	//print_r($a_gastos_coment);
	echo json_encode($a_gastos_coment);
?>