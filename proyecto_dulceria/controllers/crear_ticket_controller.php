<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
require_once root.'controllers/dompdf/autoload.inc.php';
date_default_timezone_set('America/Mexico_City');
$hora_y_fecha = date("y-m-d H:i:s");

use Dompdf\Dompdf;

$pdf = new Dompdf();
ob_start();
include_once root.'views/ticket_view.php';
$html= ob_get_clean();

$pdf -> loadHtml($html);
//$pdf -> set('title',' lo que sea ');
$pdf -> setPaper("A4", "landscape");
$pdf -> render();
$pdf ->stream('Ticket_'.$hora_y_fecha.'.pdf');

