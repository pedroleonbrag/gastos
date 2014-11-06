<?php
date_default_timezone_set('GMT');
// nos  conectamos a ejemplo.com y al puerto 3307
$enlace = mysql_connect('200.85.152.116',  'pedroleon_us1', 'pepe');
if  (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente<br>';

if (!mysql_select_db('pedroleon_bd1', $enlace)) {
    echo 'No pudo seleccionar la base de datos';
    exit();
}

$sql       = 'SELECT * FROM TIPO_GASTO';
$resultado = mysql_query($sql, $enlace);

if (!$resultado) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit();
}

echo "<table>";
while ($fila = mysql_fetch_assoc($resultado)) {
	echo "<tr>";
	echo "<td>".$fila['ID_TIPO_GASTO']."</td><td>".$fila['D_TIPO_GASTO']."</td>";
	echo "</tr>";
}
echo "</table>";

mysql_free_result($resultado);


mysql_close($enlace);
?>