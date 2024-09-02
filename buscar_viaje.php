<?php
session_start();

include 'FiltroViaje.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreHotel = validarInput($_POST['nombreHotel']);
    $ciudad = validarInput($_POST['ciudad']);
    $pais = validarInput($_POST['pais']);
    $fechaViaje = $_POST['fechaViaje']; 
    $duracionViaje = validarNumero($_POST['duracionViaje']);

   
    $filtro = new FiltroViaje($nombreHotel, $ciudad, $pais, $fechaViaje, $duracionViaje);
    
    try {
        $resultados = $filtro->buscarHoteles();

        echo "<h2 class='busqueda-titulo'>Resultados de la Búsqueda</h2>";

        echo "<div class='resultados-container'>";
        if (count($resultados['hoteles']) > 0) {
            foreach ($resultados['hoteles'] as $hotel) {
                echo "<div class='resultado'>";
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($hotel['nombreHotel']) . "</p>";
                echo "<p><strong>Ciudad:</strong> " . htmlspecialchars($hotel['ciudad']) . "</p>";
                echo "<p><strong>País:</strong> " . htmlspecialchars($hotel['pais']) . "</p>";
                echo "<p><strong>Fecha de Viaje:</strong> " . htmlspecialchars($hotel['fechaViaje']) . "</p>";
                echo "<p><strong>Duración:</strong> {$hotel['duracion']} días</p>";
                echo "</div>";
            }

            // Guardar resultados en la sesión
            $_SESSION['search_results'] = $resultados['hoteles'];

        } else {
            echo "<p>No se encontraron hoteles.</p>";
        }
        echo "</div>";

        echo "<link rel='stylesheet' href='assets/css/style.css'>";

    } catch (Exception $e) {
        echo "<p>Ocurrió un error al buscar hoteles: " . $e->getMessage() . "</p>";
    }
} else {
    echo "No se han recibido datos del formulario.";
}

// Función para validar y limpiar input
function validarInput($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Función para validar número entero positivo
function validarNumero($dato) {
    if (filter_var($dato, FILTER_VALIDATE_INT) === false || $dato <= 0) {
        throw new Exception("La duración del viaje debe ser un número entero positivo.");
    }
    return $dato;
}
?>
