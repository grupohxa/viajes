<?php
session_start();

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = validarInput($_POST['origen']);
    $destino = validarInput($_POST['destino']);
    $fechaSalida = $_POST['fechaSalida'];
    $numeroVuelo = validarInput($_POST['numeroVuelo']);

    try {
        // Verificar si el archivo JSON existe
        if (!file_exists('data/vuelos.json')) {
            throw new Exception("El archivo JSON de vuelos no existe.");
        }

        // Leer el archivo JSON de vuelos
        $vuelosJson = file_get_contents('data/vuelos.json');
        if ($vuelosJson === false) {
            throw new Exception("No se pudo abrir el archivo JSON de vuelos.");
        }

        // Decodificar el JSON
        $vuelos = json_decode($vuelosJson, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar el archivo JSON de vuelos: " . json_last_error_msg());
        }

        // Filtrar los vuelos
        $resultados = array_filter($vuelos, function($vuelo) use ($origen, $destino, $fechaSalida, $numeroVuelo) {
            return (
                ($vuelo['origen'] == $origen || empty($origen)) &&
                ($vuelo['destino'] == $destino || empty($destino)) &&
                ($vuelo['fechaSalida'] == $fechaSalida || empty($fechaSalida)) &&
                ($vuelo['numeroVuelo'] == $numeroVuelo || empty($numeroVuelo))
            );
        });

        echo "<h2 class='busqueda-titulo'>Resultados de la Búsqueda de Vuelos</h2>";

        echo "<div class='resultados-container'>";
        if (count($resultados) > 0) {
            foreach ($resultados as $vuelo) {
                echo "<div class='resultado'>";
                echo "<p><strong>Compañía Aérea:</strong> " . htmlspecialchars($vuelo['companiaAerea']) . "</p>";
                echo "<p><strong>Origen:</strong> " . htmlspecialchars($vuelo['origen']) . "</p>";
                echo "<p><strong>Destino:</strong> " . htmlspecialchars($vuelo['destino']) . "</p>";
                echo "<p><strong>Fecha de Salida:</strong> " . htmlspecialchars($vuelo['fechaSalida']) . "</p>";
                echo "<p><strong>Hora de Salida:</strong> " . htmlspecialchars($vuelo['horaSalida']) . "</p>";
                echo "<p><strong>Fecha de Llegada:</strong> " . htmlspecialchars($vuelo['fechaLlegada']) . "</p>";
                echo "<p><strong>Hora de Llegada:</strong> " . htmlspecialchars($vuelo['horaLlegada']) . "</p>";
                echo "<p><strong>Número de Vuelo:</strong> " . htmlspecialchars($vuelo['numeroVuelo']) . "</p>";
                echo "<p><strong>Duración:</strong> {$vuelo['duracion']}</p>";
                echo "</div>";
            }

            // Guardar resultados en la sesión
            $_SESSION['search_results'] = $resultados;

        } else {
            echo "<p>No se encontraron vuelos.</p>";
        }
        echo "</div>";

        echo "<link rel='stylesheet' href='assets/css/style.css'>";

    } catch (Exception $e) {
        echo "<p>Ocurrió un error al buscar vuelos: " . $e->getMessage() . "</p>";
    }

    // Botón para volver al inicio
    echo "<div class='volver-inicio'>";
    echo "<button onclick=\"window.location.href='index.php';\">Volver al Inicio</button>";
    echo "</div>";

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
?>
