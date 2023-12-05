<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(80, 10, 'Chedraui - Ticket de compra', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

include 'conexion.php'; // Asegúrate de que el archivo de conexión esté incluido

$consulta = "SELECT * FROM carrito";
$resultado = $conexion->query($consulta); // Usar $conexion en lugar de $mysqli

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(110, 10, $row['producto'], 1, 0, 'C');
    $pdf->Cell(20, 10, $row['precio'], 1, 0, 'C');
    $pdf->Cell(10, 10, $row['cantidad'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['total'], 1, 1, 'C'); // Cambiado a 1 para salto de línea
}

$pdf->Output();
?>
