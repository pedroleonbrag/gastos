<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
	$search = $_POST['search'];


	$a_gastos_coment = $gastosModel->get_gastos_comment($search);

	$array = array();
	$i=0;
	while ($fila = mysql_fetch_assoc($a_gastos_coment)) {

    	$array[$i] = array(
	        'D_TIPO_GASTO' => $fila['D_TIPO_GASTO'],
	        'VALOR' => $fila['VALOR'],
	        'DIA' => $fila['DIA'],
	        'MES' => $fila['MES'],
	        'ANIO' => $fila['ANIO'],
	        'FECHA_GASTO' => $fila['FECHA_GASTO'],
	        'COMENTARIOS' => $fila['COMENTARIOS']
    	);
		$i++;
	}

	//GA.VALOR, DAY(GA.FECHA_GASTO) DIA, MONTH(GA.FECHA_GASTO) MES, YEAR(GA.FECHA_GASTO) ANIO, GA.FECHA_GASTO, GA.COMENTARIOS, TA.D_TIPO_GASTO
	
	echo json_encode($array);

	 
?>