<?php

// Importação biblioteca PHPMailer
require './libs/PHPMailer/Exception.php';
require './libs/PHPMailer/OAuthTokenProvider.php';
require './libs/PHPMailer/OAuth.php';
require './libs/PHPMailer/PHPMailer.php';
require './libs/PHPMailer/POP3.php';
require './libs/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mensagem
{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status = array('codigo_status' => null, 'descricao_status' => '');

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function mensagemValida()
    {
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }

        return true;
    }
}

$mensagem = new Mensagem();

$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);

if (!$mensagem->mensagemValida()) {
    header('Location: index.php');
}

// Lógica para enviar e-mail
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'a.henriquefarias96@gmail.com
';
    $mail->Password = 'bhwa vtwu gtdo zyxb';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('a.henriquefarias96@gmail.com', 'Remetente');
    $mail->addAddress($mensagem->__get('para'));

    $mail->isHTML(true);
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body = $mensagem->__get('mensagem');

    $mail->send();
    $mensagem->status['codigo_status'] = 1;
    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
} catch (Exception $e) {
    $mensagem->status['codigo_status'] = 2;
    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Send Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap');

        * {
            font-family: "Roboto", sans-serif;
            color: black;
        }

        body {
            background-image: url('./background.png');
            background-size: cover;
        }

        .container-fluid {
            background-color: rgb(0, 0, 0, 0.0);
            backdrop-filter: blur(15px);
        }

        .bg-infos {
            background-color: rgb(250, 250, 250, 0.7);

            border-radius: 6px;
            transition: 0.5s;
        }

        .btn {
            background-color: rgb(83, 158, 230, 0.9);
            color: #f3f3f3;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: rgb(83, 158, 230);
            color: white;
            transform: scale(1.03);

        }

        @media (max-width: 575px) {
            .container-fluid {
                padding: 0;
            }

            .bg-infos {
                height: 100%;
                width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid text-light vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-infos p-5 shadow-lg">
            <div class="text-center">
                <img class="d-block mx-auto mb-2" src="logo.png" alt="logo" width="72" height="72">
                <h2>Send Mail</h2>
                <p class="lead">Seu app de envio de e-mails particular!</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ($mensagem->status['codigo_status'] == 1) { ?>
                        <div class="container text-center">
                            <h1 class="display-5 mt-5 text-success">Sucesso!</h1>
                            <p><?php echo $mensagem->status['descricao_status']; ?></p>
                            <a href="index.php" class="btn btn-lg mt-4">Voltar</a>
                        </div>
                    <?php } ?>

                    <?php
                    if ($mensagem->status['codigo_status'] == 2) { ?>
                        <div class="container text-center">
                            <h1 class="display-5 mt-5 text-danger">Erro ao enviar!</h1>
                            <p><?php echo $mensagem->status['descricao_status']; ?></p>
                            <a href="index.php" class="btn btn-lg mt-4">Voltar</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>