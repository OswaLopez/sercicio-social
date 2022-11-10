<?php
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
print $carrera = ($_POST)? $_POST ["carrera"] : 'Ningun dato seleccionado';

echo $sql = "SELECT No_de_Control, Apellido_Paterno, Apellido_Materno, Nombre
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

// Mostrar tabla en Excell
if(isset($_POST["export_data"])) {
if(!empty($result)){
$filename = "carreras.xls";

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
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