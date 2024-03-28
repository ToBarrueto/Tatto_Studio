<?php

class TatuadorModel {
    // Configuración de la conexión a la base de datos (puedes ajustarla según tu configuración)
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $base_de_datos = 'tattoo_studio';
    private $conexion;

    public function __construct() {
        // Establecer la conexión a la base de datos
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_de_datos);

        // Manejo de errores de conexión
        if ($this->conexion->connect_error) {
            die('Error de conexión a la base de datos: ' . $this->conexion->connect_error);
        }
    }

    public function obtenerTatuadoresDisponibles() {
        // Consulta para obtener los tatuadores de la base de datos
        $query = "SELECT * FROM tatuadores";
        $resultado = $this->conexion->query($query);

        // Manejo de errores de consulta
        if (!$resultado) {
            die('Error al obtener los tatuadores: ' . $this->conexion->error);
        }

        // Convertir el resultado de la consulta a un array asociativo
        $tatuadores = array();
        while ($fila = $resultado->fetch_assoc()) {
            $tatuadores[] = $fila;
        }

        // Cerrar la conexión a la base de datos
        $this->conexion->close();

        return $tatuadores;
    }
}

?>