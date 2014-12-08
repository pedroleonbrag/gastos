<?php
require_once "modelo.php"; 

class gastosModelo extends Modelo 
{     
    public function __construct()
    { 
        parent::__construct(); 
    } 

    public function get_tipos_gasto()
    {
        $result = mysql_query('SELECT * FROM TIPO_GASTO', $this->_db);

        return $result;
    }

	public function get_gastos($inicio, $cantidad)
    {
        $result = mysql_query('SELECT SQL_CALC_FOUND_ROWS GA.VALOR, DAY(GA.FECHA_GASTO) DIA, MONTH(GA.FECHA_GASTO) MES, YEAR(GA.FECHA_GASTO) ANIO, GA.FECHA_GASTO, GA.COMENTARIOS, TA.D_TIPO_GASTO FROM GASTO GA JOIN TIPO_GASTO TA ON TA.ID_TIPO_GASTO=GA.ID_TIPO_GASTO ORDER BY FECHA_GASTO DESC, ID_GASTO DESC LIMIT '.$inicio.', '.$cantidad, $this->_db);

        return $result;
    }

	public function get_gastos_comment($comentario)
    {
		$comentario = strtoupper($comentario);

        $result = mysql_query('SELECT GA.VALOR, DAY(GA.FECHA_GASTO) DIA, MONTH(GA.FECHA_GASTO) MES, YEAR(GA.FECHA_GASTO) ANIO, GA.FECHA_GASTO, GA.COMENTARIOS, TA.D_TIPO_GASTO FROM GASTO GA JOIN TIPO_GASTO TA ON TA.ID_TIPO_GASTO=GA.ID_TIPO_GASTO WHERE UPPER(COMENTARIOS) LIKE \'%'.$comentario.'%\' ORDER BY FECHA_GASTO DESC', $this->_db);

        return $result;
    }

    public function grabar_gasto($id_tipo_gasto, $valor, $fecha_gasto, $comentarios, $fecha_ingreso)
    {
        $result = mysql_query('INSERT INTO GASTO(ID_TIPO_GASTO, VALOR, FECHA_GASTO, COMENTARIOS, FECHA_INGRESO) VALUES ('.$id_tipo_gasto.', '.$valor.', \''.$fecha_gasto.'\', \''.$comentarios.'\', \''.$fecha_ingreso.'\')', $this->_db);
        
        return $result;
    }

    public function get_total()
    {
        $result = mysql_query('SELECT FOUND_ROWS() AS TOTAL', $this->_db);

        $total = mysql_fetch_assoc($result);
        return $total['TOTAL'];
    }

    public function get_total_gastos()
    {
        $result = mysql_query('SELECT SUM(VALOR) AS TOTAL FROM GASTO WHERE ID_TIPO_GASTO<>5 ', $this->_db);

        $total = mysql_fetch_assoc($result);
        return $total['TOTAL'];
    }

    public function get_top_5()
    {
        $result = mysql_query('SELECT TG.D_TIPO_GASTO, SUM(GA.VALOR) SUMA FROM GASTO GA JOIN TIPO_GASTO TG ON TG.ID_TIPO_GASTO = GA.ID_TIPO_GASTO WHERE GA.ID_TIPO_GASTO <> 5 GROUP BY TG.D_TIPO_GASTO ORDER BY SUMA DESC', $this->_db);

        return $result;
    }    

} 
?> 