<?php
// Incluir la librería TCPDF a través de Composer
require_once '../vendor/autoload.php';

// Función para generar el informe en PDF
function generarInformePDF($mes, $año)
{
    // Conexión a la base de datos
    include '../conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Construir la consulta SQL para obtener los datos de las citas para el mes y año especificados
    $sql = "SELECT 
                t.nombre AS nombre_tatuador,
    COUNT(*) AS cantidad_tatuajes,
    SUM(c.comision) AS total_comision,
    SUM(c.cotizacion) AS total_ganado
FROM citas c
INNER JOIN tatuadores t ON c.usuario_id = t.usuario_id
INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
WHERE MONTH(hd.fecha) = $mes AND YEAR(hd.fecha) = $año
GROUP BY t.nombre";

    $resultado = $conexion->query($sql);

    // Inicializar el PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tattoo Studio');
    $pdf->SetTitle('Informe de Mensual de Desempeño');
    $pdf->SetSubject('Informe mensual de tatuajes');
    $pdf->SetKeywords('Tatuajes, Tattoo Studio, Informe');

    // Agregar una página
    $pdf->AddPage();

    // Configurar el estilo de fuente
    $pdf->SetFont('helvetica', '', 12);

    // Encabezado
    $html =  '   <h1 style="text-align:center;">Informe de Mensual de Desempeño -  Mes ' . $mes . ' / ' . $año . '</h1>';

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Agregar tabla de datos
        $html .= '
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Tatuador</th>
                    <th>Tatuajes Realizados</th>
                    <th>Comisión Generada</th>
                    <th>Total Ganado</th>
                </tr>
            </thead>
            <tbody>
        ';

        // Iterar sobre los resultados y agregar filas a la tabla
        while ($fila = $resultado->fetch_assoc()) {
            // Formatear los valores de comisión y total ganado a peso chileno y sin decimales
            $total_comision = number_format($fila['total_comision'], 0, ',', '.');
            $total_ganado = number_format($fila['total_ganado'], 0, ',', '.');
        
            $html .= '
                <tr>
                    <td>' . $fila['nombre_tatuador'] . '</td>
                    <td>' . $fila['cantidad_tatuajes'] . '</td>
                    <td>$' . $total_comision . '</td>
                    <td>$' . $total_ganado . '</td>
                </tr>
            ';
        }

        // Cerrar la tabla
        $html .= '
            </tbody>
        </table>
        ';
    } else {
        // Mensaje si no hay resultados
        $html .= '<p>No se encontraron resultados para el mes ' . $mes . ' / ' . $año . '</p>';
    }

    // Agregar el HTML al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Cerrar la conexión a la base de datos
    $conexion->close();

    // Salida del PDF
    $pdf->Output('Informe_tatuajes_' . $mes . '_' . $año . '.pdf', 'I');
}

// Obtener el mes y el año del parámetro GET o establecer valores predeterminados
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('n');
$año = isset($_GET['año']) ? $_GET['año'] : date('Y');

// Generar el informe en PDF
generarInformePDF($mes, $año);
?>
