<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$proyecto = $_POST['proyecto'];
$contrato = $_POST['contrato'];
$mensaje = $_POST['mensaje']; //array assoc - $foto['tmp_name']; $foto['size'] - $foto['name']

if( empty(trim($nombre)) ) $nombre = 'anonimo';
if( empty(trim($telefono)) ) $telefono = '';

$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De: $nombre $telefono / $email</p>
    <h2>Mensaje</h2>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre $telefono" );
$mailer->addAddress('jose.zapata@eaf.edu.ar','Sitio web');
$mailer->Subject = "Mensaje web: $contrato";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';

$rta = $mailer->send( );

//var_dump($rta);
header("Location: gracias.html" );