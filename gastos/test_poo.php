<?php
    date_default_timezone_set('GMT');

    require_once "gastosModelo.php";

    $gastosModel = new gastosModelo();
    $a_users = $gastosModel->get_tipos_gasto();
?>

<!DOCTYPE html> 
 <html> 
 <head> 
     <title>Usuarios registrados</title> 
 </head> 
 <body> 
     <table > 
            <tr> 
                <td> 
                    Id
                </td>
                <td > 
                    Nombre 
                </td> 
                <td> 
                    Correo 
                </td> 
            </tr><!-- /THEAD --> 

            <?php foreach ($a_users as $row): ?>

            <tr>
                <td><?php echo $row['ID_TIPO_GASTO']; ?></td>
                <td><?php echo $row['D_TIPO_GASTO']; ?></td>
                <td><?php echo $row['DETALLE']; ?></td>
            </tr><!-- /TROW -->

            <?php endforeach ?>
                  
        </table> 
    
 </body> 
 </html> 