<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
	$tipo = $_POST['tipo'];


	if($tipo == 'top5'){

		$a_top_5 = $gastosModel->get_top_5();
		$i=0;
		while ($fila = mysql_fetch_assoc($a_top_5)) {
	    	$array[$i] = array('D_TIPO_GASTO' => $fila['D_TIPO_GASTO'], 'SUMA' => $fila['SUMA']);
	    	$i++;
		}
		echo json_encode($array);
	}
	exit();
	 
?>