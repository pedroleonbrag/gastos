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

#header{
	position: fixed;
	top: 0;
	width: 100%;
	z-index: 100;
	background-color:darkcyan; 
	height:20px;
}

#footer{
	position: fixed;
	width: 100%;
	z-index: 100;
	background-color:darkcyan; 
	height:20px;
	bottom:0px;
}

#formulario{
	margin-top: 30px;
}

li > a{
	color: darkcyan;
}
</style>

<script>


$(document).ready(function() {

    $('#fecha_gasto').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
    });

	$('#tabla_datos').fadeIn(3000);
	$('#div_search').fadeIn(3000);
	//alinearTablas();

	var json = '[{"result":true,"count":1}, {"result":false,"count":2}]',
    obj = JSON.parse(json);

	//alert(obj[0].result);
//	alert(obj[0].count);
//	alert(obj[1].result);
//	alert(obj[1].count);

} );


function grabarGasto(){

	msg = '';
	if(jQuery.trim($('#tipo_gasto').val()) == ''){
		msg += 'Seleccione un tipo de gasto \n';	
	}

	if(jQuery.trim($('#valor').val()) == ''){
		msg += 'Ingrese un valor \n';	
	}else if(isNaN(jQuery.trim($('#valor').val()))){
		msg += 'El valor debe ser numerico \n';	
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

function filtrarGasto(){

	search = jQuery.trim($('#search').val());

	if(search.length < 0)
		return;

	var request = $.ajax({
		url: "filtrarGasto.php",
		type: "POST",
		data: { search : search },
		dataType: "html"
	});

	request.done(function(data) {
		refreshTabla(data);
	});
}

function refreshTabla(data){
	var json = data;
	obj = JSON.parse(json);

	$("#body_tabla_datos tr").remove(); 
	var table = document.getElementById("body_tabla_datos");
	for(i=0; i<obj.length; i++){
		
		cant_filas = table.rows.length;

		var row = table.insertRow(cant_filas);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);

		cell1.style.width = '17%';
		cell2.style.width = '11%';
		cell3.style.width = '11%';		
		cell4.style.width = '61%';
	
		cell1.innerHTML = obj[i].D_TIPO_GASTO;
		cell2.innerHTML = obj[i].DIA + '/' + obj[i].MES + '/' + obj[i].ANIO;
		cell3.innerHTML = obj[i].VALOR;
		cell4.innerHTML = obj[i].COMENTARIOS;
	}

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

function anterior(){
	inicio = parseInt($("#inicio").val()) - 12;
	$("#inicio").val(inicio);
	$("#form_pag").submit();
}

function siguiente(){
	inicio = parseInt($("#inicio").val()) + 12;
	$("#inicio").val(inicio);
	$("#form_pag").submit();
}

function irPagina(pag){
	
	inicio = (pag - 1) * 12;
	$("#inicio").val(inicio);
	$("#form_pag").submit();

}

</script>


</head>

<?php
    
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once "gastosModelo.php";

print_r($_POST['inicio']);

    $inicio = (isset($_POST['inicio'])) ? $_POST['inicio'] : 0;
    $cant   = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : 12;
    $pagina_actual = ($inicio / $cant) + 1;

echo "inicio: ".$inicio;


    $gastosModel = new gastosModelo();
    $a_tipos_gasto = $gastosModel->get_tipos_gasto();
	$a_gastos = $gastosModel->get_gastos($inicio, $cant);
	$total = $gastosModel->get_total();

	$cant_paginas = ceil($total / $cant);
	echo "cant paginas: ".$cant_paginas;
	echo "pagina actual: ".$pagina_actual;

?>
<body style="text-align:center;">

	<!--<div><?php echo date("Y-m-d H:i:s"); ?></div>-->

	<div id="header"></div>

	<form id="form_pag" action="index.php" method="POST">
		<input type="hidden" id="inicio" name="inicio" value=<?php echo '"'.$inicio.'"'; ?> />
		<input type="hidden" id="cantidad" name="cantidad" value="12"/>	
	</form>

	<form id="formulario" action="grabarGasto.php" method="POST">
		<!--<img src="img/portada3.png"/> -->

		<table border="0" style="text-align:center; width:100%;">
			<tr>
				<td>
					<select class="selectpicker" id="tipo_gasto" name="tipo_gasto" >
                        <option value="" style="text-align: center;">Seleccionar</option>
                      <?php while ($fila = mysql_fetch_assoc($a_tipos_gasto)) { ?>
                        <option style="text-align: center;" value="<?php echo $fila['ID_TIPO_GASTO']; ?>"><?php echo $fila['D_TIPO_GASTO']; ?></option>
                      <?php } ?>
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
					<textarea style="text-align:center;" id="comentarios" name="comentarios" placeholder="Detalle"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button type="button" class="btn btn-default" onclick="grabarGasto();">Grabar</button>
				</td>
			</tr>
		</table>
    </form>



    <div id="div_search" style="margin-right: 20%; display:none;" align="right">
    	<input id="search" class="form-control" onkeyup="filtrarGasto();" autocomplete="off" type="text" placeholder="Search" style="width:115px;">
    	<button class="btn_refresh" onclick="filtrarGasto();" style="border-bottom-right-radius: 0;border-top-right-radius: 0; margin-bottom: 0.3em;" title="Refresh" name="refresh" type="button">
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

		<table id="tabla_datos" border="0" style="width: 60%; border: 1px solid rgb(221, 221, 221); text-align:center; border-radius: 5px; height:100px; display:none;" align="center">
			<thead id="header_tabla_datos">
				<tr>
					<th style="width:17%;">Concepto</th>
					<th style="width:11%;">Fecha</th>
					<th style="width:11%;">Valor</th>
					<th style="width:61%;">Detalle</th>
				</tr>
			</thead>
			<tbody id="body_tabla_datos"> 
				<?php while ($gasto = mysql_fetch_assoc($a_gastos)) { ?>
					<tr style="border-top:1px solid #ddd;">
                        <td style="width:17%;"><?php echo $gasto['D_TIPO_GASTO']; ?></td>
                        <td style="width:11%;"><?php echo (($gasto['DIA']>9) ? $gasto['DIA'] : "0".$gasto['DIA'])."/".(($gasto['MES']>9) ? $gasto['MES'] : "0".$gasto['MES'])."/".$gasto['ANIO']; ?></td>
                        <td style="width:11%;"><?php echo $gasto['VALOR']; ?></td>
                        <td style="width:61%;"><?php echo $gasto['COMENTARIOS']; ?></td>
					</tr>
                <?php } ?>
			</tbody>
		</table>


<div class="pagination" style="width:60%;">
	<ul class="pagination">
		<?php 
			$habilitacion_back = ($pagina_actual == 1) ? 'disabled' : '';
			$onclick_anterior = ($pagina_actual == 1) ? '' : 'onclick=\'anterior();\'';
			echo "<li class='page-pre ".$habilitacion_back."'><a ".$onclick_anterior.">&lt;</a></li>";
			for($i = 1; $i<=$cant_paginas; $i++){
				$activa = ($pagina_actual == $i) ? 'active disabled' : '';
				echo "<li class='page-number ".$activa."'><a onclick='irPagina(".$i.");'>".$i."</a></li>";
			}

			$habilitacion_to = ($pagina_actual == $cant_paginas) ? 'disabled' : '';
			$onclick_sgte = ($pagina_actual == $cant_paginas) ? '' : 'onclick=\'siguiente();\'';
			echo "<li class='page-next ".$habilitacion_to."'><a ".$onclick_sgte.">&gt;</a></li>";

		?>


		<!--<li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li>
		<li class="page-number active disabled"><a href="javascript:void(0)">1</a></li>
		<li class="page-number"><a href="javascript:void(0)">2</a></li>
		<li class="page-number"><a href="javascript:void(0)">3</a></li>
		<li class="page-number"><a href="javascript:void(0)">4</a></li>
		<li class="page-number"><a href="javascript:void(0)">5</a></li>
		<li class="page-number"><a href="javascript:void(0)">2</a></li>
		<li class="page-number"><a href="javascript:void(0)">3</a></li>
		<li class="page-number"><a href="javascript:void(0)">4</a></li>
		<li class="page-number"><a href="javascript:void(0)">5</a></li> -->
		
		
	</ul>
</div>

<div id="footer"></div>

</body>
</html>