<?php
$servername = "localhost";
$username = "root";
$password = "servicio2022";
$dbname = "pruebas2022";

$conn = new mysqli($servername, $username, $password, $dbname);

  $sql = "SELECT NombreCarrera, carrera
            FROM carreras 
        ORDER BY carrera ASC";
  $resul = $conn->query($sql);

?>
<html>
    <head>
    <title>Lista Carreras</title>
    <link rel="stylesheet"
        type="text/css" href="tec_estilo.css">
    </head>
<body bgcolor="">
<form id="form" name="form" method="post" action="prueba.php">
            Carreras:
            <select name= "carrera">
            <option value="">--- Select ---</option>
<?php
while ($cat = mysqli_fetch_array($resul,MYSQLI_ASSOC)):;?>
    <option value="<?php echo $cat['carrera'];?>">
    <?php echo $cat['NombreCarrera'];?>
    </option>
<?php
endwhile;
?>
</select>
<input type="submit" name="Submit" value="Mostrar en Pantalla"/>
</form>

 <!--Botón de exportar a excell -->

<div class="col-md-8">
<?php 
  $carrera = ($_POST)? $_POST ["carrera"] : 'Ningun dato seleccionado';
?> 
<!--<button class="btn btn-success pull-right" name="export_data">Exportar a Excel</button>-->
			<form method="POST" action="create_excel.php">
            <button type ="submit" id="export_data" name='export_data' value= "Export to excel" class="btn btn-info">Exportar a Excel</button> 
                <input type="hidden" id="carrera" name="carrera" value = "<?php echo $_POST["carrera"]?>">
            </form>
			
			<table class="table table-bordered">
				<thead class="alert-info">
					<tr>
						<th>#</th>
						<th>No. de Control</th>
						<th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Nombre</th>
					</tr>
				</thead>
				<tbody>
					<?php
						require 'connect.php';
                       
						$sql = "SELECT No_de_Control, Apellido_Paterno, Apellido_Materno, Nombre
                                  FROM alumnosni20223
                                 WHERE carrera = '$carrera'";
                        $result = $conn->query($sql);
if ($result -> num_rows > 0) {
    // output data of each row
    
    echo "<table>       
       <caption>ALUMNOS</caption>
        <tr>
          <th>#</th>
          <th>No. de Control</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Nombre</th>
        </tr>";
    $i=0;
    while($row = $result->fetch_assoc()) {
    $id = (($i % 2) ==0)? "par": "non";
    echo "<tr id = $id><td>".++$i."</td>
                <td>".$row["No_de_Control"]. "</td>
                <td>".$row["Apellido_Paterno"]. "</td>
                <td>".$row["Apellido_Materno"]. "</td>
                <td>".$row["Nombre"]."</td> </tr>";
    }
    echo "</table>";
    } else { 
    echo "0 results"; 
    }

					?>
				</tbody>
			</table>
		</div>

</body>
</html>