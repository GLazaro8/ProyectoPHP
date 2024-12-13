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
$usuario = unserialize($_SESSION['_usuario']) ;
var_dump($usuario) ;

try {

    $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

} catch (PDOException $excepcion) {
    die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
}

if(isset($_GET['id'])) {
    $idLibro = $_GET['id'];
}

$sql = "SELECT * FROM Libros l JOIN GenerosLiterarios gl ON l.IDGenero = gl.IDGenero WHERE l.IDLibro = :id ;" ;
$stmt = $pdo -> prepare($sql) ;
$stmt->bindParam(':id', $idLibro, PDO::PARAM_INT);
$stmt -> execute() ;

$libro = $stmt -> fetchObject() ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHeaven: Búsqueda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>

        body, .container {
            background-color: #ECF4E3;
        }

        nav{
            background-color: rgb(46, 169, 172) !important ;
        }

        #libro {
            margin-top: 5%;
            background-color: #ECF4E3;
            border: none;
            color: #132832;
        }

        #comentario {
            background-color: #ECF4E3;
        }

        #editar {
            background-color: #F59F29;
            color: #ffffff;
        }

        #editar:hover {
            background-color: #a55817;
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
        <div id="libro" class="card mb-3" style="width: 100%;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                
                <img src="<?= $libro -> URLPortada ?>" class="img-fluid rounded-start" alt="portada" style="padding-left: 20%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h1 class="card-title"><?= $libro -> Titulo ?></h1>
                        <h3 class="card-title"><b><?= $libro -> Autor ?></b></h3>
                        <h4 class="card-title"><i><?= $libro -> NombreGenero ?></i>    Nota: <?= $libro -> Nota ?></h4>
                        <p class="card-text"><?= $libro -> Sinopsis ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="titulo-comentarios">
            <h2>Comentarios</h2>
        </div>
        <hr>
        <div id="comentario" class="card my-3">
            <?php
                $sql = "SELECT * FROM Comentarios c JOIN Usuarios u ON c.IDUsuario = u.IDUsuario WHERE IDLibro = :id ;" ;
                $stmt = $pdo -> prepare($sql) ;
                $stmt -> bindParam(':id', $idLibro, PDO::PARAM_INT) ;
                $stmt -> execute() ;

                $hayComentarios = false;

                while($comentario = $stmt -> fetchObject()) {
                    $hayComentarios = true;

            ?>
                <div class="card-header d-flex align-items-center">
                    <img class="d-inline" src="<?= $comentario -> Imagen ?>" style="height: 50px;" alt="">
                    <h3 class="d-inline ms-2"><?= $comentario -> NombreUsuario ?></h3>
                </div>
                <div class="card-body">
                    <p><?= $comentario -> FechaComentario ?></p>
                    <p class="card-text"><?= $comentario -> TextoComentario ?></p>
            <?php   if(($comentario -> IDUsuario) === ($usuario -> ID))  { ?>
                    <a href="./editarCom.php" id="editar" class="btn">Editar</a>
                    <a href="./borrarCom.php" id="borrar" class="btn btn-danger">Borrar</a>
                </div>
            <?php  } } 
                if(!$hayComentarios) { ?>
                <div class="card-body">
                    <p class="card-text">Aún no hay comentarios sobre este libro</p>
                </div>
            <?php } ?>
        </div>
    </div>
    
</body>
</html>