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

try {

    $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

} catch (PDOException $excepcion) {
    die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
}

if (isset($_GET['id'])) {
    $idComentario = $_GET['id'];

    // Obtener el ID del libro asociado al comentario
    $sql = "SELECT IDLibro FROM Comentarios WHERE IDComentario = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idComentario, PDO::PARAM_INT);
    $stmt->execute();
    $comentario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si existe el comentario y se obtiene el ID del libro
    if ($comentario) {
        $idLibro = $comentario['IDLibro'];

        // Eliminar el comentario
        $sql = "DELETE FROM Comentarios WHERE IDComentario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $idComentario, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir a la página info.php del libro
        header("Location: ./info.php?id=" . $idLibro);
        exit;
    } else {
        // En caso de que no se encuentre el comentario, puedes redirigir a otra página o mostrar un error
        die("Comentario no encontrado.");
    }
}

?>