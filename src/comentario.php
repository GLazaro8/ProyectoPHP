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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

    } catch (PDOException $excepcion) {
        die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
    }

    if(isset($_GET['id'])) {
        $idLibro = $_GET['id'];
    }

    if(!empty($_POST)) {

        $idUsu = $usuario -> IDUsuario ;
        $idLib = $idLibro ;
        $textoComentario = $_POST['comentario'] ;
        $fecha = date('Y-m-d H:i:s') ;

        $sql = "INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario, FechaComentario) VALUES
                (:idUsu, :idLib, :textoComentario, :fecha) ;" ;
        $stmt = $pdo -> prepare($sql) ;
        $stmt -> bindParam(':idUsu', $idUsu, PDO::PARAM_INT) ;
        $stmt -> bindParam(':idLib', $idLib, PDO::PARAM_INT) ;
        $stmt -> bindParam(':textoComentario', $textoComentario, PDO::PARAM_STR) ;
        $stmt -> bindParam(':fecha', $fecha, PDO::PARAM_STR) ;
        $stmt -> execute() ;

        header('Location: ./info.php?id={$idLib}') ;

    }
}

?>
