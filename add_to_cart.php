<?php

include 'session_config.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$nombre = $_POST['nombre'];
$precio = (float)$_POST['precio'];
$cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

$encontrado = false;

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['nombre'] === $nombre) {
        $item['cantidad'] += $cantidad;
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    $_SESSION['carrito'][] = array(
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad
    );
}

$_SESSION['mensaje'] = "Producto agregado al carrito con éxito!";

header('Location: index.php');
exit();



