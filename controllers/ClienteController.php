<?php
// Incluir el modelo de Tatuadores
include 'models/TatuadorModel.php';

class ClienteController {
    public function mostrarTatuadores() {
        // Instanciar el modelo de Tatuadores
        $tatuadorModel = new TatuadorModel();
        
        // Obtener la lista de tatuadores disponibles desde el modelo
        $tatuadores = $tatuadorModel->obtenerTatuadoresDisponibles();

        // Incluir la vista del cliente
        include 'views/cliente/cliente_view.php';
    }

    // Otros métodos del controlador aquí...
}
?>