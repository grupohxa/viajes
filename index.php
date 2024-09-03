<?php
include 'session_config.php';
include 'carrito.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <title>Agencia de Viajes</title>
</head>
<body>

<?php include 'notifications.php'; mostrarNotificaciones(); ?>
    
<header>
<nav class="navbar bg-dark ps-1">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 text-primary ms-2" href="#">
            <img class="travel" src="./assets/img/travel.png" alt="Icono avión">
            Viajes Chile
        </a>
        <form class="search-container d-flex ms-auto">
            <input type="text" id="destination" class="form-control me-2" placeholder="Destino" required>
            <input type="date" id="travel-date" class="form-control me-2">
            <button class="btn btn-outline-primary" type="submit" onclick="search(event)">Buscar</button>
        </form>
        <a href="carro.php" class="ms-3">
            <button type="button" class="btn">
                <i class="bi bi-cart4" style="font-size: 1.5rem; color: cornflowerblue;"></i>
            </button>
        </a>
    </div>
</nav>

</header>

<main>
    <!-- Sección viajes en Chile -->
    <section class="container my-5 pb-5">
    <h2>Viaja por Chile</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <div class="col">
            <div class="card">
                <img src="./assets/img/isla_pascua.jpeg" class="card-img-top" alt="Isla de Pascua">
                <div class="card-body">
                    <h5 class="card-title">Isla de Pascua</h5>
                    <p class="card-text">Partiendo desde Santiago de Chile</p>
                    <small class="text-muted">Precio final por persona</small>
                    <p class="card-text">$1.114.503</p>
                    <form method="post" action="add_to_cart.php" class="quantity-form">
                        <input type="hidden" name="nombre" value="Isla de Pascua">
                        <input type="hidden" name="precio" value="1114503">
                        <div class="quantity-controls">
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, -1)">-</button>
                            <input type="text" name="cantidad" value="1" class="quantity-input" readonly>
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary ms-3">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="./assets/img/puerto_varas.jpg" class="card-img-top" alt="Puerto Varas">
                <div class="card-body">
                    <h5 class="card-title">Puerto Varas</h5>
                    <p class="card-text">Partiendo desde Santiago de Chile</p>
                    <small class="text-muted">Precio final por persona</small>
                    <p class="card-text">$218.602</p>
                    <form method="post" action="add_to_cart.php" class="quantity-form">
                        <input type="hidden" name="nombre" value="Puerto Varas">
                        <input type="hidden" name="precio" value="218602">
                        <div class="quantity-controls">
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, -1)">-</button>
                            <input type="text" name="cantidad" value="1" class="quantity-input" readonly>
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary ms-3">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="./assets/img/valdivia.jpeg" class="card-img-top" alt="Valdivia">
                <div class="card-body">
                    <h5 class="card-title">Valdivia</h5>
                    <p class="card-text">Partiendo desde Santiago de Chile</p>
                    <small class="text-muted">Precio final por persona</small>
                    <p class="card-text">$471.776</p>
                    <form method="post" action="add_to_cart.php" class="quantity-form">
                        <input type="hidden" name="nombre" value="Valdivia">
                        <input type="hidden" name="precio" value="471776">
                        <div class="quantity-controls">
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, -1)">-</button>
                            <input type="text" name="cantidad" value="1" class="quantity-input" readonly>
                            <button type="button" class="quantity-button" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary ms-3">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Sección de resultados de búsqueda -->
    <section id="results-container" class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4"></div>
    </section>


    <!-- Buscador de Hoteles -->
    <h1 class="buscador-title">Buscar Hoteles</h1>
    <form class="buscador-form" action="buscar_viaje.php" method="post">
        <label class="buscador-label" for="nombreHotel">Nombre del Hotel:</label>
        <input class="buscador-input" type="text" id="nombreHotel" name="nombreHotel" required><br>

        <label class="buscador-label" for="ciudad">Ciudad:</label>
        <input class="buscador-input" type="text" id="ciudad" name="ciudad" required><br>

        <label class="buscador-label" for="pais">País:</label>
        <input class="buscador-input" type="text" id="pais" name="pais" required><br>

        <label class="buscador-label" for="fechaViaje">Fecha de Viaje:</label>
        <input class="buscador-input" type="date" id="fechaViaje" name="fechaViaje" required><br>

        <label class="buscador-label" for="duracionViaje">Duración del Viaje (días):</label>
        <input class="buscador-input" type="number" id="duracionViaje" name="duracionViaje" required><br>

        <input class="buscador-submit" type="submit" value="Buscar Viaje">
    </form>
    <!-- Buscador de Vuelos -->
    <h1 class="buscador-title">Buscar Vuelos</h1>
    <form class="buscador-form" action="buscar_vuelo.php" method="post">
        <label class="buscador-label" for="origen">Origen:</label>
        <input class="buscador-input" type="text" id="origen" name="origen" required><br>

        <label class="buscador-label" for="destino">Destino:</label>
        <input class="buscador-input" type="text" id="destino" name="destino" required><br>

        <label class="buscador-label" for="fechaSalida">Fecha de Salida:</label>
        <input class="buscador-input" type="date" id="fechaSalida" name="fechaSalida" required><br>

        <label class="buscador-label" for="numeroVuelo">Número de Vuelo (opcional):</label>
        <input class="buscador-input" type="text" id="numeroVuelo" name="numeroVuelo"><br>

        <input class="buscador-submit" type="submit" value="Buscar Vuelo">
    </form>
   
</main>

<!-- Scripts JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>
</html>
