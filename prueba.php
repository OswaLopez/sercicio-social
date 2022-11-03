<!DOCTYPE html>
<html>
<head>
<title>Alumnos Nuevo Ingreso</title>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th{ background-color: #404040; padding: 4px; }
td{ background-color: #bebebe; padding: 4px; }
</style>

<!-- CSS file Included  
<link rel="stylesheet"
        type="text/css" href="tec_estilo.css">--> 
</head>

<h2 style="color:#200000";>Alumnos Nuevo Ingreso</h2>
<body>
<div style="text-align:left;"><img src="descarga.jpg" alt="itq Icon" style="width:100px;height:1px;"></div>
<!--Agregar botón para exportar -->
<div class="container">
 <div class="well-sm col-sm-12"> 
 <div class="btn-group pull-right">  
 <form action=" <?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
 <button type ="submit" id="export_data" name='export_data'
  value= "Export to excel" class="btn btn-info">Exportar a Excel
</button>   
<input type="hidden" id="carrera" name="carrera" value = "<?php echo $_POST["carrera"] ?>">

 </form>
 </div>
 </div>  
 </div>  

 <?php
  /*if($_POST)
  {
    $carrera = $_POST ["carrera"];
  } */
  //$carrera = $NombreCarrera;
  $carrera = ($_POST)? $_POST ["carrera"] : 'Ningun dato seleccionado';
  
  //print_r($_POST);

  $servername = "localhost";
  $username = "root";
  $password = "servicio2022";
  $dbname = "pruebas2022";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT No_de_Control, Apellido_Paterno, Apellido_Materno, Nombre
          FROM alumnosni20223
         WHERE carrera = '$carrera'";


         
$result = $conn->query($sql);

//echo $result;
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
  /*  if(($i % 2)==0)
   {
      $id = "par";
    }
   else
   {
    $id = "non";
   }
  */
   $id = (($i % 2) ==0)? "par": "non";
   echo "<tr id = $id><td>".++$i."</td>
                      <td>".$row["No_de_Control"]."</td>
                      <td>".$row["Apellido_Paterno"]. "</td>
                      <td>".$row["Apellido_Materno"]. "</td>
                      <td>".$row["Nombre"]."</td>
        </tr>";
  }
 
  echo "</table>";
} else {
  echo "0 results";
}

// Mostrar tabla en Excell
if(isset($_POST["export_data"])) {
  if(!empty($result)) {
  $filename = "carreras.xls";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=".$filename);
  $mostrar_columnas = false;
 
  while($row = $result->fetch_assoc()){
  if(!$mostrar_columnas) {
  echo implode("\t", array_keys($result)) . "\n";
  $mostrar_columnas = true;
  }
  echo implode ("\t", array_values($result)) . "\n";
  }
 
  }else{
  echo 'No hay datos a exportar';
  }
  exit;
 }
 
//Print error_query
$error_message= mysqli_error($conn);
if($error_message == "")
{
  echo " Ningun error encontrado";
}
else{
  echo "Query failed: ".$error_message;
}
$conn->close();
?>  
</body>
</html>
