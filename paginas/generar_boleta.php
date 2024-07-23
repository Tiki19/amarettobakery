<?php
// Incluir la biblioteca tc-lib-pdf
require_once('tc-lib-pdf/src/Tcpdf.php');

use Com\Tecnick\Pdf\Tcpdf;

// Datos de ejemplo (reemplaza con tus datos reales obtenidos de la base de datos)
$venta_id = 1;
$producto_id = 'PROD001';
$precio = 50.00;
$nombre_cliente = 'Juan Pérez';
$telefono_cliente = '123456789';
$direccion_cliente = 'Av. Principal 123';

// Crear instancia de TCPDF
$pdf = new Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar información del documento
$pdf->SetCreator('Amaretto Bakery');
$pdf->SetAuthor('Amaretto Bakery');
$pdf->SetTitle('Boleta de Venta');
$pdf->SetSubject('Boleta de Venta');
$pdf->SetKeywords('Venta, Boleta, Amaretto Bakery');

// Configurar márgenes
$pdf->SetMargins(10, 10, 10);

// Agregar página
$pdf->AddPage();

// Contenido de la boleta
$html = '
<h2>Boleta de Venta</h2>
<p><strong>ID de Venta:</strong> ' . $venta_id . '</p>
<p><strong>Producto ID:</strong> ' . $producto_id . '</p>
<p><strong>Precio:</strong> $' . number_format($precio, 2) . '</p>
<p><strong>Nombre Cliente:</strong> ' . $nombre_cliente . '</p>
<p><strong>Teléfono Cliente:</strong> ' . $telefono_cliente . '</p>
<p><strong>Dirección Cliente:</strong> ' . $direccion_cliente . '</p>
';

// Escribir contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo de salida
$file_name = 'boleta_venta_' . $venta_id . '.pdf';

// Generar el PDF y guardarlo en el servidor
$pdf->Output($file_name, 'D');
?>
