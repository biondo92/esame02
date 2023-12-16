<?php
const HOST = "smtp.gmail.com";
const PORT = 587;
const USERNAME = "micheleiacuitto92@gmail.com";
const PASS = "Aezma1992";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

$to = "";
$mex = "";
$result = "";
if (isset($_POST["email"])) {
    $to = $_POST["email"];
}

if (isset($_POST["message"])) {
    $mex = $_POST["message"];
}
if ($to == "" || $mex == "") {

    $result = "impossibile procedere campi mancanti";
}

$mail = new PHPMailer(true);
try {
    // Configure the PHPMailer instance
    $mail->isSMTP();
    $mail->Host = HOST;
    $mail->SMTPAuth = true;
    $mail->Username = USERNAME;
    $mail->Password = PASS;
    $mail->SMTPSecure = "tls";
    $mail->Port = PORT;

    // Set the sender, recipient, subject, and body of the message

    $mail->From = USERNAME;

    $mail->addAddress($to);
    $mail->Subject = "INVIO EMAIL DAL SITO AEZMA 2021";
    $mail->isHTML(false);
    $mail->Body = $mex;

    // Send the message
    $mail->send();

    $result = "Grazie per averci contattato";
} catch (Exception $e) {
    $m = $e->errorMessage();
    var_dump($m);
    die();
    $result = "Si è verificato un errore durante l'invio dell'email-$m";
}
header("location: /esercitazione 2 PHP-SCSS/index.php?result=$result");
