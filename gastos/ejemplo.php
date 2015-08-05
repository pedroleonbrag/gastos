
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ejemplo</title>
<link rel="stylesheet" href="css/bootstrap.min2.css" />
<script src="js/jquery.js"></script>
<script src="js/jquery.rotate.1-1.js"></script>
<script src="js/jquery.min.js"></script>


<style>

html{
	width: 100%;
	height: 100%;
}

.botonLoco{
    background-color: darkcyan;
    height: 56px;
	width: 56px;
    position: absolute;
    right: 50px;
    bottom: 50px;
	float: right;
    box-shadow: 0 0 4px rgba(0,0,0,.14),0 4px 8px rgba(0,0,0,.28);
    box-sizing: content-box;
    cursor: pointer;
    outline: none;
    padding: 0;
    pointer-events: auto;
	border: none;
    border-radius: 50%;
}
.mas{
	background-image: url(img/mas.png);
	left: 0;
    margin-left: 16px;
    margin-top: 16px;
    position: relative;
    top: 0;
    -webkit-transition: all .2s cubic-bezier(.4,0,.2,1);
    transition: all .2s cubic-bezier(.4,0,.2,1);
	display: block;
    margin: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 24px;
    height: 24px;
    width: 24px;
    -webkit-user-drag: none;
}

</style>

<script>


function rotar() {    
    
    var r="360";
    
    $("#divmas").css("transform","rotate("+r+"deg)");
    $("#divmas").css("-moz-transform","rotate("+r+"deg)");
    $("#divmas").css("-webkit-transform","rotate("+r+"deg)");
    $("#divmas").css("-o-transform","rotate("+r+"deg)");
    $("#divmas").css("-webkit-transition-duration","1s");
    $("#divmas").css("transition-duration","1s");
    
    
}            

</script>

</head>



<body style="height: 100%;">

<br>



<br>

<br>

<div class="bs-example" data-example-id="bordered-table">
    <table class="table table-bordered" align="center" style="width:75%;">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
</div>    

<button class="botonLoco" onmouseover="rotar();" >
    <div id="divmas" class="mas"></div>
</button>


</body>
</html>