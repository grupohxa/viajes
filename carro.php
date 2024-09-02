<?php
include 'session_config.php';
include 'carrito.php';
include 'notifications.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Carrito de Compras</title>
</head>
<body>

<header>
    <nav class="navbar bg-dark ps-1">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 text-primary ms-2" href="index.php">
                <img class="travel" src="./assets/img/travel.png" alt="Icono avión">
                Viajes Chile
            </a>
        </div>
    </nav>
</header>

<main class="container my-5">
    <h2>Carrito de Compras</h2>
    <?php mostrarCarrito(); ?>
</main>

<section>
    <div class="container">
        <a href="index.php" class="btn btn-primary" role="button">Volver al inicio</a>
</section>

<!-- Scripts JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>
</html>
