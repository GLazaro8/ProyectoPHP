<?php

    session_start() ;
    // session_destroy() ;

    if ((empty($_SESSION['_usuario'])) ||  
        (time() >= $_SESSION["_tiempo"])){            
            $_SESSION = [] ;

            // redirigimos al login
            die(header("location: http://localhost:8080/index.php")) ;    
        }

    // Actualizamos el tiempo de sesión
    $_SESSION["_tiempo"] = time() + 3000;

        try {

            $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        } catch (PDOException $excepcion) {
            die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
        }

        // Valores recogidos del formulario
        $busqueda = $_SESSION['_busqueda'] ;
        $busqueda = '%' . $busqueda . '%';
        $libros = [] ;

        // Preparamos la consulta
        $sql = "SELECT * FROM Libros l JOIN
                GenerosLiterarios gl ON l.IDGenero = gl.IDGenero
                WHERE LOWER(Titulo) LIKE :busqueda
                OR LOWER(Autor) LIKE :busqueda
                OR LOWER(NombreGenero) LIKE :busqueda ;" ;
        
        $stmt = $pdo -> prepare($sql) ;
        $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR) ;

        // Ejecutamos la consulta
        $stmt -> execute() ;

        while($libro = $stmt -> fetchObject()) {
            $libros[] = $libro ;
        }

        $_SESSION["_tiempo"] = time() + 3000;

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHeaven: Búsqueda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway"/>

    <style>

        body, .container {
            background-color: #ECF4E3;
            font-family: 'Raleway', sans-serif;
        }

        nav{
            background-color: rgb(46, 169, 172) !important ;
        }

        #input-buscador {
            background-color: #ECF4E3;
        }

        #buscar {
            background-color: #F59F29;
            color: #ffffff;
        }

        #buscar:hover {
            background-color: #a55817;
        }

        .card {
            margin: 2%;
        }

        #boton {
            background-color: rgb(46, 169, 172);
            color: #ECF4E3;
        }

        #boton:hover {
            background-color: #268a8d;
            color: #ECF4E3;
        }

        .card {
            background-color: #ECF4E3;
            border: none;
        }

    </style>

</head>

<body>

    <nav class="navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img src="./assets/img/cabecera book heaven.png" alt="Logo" width="300px" class="d-inline-block align-text-top">
            </a>
            <a href="logout.php" class="btn btn-danger d-flex">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container">
            <?php 
                if(!empty($libros)) {
                    foreach($libros as $libro) {                    
            ?>
        <hr>
        <div class="card mb-3" style="width: 100%;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                
                <img src="<?= $libro -> URLPortada ?>" class="img-fluid rounded-start" alt="portada" style="height: 300px; padding-left: 20%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><?= $libro -> Titulo ?></h3>
                        <h5 class="card-title"><b><?= $libro -> Autor ?></b></h5>
                        <h5 class="card-title"><i><?= $libro -> NombreGenero ?></i>    Nota: <?= $libro -> Nota ?></h5>
                        <p class="card-text"><?= $libro -> Sinopsis ?></p>
                        <a href="./info.php?id=<?= $libro -> IDLibro ?>" class="btn" id="boton">Saber más</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else { ?>
        <div class="alert alert-danger mt-2 text-center">
                        No hay ningún libro que coincida con su búsqueda
                    </div> 
        <?php } ?>
        <hr>
    </div>
    
</body>
</html>