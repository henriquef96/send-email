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

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seuemail@gmail.com'; //e-mail de saída
    $mail->Password = '**** **** ****';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('seuemail@gmail.com');
    $mail->addAddress($mensagem->__get('para'));

    $mail->CharSet = 'UTF-8';
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
