<?php
session_start();
//header("Location: ../controllers/capturar_productos_controller.php");
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
require_once root.'controllers/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$pdf = new Dompdf();
ob_start();
include_once root.'views/ticket_view.php';
$html= ob_get_clean();

$pdf-> loadHtml($html);
$pdf -> setPaper("A4", "landscape");
$pdf -> render();
$pdf ->stream();

unset($_SESSION['carrito']);

// header("Location: ../views/venta_finalizada_view.php"); 
// require_once root.'views/venta_finalizada_view.php';

// require_once root.'/controllers/fpdf/fpdf.php';

// $pdf = new FPDF();
// $pdf -> AddPage();
// $pdf -> SetFont('Arial', '', 12);
// $pdf -> Cell(30, 5, 'hola mundo');
// $pdf -> Output();
