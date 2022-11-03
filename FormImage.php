
<html>
<head>
<title>Subir imagenes</title>
</head>

<body>
    <div align="center">
        <form enctype="multipart/form-data" action="guardar.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />
            Numero de Control:<br />
            <input type="text" name="nombre" /><br />
           
            Subir imagen:<br />
            <input type="file" name="imagen" /><br /><br />
            <input type="submit" value="Subir Imagen" /><br /><br />
        </form>
</div>
</body>
</html>