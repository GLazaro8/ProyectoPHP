<?php

    session_start() ;
    // session_destroy() ;

    if ((empty($_SESSION)) || 
        (time() >= $_SESSION["_tiempo"])):            
            $_SESSION = [] ;

            // redirigimos al login
            die(header("location: http://localhost:8080/index.php")) ;    
    endif ;

    // Actualizamos el tiempo de sesión
    $_SESSION["_tiempo"] = time() + 3000;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHeaven</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>

        body {
            color: #132832;
        }

        nav{
            background-color: rgb(46, 169, 172) !important ;
        }

        .bg {
            background-image: url(./assets/img/FondoBookHeaven.jpg);
            background-size: cover; 
            background-position: center; 
            height: 100vh;
        }

        /* #buscador {
            margin-top: 50%;
        } */

        h1 {
            color: #132832;
        }

        .blockquote {
            font-style: italic;
        }

        .blockquote-footer {
            color: #132832;
        }

        select {
            background-color: rgb(46, 169, 172) !important ;
            color: #ffffff !important;
        }

        select:hover  {
            background-color: #268a8d !important;
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

    </style>

</head>
<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./assets/img/cabecera book heaven.png" alt="Logo" width="300px" class="d-inline-block align-text-top">
            </a>
            <a href="logout.php" class="btn btn-danger d-flex">Cerrar sesión</a>
        </div>
    </nav>

    <div class="bg d-flex align-items-center justify-content-center" style="height: 100vh;">
        <form class="d-flex flex-column align-items-center w-50 mb-5" id="buscador" role="search">
            <figure class="text-center mb-4">
                <blockquote class="blockquote">
                    <h1>“El destino perfecto para los amantes de la lectura”</h1>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Creador de <cite title="Source Title">Book Heaven</cite>
                </figcaption>
            </figure>
            <div class="d-flex w-100">
                <select class="form-select form-select-md w-25 me-2" id="select" aria-label="busqueda por">
                    <option selected value="1">Título</option>
                    <option value="2">Autor</option>
                    <option value="3">Género</option>
                </select>
                <input class="form-control me-2" type="search" id="input-buscador" placeholder="Buscar libro" aria-label="buscar">
                <button class="btn" id="buscar" type="submit">Buscar</button>
            </div>
        </form>
    </div>
    
</body>
</html>

