<?php  
require_once "config.php"; 

class Modelo 
{ 
    protected $_db; 

    public function __construct() 
    { 

        $this->_db = mysql_connect(DB_HOST,  DB_USER, DB_PASS);
        if  (!$this->_db) {
            die('No pudo conectarse: ' . mysql_error());
        }

        if (!mysql_select_db(DB_NAME, $this->_db)) {
            echo 'No pudo seleccionar la base de datos';
            exit();
        }

    } 
} 
?> 