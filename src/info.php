<?php
ob_start();
session_start();

if ((empty($_SESSION['_usuario'])) ||  
    (time() >= $_SESSION["_tiempo"])) {            
    $_SESSION = [];

    // Redirigimos al login
    die(header("location: http://localhost:8080/index.php"));    
}

// Actualizamos el tiempo de sesión
$_SESSION["_tiempo"] = time() + 3000;
$usuario = unserialize($_SESSION['_usuario']);

try {
    $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $excepcion) {
    die("ERROR de conexión con la base de datos: " . $excepcion->getMessage());
}

if (isset($_GET['id'])) {
    $idLibro = $_GET['id'];
}

$mostrarModal = false; // Para reabrir el modal si hay errores
$mostrarEditarModal = false; // Para reabrir el modal de edición si hay errores
$comentarioEditado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos si es una edición (idComentario presente)
    if (isset($_POST['idComentario']) && is_numeric($_POST['idComentario'])) {
        $idComentario = (int)$_POST['idComentario'];
        $textoComentario = $_POST['textoComentario'] ?? '';

        if (!empty($textoComentario)) {
            // Actualizar comentario existente
            $sql = "UPDATE Comentarios 
                    SET TextoComentario = :textoComentario, FechaComentario = :fecha 
                    WHERE IDComentario = :idComentario AND IDUsuario = :idUsuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':textoComentario', $textoComentario, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindParam(':idComentario', $idComentario, PDO::PARAM_INT);
            $stmt->bindParam(':idUsuario', $usuario->IDUsuario, PDO::PARAM_INT);
            $stmt->execute();

            // Redirigir para evitar reenvío POST
            header("Location: ./info.php?id=$idLibro");
            exit;
        } else {
            // Reabrir el modal de edición si el texto está vacío
            $mostrarEditarModal = true;

            // Obtener datos del comentario para mostrar en el modal
            $sql = "SELECT * FROM Comentarios WHERE IDComentario = :idComentario AND IDUsuario = :idUsuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idComentario', $idComentario, PDO::PARAM_INT);
            $stmt->bindParam(':idUsuario', $usuario->IDUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $comentarioEditado = $stmt->fetchObject();
        }
    } else {
        // Si no es edición, asumimos que es un nuevo comentario
        $textoComentario = $_POST['textoComentario'] ?? '';

        if (!empty($textoComentario)) {
            $idUsu = $usuario->IDUsuario;
            $idLib = $idLibro;
            $fecha = date('Y-m-d H:i:s');

            $sql = "INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario, FechaComentario) 
                    VALUES (:idUsu, :idLib, :textoComentario, :fecha)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsu', $idUsu, PDO::PARAM_INT);
            $stmt->bindParam(':idLib', $idLib, PDO::PARAM_INT);
            $stmt->bindParam(':textoComentario', $textoComentario, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->execute();

            // Redirigir para evitar reenvío POST
            header("Location: ./info.php?id=$idLib");
            exit;
        } else {
            // Reabrir el modal de nuevo comentario si está vacío
            $mostrarModal = true;
        }
    }
}

// Cargar detalles del libro
$sql = "SELECT * FROM Libros l JOIN GenerosLiterarios gl ON l.IDGenero = gl.IDGenero WHERE l.IDLibro = :id;";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $idLibro, PDO::PARAM_INT);
$stmt->execute();
$libro = $stmt->fetchObject();

// Cargar detalles del comentario a editar
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $idComentario = (int)$_GET['edit'];

    $sql = "SELECT * FROM Comentarios WHERE IDComentario = :idComentario AND IDUsuario = :idUsuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idComentario', $idComentario, PDO::PARAM_INT);
    $stmt->bindParam(':idUsuario', $usuario->IDUsuario, PDO::PARAM_INT);
    $stmt->execute();
    $comentarioEditado = $stmt->fetchObject();

    if ($comentarioEditado) {
        $mostrarEditarModal = true; // Mostrar modal de edición automáticamente
    }
}
ob_end_flush();
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

        #nuevo-comentario {
            margin-bottom: 10px;
        }

        #nuevo-comentario, #enviar, #guardar {
            background-color: rgb(46, 169, 172) ;
            color: #ffffff !important;
        }

        #nuevo-comentario:hover, #enviar:hover, #guardar:hover {
            background-color: #268a8d;
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
            <?php
                $sql = "SELECT * FROM Comentarios c JOIN Usuarios u ON c.IDUsuario = u.IDUsuario WHERE IDLibro = :id ;" ;
                $stmt = $pdo -> prepare($sql) ;
                $stmt -> bindParam(':id', $idLibro, PDO::PARAM_INT) ;
                $stmt -> execute() ;

                $hayComentarios = false;

                while($comentario = $stmt -> fetchObject()) {
                    $hayComentarios = true;

            ?>
            <div id="comentario" class="card my-3">
                <div class="card-header d-flex align-items-center">
                    <img class="d-inline" src="<?= $comentario -> Imagen ?>" style="height: 50px;" alt="">
                    <h3 class="d-inline ms-2"><?= $comentario -> NombreUsuario ?></h3>
                </div>
                <div class="card-body">
                    <p><?= $comentario -> FechaComentario ?></p>
                    <p class="card-text"><?= $comentario -> TextoComentario ?></p>
            <?php   if(($comentario -> IDUsuario) === ($usuario -> IDUsuario))  { ?>
                    <a href="./info.php?id=<?= $idLibro ?>&edit=<?= $comentario->IDComentario ?>" id="editar" class="btn">Editar</a>
            <?php } if((($comentario -> IDUsuario) === ($usuario -> IDUsuario )) || ($usuario -> Rol === "Administrador")) { ?>
                    <a href="./borrar.php?id=<?= $comentario -> IDComentario ?>" id="borrar" class="btn btn-danger">Borrar</a>
                <?php } ?>
                </div>
            </div>
            <?php }  
                if(!$hayComentarios) { ?>
            <div id="no-comentario" class="card my-3">
                <div class="card-body">
                    <p class="card-text">Aún no hay comentarios sobre este libro</p>
                </div>
            <?php } ?>
            </div>
        <?php   $sql = "SELECT u.IDUsuario FROM Comentarios c JOIN Usuarios u ON c.IDUsuario = u.IDUsuario WHERE IDLibro = :id ;" ;
                $stmt = $pdo -> prepare($sql) ;
                $stmt -> bindParam(':id', $idLibro, PDO::PARAM_INT) ;
                $stmt -> execute() ;

                $id = false ;

                while($userid = $stmt -> fetchObject()) {
                    if($userid -> IDUsuario === $usuario -> IDUsuario) {
                        $id = true ;
                    }
                }

                if(!$id) {
        ?>
        <div class="d-flex justify-content-center">
            <a class="btn" id="nuevo-comentario" data-bs-toggle="modal" data-bs-target="#commentModal">Añadir comentario</a>
        </div>
        <?php   } ?>
                <!-- MODAL PARA AÑADIR COMENTARIO -->
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Añadir Comentario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <!-- Enviar también el ID del libro -->
                            <input type="hidden" name="idLibro" value="<?= $idLibro ?>">

                            <div class="mb-3">
                                <label for="textoComentario" class="form-label">Comentario:</label>
                                <textarea id="textoComentario" name="textoComentario" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" id="enviar" class="btn">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA EDITAR COMENTARIO -->
        <div class="modal fade <?= $mostrarEditarModal ? 'show' : '' ?>" id="editModal" tabindex="-1" aria-hidden="true" style="<?= $mostrarEditarModal ? 'display: block;' : '' ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Comentario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <!-- Campo oculto para el ID del comentario -->
                            <input type="hidden" name="idComentario" value="<?= $comentarioEditado->IDComentario ?? '' ?>">
                            <div class="mb-3">
                                <label for="textoComentario" class="form-label">Comentario:</label>
                                <textarea id="textoComentario" name="textoComentario" class="form-control" rows="4" required><?= $comentarioEditado->TextoComentario ?? '' ?></textarea>
                            </div>
                            <button type="submit" id="guardar" class="btn">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
<?php if ($mostrarEditarModal){ ?>
    var editModal = new bootstrap.Modal(document.getElementById('editModal'), {
        backdrop: 'static',
        keyboard: false
    });
    editModal.show();
    <?php } ?>
</script>

</html>