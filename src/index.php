<?php

    session_start() ;
    if(!empty($_SESSION)) die(header("location: main.php")) ;

    $visible = "d-none" ;

    if(!empty($_POST)) {

        try {

            // Creamos la conexión
            $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

            // Configuramos atributos. Estos dos nos aseguran que si ocurre un error con PDO,
            // se lanzará una excepción que podemos manejar
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        } catch (PDOException $excepcion) {
            die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Valores recogidos del formulario
            $email = $_POST['email'] ;
            $clave = $_POST['clave'] ;

            // Prepramos la consulta
            $sql = "SELECT * FROM Usuarios WHERE Email = :email" ;
            $stmt = $pdo -> prepare($sql) ;

            // Asociamos lo valores
            $stmt -> bindParam(':email', $email, PDO::PARAM_STR) ;

            // Ejecutamos la consulta
            $stmt -> execute() ;
            $user = $stmt -> fetch(PDO::FETCH_ASSOC) ;

            // Verificamos que el email y la contraseña son correctos
            if($user && $clave === $user['Contrasena']) {

                // Guardamos el usuario en la sesión
                $_SESSION["_tiempo"]  = time() + 3000 ;
                $_SESSION['email'] = $user['Email'] ;

                // Lo mandamos a nuestra página main
                header('Location: ./main.php') ;

            } else {

                // Ponemos visible el mensaje de error de contraseña o email
                $visible = "" ;

            }

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Heaven</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>

        body {
            color: #132832;
            background-image: url(./assets/img/FondoBookHeaven.jpg);
            background-size: cover;
        }

        nav{
            background-color: rgb(46, 169, 172) !important ;
        }

        .card {
            background-color: rgba(236, 244, 227, .8);
            border-radius: 10px;
            box-shadow: 5px 5px 10px 0 rgba(0, 0, 0, .5);
            color: #132832;
        }

        label {
            margin-bottom: 5px;
        }

        .btn{
            background-color: rgb(46, 169, 172) ;
            color: #ffffff;
        }

        .btn:hover {
            background-color: #268a8d;
            color: #ffffff;
        }

        #registrarse {
            background-color: #F59F29;
            color: #ffffff;
        }

        #registrarse:hover {
            background-color: #a55817;
        }

    </style>
</head>
<body>

    <nav class="navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./assets/img/cabecera book heaven.png" alt="Logo" width="300px" class="d-inline-block align-text-top">
            </a>
        </div>
    </nav>

    <div class="bg d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container d-flex flex-column align-items-center w-50 mb-5">
            <div class="card mt-4 mx-auto" style="width: 34rem;">
                <h1 class="card-title text-center">Login</h1>
                <div class="card-body">
                    <form action="index.php" method="post">
                        <!-- EMAIL -->
                        <div class="row mb-4">
                            <div class="col">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="email@bookheaven.com" autofocus required />
                            </div>
                        </div>

                        <!-- CONTRASEÑA -->
                        <div class="row mt-2 mb-4">
                            <div class="col">
                                <label>Contraseña</label>
                                <input class="form-control" type="password" name="clave" placeholder="contraseña" required />
                            </div>
                        </div>

                        <div class="alert alert-danger mt-2 <?= $visible ?>">
                            Email o contraseña incorrecta
                        </div>           

                        <div class="row mt-2">
                            <div class="col">
                                <button class="btn w-100 mt-2">Entrar</button>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <a class="btn w-100 mt-2" id="registrarse" href="./registro.php">Registrarme</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>