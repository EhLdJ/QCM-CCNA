<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $email = new PHPMailer(true);
    try {
        $email->isSMTP();
        $email->Host = 'smtp.yourprovider.com'; // Exemple : smtp.gmail.com
        $email->SMTPAuth = true;
        $email->Username = 'eldjityfas@gmail.com';
        $email->Password = 'uzib jlve rcsk mkxo';
        $email->SMTPSecure = 'tls';
        $email->Port = 587;

        $email->setFrom('eldjityfas@gmail.com', 'QCM App');
        $email->addAddress('destinataire@email.com');

        $email->isHTML(true);
        $email->Subject = 'Résultats du QCM';
        $email->Body = '<h2>Résultats :</h2><pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';

        $email->send();
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $email->ErrorInfo]);
    }
}
?>
