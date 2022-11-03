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
    </head>
    <BODY bgcolor ="blue">
        <head><link rel="stylesheet"
        type="text/css" href="tec_estilo.css">
</head>
        <form id="form" name="form" method="post" action="prueba.php">
            Carreras:
            <select name = "carrera">
            <option value="">--- Select ---</option>

        <?php

            while ($cat = mysqli_fetch_array(
                                $resul,MYSQLI_ASSOC)):;

                ?>
                    <option value="<?php echo $cat['carrera'];
                    ?>">
                               <?php echo $cat['NombreCarrera'];?>
                    </option>
                <?php
              endwhile;
                ?>
            </select>
            <input type="submit" name="Submit" value="Mostrar en Pantalla" />
        </form>
<!-- Botón para exportar a excell -->
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


 
 
    </body>
</html>