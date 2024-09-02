<?php
include 'session_config.php';

// Función para mostrar el carrito
function mostrarCarrito() {
    if (empty($_SESSION['carrito'])) {
        echo "<p>El carrito está vacío.</p>";
        return;
    }
    
    $total = 0;
    
    foreach ($_SESSION['carrito'] as $index => $item) {
        $nombre = htmlspecialchars($item['nombre']);
        $precio = number_format($item['precio'], 2, '.', ',');
        $cantidad = (int)$item['cantidad'];
        $subtotal = number_format($item['precio'] * $cantidad, 2, '.', ',');
        
        echo "<p>Nombre: $nombre</p>";
        echo "<p>Precio: \$$precio</p>";
        echo "<p>Cantidad: $cantidad</p>";
        echo "<p>Subtotal: \$$subtotal</p>";
        
        //  eliminar el artículo del carrito
        echo "<form method='post' action='remove_from_cart.php'>";
        echo "<input type='hidden' name='index' value='$index'>";
        echo "<button type='submit' class='btn btn-danger'>Eliminar</button>";
        echo "</form>";
        
        echo "<hr>";
        
        $total += $item['precio'] * $cantidad;
    }
    
    echo "<p>Total: \$" . number_format($total, 2, '.', ',') . "</p>";
}
?>







