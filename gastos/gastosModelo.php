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
        $result = $this->_db->query('SELECT * FROM TIPO_GASTO');

        $users = $result->fetch_all(MYSQLI_ASSOC);

        return $users;
    }

	public function get_gastos()
    {
        $result = $this->_db->query('SELECT GA.VALOR, DAY(GA.FECHA_GASTO) DIA, MONTH(GA.FECHA_GASTO) MES, YEAR(GA.FECHA_GASTO) ANIO, GA.FECHA_GASTO, GA.COMENTARIOS, TA.D_TIPO_GASTO FROM GASTO GA JOIN TIPO_GASTO TA ON TA.ID_TIPO_GASTO=GA.ID_TIPO_GASTO ORDER BY FECHA_GASTO DESC');

        $users = $result->fetch_all(MYSQLI_ASSOC);

        return $users;
    }

    public function grabar_gasto($id_tipo_gasto, $valor, $fecha_gasto, $comentarios, $fecha_ingreso)
    {
        $stmt = $this->_db->prepare("INSERT INTO GASTO(ID_TIPO_GASTO, VALOR, FECHA_GASTO, COMENTARIOS, FECHA_INGRESO) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('idsss', $id_tipo_gasto, $valor, $fecha_gasto,$comentarios, $fecha_ingreso);
        $stmt->execute();
        $newId = $stmt->insert_id;
        $stmt->close();
    }
} 
  ?> 