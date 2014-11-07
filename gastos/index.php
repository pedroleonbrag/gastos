<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gastos</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/datepicker.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-select-min.css">
<link rel="stylesheet" href="css/scrollYou.css">
<link rel="stylesheet" href="css/bootstrap-table.css">
<link rel="stylesheet" href="css/bulletin.css">
<link rel="stylesheet" href="css/default.min.css">
<link rel="stylesheet" href="css/docs.css">                  

<script src="js/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select-min.js"></script>
<script src="js/scrollYou.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.bulletin.js"></script>
<script src="js/examples.js"></script>


<style>
.input-group-btn{
	width: 0%;
}

.btn_refresh{
	background-color: #fff; 
	border-color: #cccccc; 
	color: #333;  
	 -moz-user-select: none;
    background-image: none;
    border: 1px solid #cccccc;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    height: 28px;
}

.btn_refresh:hover{
	background-color: #e6e6e6; 
	border-color: #adadad; 
}

.btn_refresh:hover{
	background-color: #e6e6e6; 
	border-color: #adadad; 
}

#btn_elegir_columnas:hover{
	background-color: #e6e6e6 !important; 
	border-color: #adadad; 
}

table th,td{
	text-align:center;
	border-right: 1px solid rgb(221, 221, 221);
	border-bottom: 1px solid rgb(221, 221, 221);
	word-wrap:break-word;
}

#tabla_header_datos th{
	border-bottom: 0px solid rgb(221, 221, 221);
}

#tabla_header_datos tr{
	height: 35px;
}

#tabla_datos tr{
	height: 35px;
}

#tabla_datos thead tr th{
	border-bottom:3px solid rgb(221, 221, 221);
}

#tabla_datos tbody tr:hover{
	background-color:#F2F2F2;
}

table th:last-child{
	border-right: none;
}
table td:last-child{
	border-right: none;
}

button:active{
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15) inset !important;
}

.btn-group.bootstrap-select{
	border-radius: 4px;
}
</style>

<script>


$(document).ready(function() {

    $('#fecha_gasto').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
    });


	//alinearTablas();

} );


function grabarGasto(){

	msg = '';
	if(jQuery.trim($('#tipo_gasto').val()) == ''){
		msg += 'Seleccione un tipo de gasto \n';	
	}

	if(jQuery.trim($('#valor').val()) == ''){
		msg += 'Seleccione un valor \n';	
	}

	if(jQuery.trim($('#fecha_gasto').val()) == ''){
		msg += 'Seleccione la fecha \n';	
	}

	if(msg != ''){
		alert(msg);
		return;
	}
	
    $("#formulario").submit();

}

function alinearTablas(){

	var cant_tds = $('#tabla_header_datos thead tr').children('th').length;
	
	for(i=1; i<=cant_tds; i++){
		width_header = $('#tabla_header_datos thead th:nth-child('+i+')').css('width');
		width_tabla = $('#tabla_datos tbody tr td:nth-child('+i+')').css('width');

		width_header = width_header.replace('px', '');
		width_tabla = width_tabla.replace('px', '');

		if(width_header > width_tabla)
			$('#tabla_datos tbody tr td:nth-child('+i+')').css('width', width_header);
		else
			$('#tabla_header_datos thead th:nth-child('+i+')').css('width', width_tabla);
	}

}

function elegirColumnas(){
	if($('#lista_columnas').css('display') == 'none'){
		$('#lista_columnas').css('display', 'block');
	}else{
		$('#lista_columnas').css('display', 'none');
	}
}

</script>


</head>

<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
    $a_tipos_gasto = $gastosModel->get_tipos_gasto();
	$a_gastos = $gastosModel->get_gastos();

    //$gastosModel->grabar_gasto(1, 20.33, "2009-04-30", "lalalal", "2009-04-30 10:09:00");
?>
<body style="text-align:center;">

	<!--<div><?php echo date("Y-m-d H:i:s"); ?></div>-->

	<form id="formulario" action="grabarGasto.php" method="post">
		<img src="img/portada.png"/> 
		<table border="0" style="text-align:center; width:100%;">
			<tr>
				<td>
					<select class="selectpicker" id="tipo_gasto" name="tipo_gasto" >
                        <option value="" style="text-align: center;">Seleccionar</option>
                      <?php foreach ($a_tipos_gasto as $option): ?>
                        <option style="text-align: center;" value="<?php echo $option['ID_TIPO_GASTO']; ?>"><?php echo $option['D_TIPO_GASTO']; ?></option>
                      <?php endforeach ?>
					</select>
				</td>                                               
			</tr>

			<tr>
				<td>
					<div class="input-group" style="display: inline-flex; margin-bottom: 5px;">
						<span class="input-group-addon"  style="text-align:center; width:5px;">$</span>
						<input type="text" id="valor" name="valor" class="form-control" style="text-align:center; width:115px; padding-right:26px;" placeholder="Valor">

					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="input-append date" id="dp3" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd">
						<input class="span2" id="fecha_gasto" value="<?php echo date("Y-m-d"); ?>" name="fecha_gasto" size="16" type="text" style="width:115px;" >
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<textarea style="text-align:center;" id="comentarios" name="comentarios" placeholder="Comentarios"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button type="button" class="btn btn-default" onclick="grabarGasto();">Grabar</button>
				</td>
			</tr>
		</table>
    </form>



    <div style="margin-right: 20%;" align="right">
    	<input class="form-control" type="text" placeholder="Search" style="width:115px;">
    	<button class="btn_refresh" style="border-bottom-right-radius: 0;border-top-right-radius: 0; margin-bottom: 0.3em;" title="Refresh" name="refresh" type="button">
    		<i class="glyphicon glyphicon-refresh icon-refresh" style="margin-top:-2px;"></i>
    	</button>
	    <div title="Columns" class="keep-open btn-group open" style="display:inline-flex;">
	    	<button id="btn_elegir_columnas" onclick="elegirColumnas();" class="btn btn-default btn_refresh" style="border-radius:4px; margin-left:-1px; margin-bottom: 0.3em; margin-left:-5px; border-bottom-left-radius: 0; border-top-left-radius: 0; background-color: white; box-shadow:0 0px 0px rgba(0, 0, 0, 0.15) inset, 0 0px 0px rgba(0, 0, 0, 0.05);" type="button">
	    		<i class="glyphicon glyphicon-th icon-th" style="margin-top:-2px;"></i>  
	    	</button>
	    	<ul id="lista_columnas" role="menu" class="dropdown-menu" style="display:none;">
	    		<li><label><input type="checkbox" checked="checked" value="1" data-field="id"> Item ID</label></li>
	    		<li><label><input type="checkbox" checked="checked" value="2" data-field="name"> Item Name</label></li>
	    		<li><label><input type="checkbox" checked="checked" value="3" data-field="price"> Item Price</label></li>
	    	</ul>
	    </div>    	
    </div>
	
		<!--<table id="tabla_header_datos" border="0" style="width: 60%; border: 1px solid rgb(221, 221, 221); text-align:center; border-top-left-radius: 5px; border-top-right-radius: 5px;" align="center">
			<thead>
				<tr>
					<th style="width:17%;">Tipo</th>
					<th style="width:11%;">Fecha</th>
					<th style="width:11%;">Valor</th>
					<th style="width:61%;">Comentarios</th>
				</tr>
			</thead>
		</table>
		-->

		<table id="tabla_datos" border="0" style="width: 60%; border: 1px solid rgb(221, 221, 221); text-align:center; border-radius: 5px; height:100px;" align="center">
			<thead>
				<tr>
					<th style="width:17%;">Tipo</th>
					<th style="width:11%;">Fecha</th>
					<th style="width:11%;">Valor</th>
					<th style="width:61%;">Comentarios</th>
				</tr>
			</thead>
			<tbody> 
				<?php foreach ($a_gastos as $gasto): ?>
					<tr style="border-top:1px solid #ddd;">
                        <td style="width:17%;"><?php echo $gasto['D_TIPO_GASTO']; ?></td>
                        <td style="width:11%;"><?php echo (($gasto['DIA']>9) ? $gasto['DIA'] : "0".$gasto['DIA'])."/".(($gasto['MES']>9) ? $gasto['MES'] : "0".$gasto['MES'])."/".$gasto['ANIO']; ?></td>
                        <td style="width:11%;"><?php echo $gasto['VALOR']; ?></td>
                        <td style="width:61%;"><?php echo $gasto['COMENTARIOS']; ?></td>
					</tr>
                <?php endforeach ?>
			</tbody>
		</table>


</body>
</html>