<?php

class FiltroViaje {
    private string $nombreHotel;
    private string $ciudad;
    private string $pais;
    private string $fechaViaje;
    private int $duracionViaje;

 
    public function __construct(string $nombreHotel, string $ciudad, string $pais, string $fechaViaje, int $duracionViaje) {
        // Validar los parámetros de entrada
        if (empty($nombreHotel) || empty($ciudad) || empty($pais) || empty($fechaViaje) || $duracionViaje <= 0) {
            throw new InvalidArgumentException("Todos los parámetros son obligatorios y deben ser válidos.");
        }

        $this->nombreHotel = $nombreHotel;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->fechaViaje = $fechaViaje;
        $this->duracionViaje = $duracionViaje;
    }

    public function buscarHoteles(): array {
        $hotelesJson = @file_get_contents('data/hoteles.json');

        if ($hotelesJson === false) {
            throw new Exception("¡Ups! No pudimos cargar la lista de hoteles en este momento. Por favor, inténtalo de nuevo más tarde.");
        }

        $hoteles = json_decode($hotelesJson, true);

        // Verificar si la carga de hoteles fue exitosa
        if ($hoteles === null) {
            throw new Exception("¡Vaya! Hubo un problema al procesar los datos de los hoteles. Asegúrate de que el archivo esté en el formato correcto.");
        }


        // Filtrar hoteles según los criterios especificados
        $resultadoHoteles = array_filter($hoteles, function($hotel) {
            return (stripos($hotel['nombreHotel'], $this->nombreHotel) !== false) &&
                   (strcasecmp($hotel['ciudad'], $this->ciudad) === 0) &&
                   (strcasecmp($hotel['pais'], $this->pais) === 0) &&
                   (strcasecmp($hotel['fechaViaje'], $this->fechaViaje) === 0) &&
                   ($hotel['duracion'] == $this->duracionViaje);
        });


        return [
            'hoteles' => $resultadoHoteles
        ];
    }
}

?>

