<?php
include 'session_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = isset($_POST['index']) ? (int)$_POST['index'] : -1;

    if ($index >= 0 && isset($_SESSION['carrito'][$index])) {
        // Eliminar el artículo del carrito
        unset($_SESSION['carrito'][$index]);

        // Reindexar el carrito para evitar agujeros en el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

// Redirigir de vuelta a la página principal o a la página del carrito
header('Location: carro.php');
exit();
?>
