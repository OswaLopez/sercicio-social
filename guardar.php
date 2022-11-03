<!DOCTYPE html>
<body>
<?php
$ruta = "pruebas2022/{$_FILES['imagen']['name']}";
$imagen_tipo = $_FILES['imagen']['type'];
$imagen_tamano = $_FILES['imagen']['size'];
if ($imagen_tipo != "jpg" || $imagen_tipo != "jpeg") { //if para verificar si el tipo de imagen es JPG  y Si no es manda el mensaje de error
echo "Solo se permiten imagenes JPG";
}else{
    if($imagen_tamano < 2000000) {  
    throw new RuntimeException('Tamaño de archivo excedido.'); //excepcion al sobrepasar el limite
}  else {               //Si el formato de imagen es valido continua con la carga a la base de datos y a la carpeta
      if(!copy($_FILES['imagen']['tmp_name'], $ruta)) {
      echo "error al copiar el archivo";
      
      } else {
           echo "archivo subido con exito";
           $servername = "localhost";
           $username = "root";
           $password = "servicio2022";
           $dbname = "pruebas2022";
           
           $conn = new mysqli($servername, $username, $password, $dbname);

           $No_de_Control = $_POST["nombre"];
           mysql_query("INSERT INTO imagenes (No_de_Control, fecha_hora) 
                             VALUES ('$No_de_Control', NOW())");
           echo "Se ha subido la imagen a la base de datos";
      } 
} 
}
?>
</body>
</html>