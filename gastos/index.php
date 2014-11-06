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
</style>

<script>


$(document).ready(function() {

    $('#fecha_gasto').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
    });



  var $parent =  $('.start-example').hide().parent();
  //console.log($parent.next('.bs-example'));
  $parent.next('.bs-example').add($parent.next().next('.bs-example')).find('table').bootstrapTable();


} );


function grabarGasto(){

    $("#formulario").submit();

}

</script>


</head>

<?php
    date_default_timezone_set('GMT');
    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
    $a_tipos_gasto = $gastosModel->get_tipos_gasto();

    //$gastosModel->grabar_gasto(1, 20.33, "2009-04-30", "lalalal", "2009-04-30 10:09:00");
?>
<body style="text-align:center;">


    <div style="margin-right: 20%;" align="right">
    	<input class="form-control" type="text" placeholder="Search" style="width:115px;">
    	<button  class="btn_refresh" style="border-bottom-right-radius: 0;border-top-right-radius: 0; margin-bottom: 0.3em;" title="Refresh" name="refresh" type="button">
    		<i class="glyphicon glyphicon-refresh icon-refresh" style="margin-top:-2px;"></i>
    	</button>
	    <div title="Columns" class="keep-open btn-group open" style="display:inline-flex;">
	    	<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn_refresh" style="margin-left:-1px; margin-bottom: 0.3em; margin-left:-5px; border-bottom-left-radius: 0; border-top-left-radius: 0;" type="button">
	    		<i class="glyphicon glyphicon-th icon-th" style="margin-top:-2px;"></i>  
	    	</button>
	    	<ul role="menu" class="dropdown-menu" style="display:;">
	    		<li><label><input type="checkbox" checked="checked" value="1" data-field="id"> Item ID</label></li>
	    		<li><label><input type="checkbox" checked="checked" value="2" data-field="name"> Item Name</label></li>
	    		<li><label><input type="checkbox" checked="checked" value="3" data-field="price"> Item Price</label></li>
	    	</ul>
	    </div>    	
    </div>
	
		<table style="width: 60%; border: 1px solid rgb(221, 221, 221); text-align:center;" align="center">
			<thead>
				<tr>
					<th>
						<div>Nombre</div>
					</th>
					<th>
						<div >Apellido</div>
					</th>
					<th>
						<div >Item ID</div>
					</th>
					<th>
						<div >Item Name</div>
					</th>
					<th>
						<div >Item Price</div>
					</th>
				</tr>
			</thead>
		</table>
	


	<form id="formulario" action="grabarGasto.php" method="post">
		<!-- <img src="img/portada.png"/> -->
		<table border="0" style="text-align:center; width:100%;">
			<tr>
				<td>
					<select class="selectpicker" id="tipo_gasto" name="tipo_gasto" >
                        <option value="" style="text-align: center;">Seleccionar</option>
                      <?php foreach ($a_tipos_gasto as $option): ?>
                        <option style="text-align: center;" value="<?php echo $option['ID_TIPO_GASTO']; ?>"><?php echo $option['D_TIPO_GASTO']; ?></option>
                      <?php endforeach ?>
					</select>
				</td>                                                <!--  -->
			</tr>
<!--			<tr>
				<td>
					<div>
						<input type="text" style="border-radius:4px; width: 115px" class="form-control" placeholder="Username">
					</div>
				</td>
			</tr>-->
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
					<div class="input-append date" id="dp3" data-date="2014-11-02" data-date-format="yyyy-mm-dd">
						<input class="span2" id="fecha_gasto" value="2014-11-05" name="fecha_gasto" size="16" type="text" style="width:115px;" >
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




                <div class="page-header">
                    <button class="btn btn-primary start-example" data-zh="??????" data-es="Ver ejemplo">
                        Start Example
                    </button>
                </div>

                <div class="bs-example">
                    <table data-url="data1.json" id="tabla_gastos" data-height="299" data-show-refresh="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1">
                        <thead>
                        <tr>
                            <th data-field="nombre" data-align="right">Nombre</th>
                            <th data-field="apellido" data-align="left">Apellido</th>
                            <th data-field="id" data-align="right">Item ID</th>
                            <th data-field="name" data-align="center">Item Name</th>
                            <th data-field="price" data-align="left">Item Price</th>
                        </tr>
                        </thead>
                    </table>
                </div>

</body>
</html>