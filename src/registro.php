<?php

    session_start() ;

    if(!empty($_POST)) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {

                // Creamos la conexión
                $pdo = new PDO("mysql:host=db;dbname=BookHeaven;charset=utf8mb4", "root", "") ;

                // Configuramos atributos. Estos dos nos aseguran que si ocurre un error con PDO,
                // se lanzará una excepción que podemos manejar
                $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

                // Valores recogidos del formulario
                $nombreUsuario = $_POST['nombreUsuario'] ;
                $nombre = $_POST['nombre'] ;
                $apellidos = $_POST['apellidos'] ;
                $email = $_POST['email'] ;
                $imagen = $_POST['imagen'] ;
                $clave = $_POST['clave'] ;
                $rol = $_POST['rol'] ;

                $sql = "INSERT INTO Usuarios (Nombre, Apellidos, NombreUsuario, Imagen, Email, Contrasena, Rol) VALUES
                        (:nombre, :apellidos, :nombreUsuario, :imagen, :email, :clave, :rol)" ;
                $stmt = $pdo -> prepare($sql) ;
                $stmt -> bindValue(":nombre", $nombre, PDO::PARAM_STR); 
                $stmt -> bindValue(":apellidos", $apellidos, PDO::PARAM_STR); 
                $stmt -> bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR); 
                $stmt -> bindValue(":imagen", $imagen, PDO::PARAM_STR); 
                $stmt -> bindValue(":email", $email, PDO::PARAM_STR); 
                $stmt -> bindValue(":clave", $clave, PDO::PARAM_STR); 
                $stmt -> bindValue(":rol", $rol, PDO::PARAM_STR); 
                $stmt -> execute() ;

                // Redirigimos al login
                header("Location: http://localhost:8080/index.php"); 
                exit();
    
            } catch (PDOException $excepcion) {
                die("ERROR de conexión con la base de datos: " . $excepcion->getMessage()) ;
            }

        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Heaven: Registro</title>

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
                <h1 class="card-title text-center">Registro</h1>
                <div class="card-body">
                    <form action="registro.php" method="post">

                        <!-- Nombre de Usuario -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Nombre de Usuario</label>
                                <input class="form-control" type="text" name="nombreUsuario" placeholder="Añada un nombre de usuario" autofocus required />
                            </div>
                        </div>
                        
                        <!-- Nombre -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Nombre</label>
                                <input class="form-control" type="text" name="nombre" placeholder="Indique su nombre" required />
                            </div>
                        </div>

                        <!-- Apellidos -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Apellidos</label>
                                <input class="form-control" type="text" name="apellidos" placeholder="Indique sus apellidos" required />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="ejemplo@email.es" required />
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Imagen</label>
                                <input class="form-control" type="text" name="imagen" placeholder="Inserte la url de su imagen de perfil" />
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="row mt-3">
                            <div class="col">
                                <label>Contraseña</label>
                                <input class="form-control" type="password" name="clave" placeholder="" required/>
                            </div>
                        </div>

                        <!-- Rol -->
                        <div class="row mt-3 d-none" >
                            <div class="col">
                                <label>Rol</label>
                                <input class="form-control" type="text" name="rol" value="Usuario" required/>
                            </div>
                        </div>          

                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn w-100 mt-2" href="./index.php" type="submit">Registrarme</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>