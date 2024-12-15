<?php
session_start();

if ((empty($_SESSION['_usuario'])) || (time() >= $_SESSION["_tiempo"])) {            
    $_SESSION = [];
    die(header("Location: http://localhost:8080/index.php"));
}

// Actualiza el tiempo de sesión
$_SESSION["_tiempo"] = time() + 3000;
$usuario = unserialize($_SESSION['_usuario']);

try {
    $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $excepcion) {
    die("ERROR de conexión con la base de datos: " . $excepcion->getMessage());
}

$comentarioEditado = null;
$mostrarEditarModal = false;

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $idComentario = (int) $_GET['edit'];

    // Obtener los datos del comentario para edición
    $sql = "SELECT * FROM Comentarios WHERE IDComentario = :idComentario AND IDUsuario = :idUsuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idComentario', $idComentario, PDO::PARAM_INT);
    $stmt->bindParam(':idUsuario', $usuario->IDUsuario, PDO::PARAM_INT); // Solo el autor puede editar
    $stmt->execute();
    $comentarioEditado = $stmt->fetchObject();

    if ($comentarioEditado) {
        $mostrarEditarModal = true; // Mostrar modal de edición automáticamente
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idComentario'])) {
    $idComentario = (int) $_POST['idComentario'];
    $textoComentario = $_POST['textoComentario'] ?? '';

    if (!empty($textoComentario)) {
        $sql = "UPDATE Comentarios SET TextoComentario = :textoComentario, FechaComentario = :fecha 
                WHERE IDComentario = :idComentario AND IDUsuario = :idUsuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':textoComentario', $textoComentario, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindParam(':idComentario', $idComentario, PDO::PARAM_INT);
        $stmt->bindParam(':idUsuario', $usuario->IDUsuario, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir para evitar reenvíos POST
        header("Location: ./info.php?id=$idLibro");
        exit;
    } else {
        $mostrarEditarModal = true; // Reabrir modal si hay errores
    }
}
?>
