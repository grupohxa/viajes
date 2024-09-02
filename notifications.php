<?php
function obtenerOfertasEspeciales() {
    return [
        "3 noches por el precio de 2 en hoteles seleccionados de Tokio!",
        "Paquete todo incluido a Cancún con un 30% de descuento!",
        "Hoteles seleccionados de Tokyo: 3 noches por el precio de 2!",
        "Estancia de 7 noches en París con desayuno incluido y una cena gratis!",
        "Reserva anticipada en Nueva York con un 20% de descuento en hoteles 5 estrellas!",
        "Fin de semana romántico en Venecia con una noche gratis y paseo en góndola!",
        "Alojamiento en Berlín con acceso gratuito al spa y descuentos en tours locales!",
        "Oferta especial en hoteles de Dubái: 4 noches por el precio de 3!"
    ];
}


//actividad 1
function mostrarNotificaciones() {
    $ofertas = obtenerOfertasEspeciales();
    $cantidadOfertas = count($ofertas);
    if ($cantidadOfertas > 0) {
        echo "<div class='notifications-container'>";
        foreach ($ofertas as $oferta) {
            echo "<div class='notification'>$oferta</div>";
        }
        echo "</div>";
        echo "<script>
                let index = 0;
                const intervalo = 5000; 
                function mostrarOfertas() {
                    const notifications = document.querySelectorAll('.notification');
                    if (notifications.length > 0) {
                        notifications.forEach((notif, i) => notif.style.display = 'none');
                        notifications[index].style.display = 'block';
                        setTimeout(() => {
                            notifications[index].style.display = 'none';
                            index = (index + 1) % notifications.length;
                            setTimeout(mostrarOfertas, intervalo);
                        }, intervalo);
                    }
                }
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(mostrarOfertas, intervalo);
                });
              </script>";
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']); 
    }
    
}
?>