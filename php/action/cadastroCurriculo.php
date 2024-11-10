<?php

header("Content-Type: text/html; charset=utf-8");

include_once("../../libs/PHPMailer_5.2.0/class.phpmailer.php");
include_once("../connection.php");


$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

$fileTmpPath = $_FILES['curriculo']['tmp_name'];
$fileData = base64_encode(file_get_contents($fileTmpPath));

$datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
$formattedDatetime = $datetime->format('Y-m-d H:i:s.');

$stmt = $conn->prepare("
    INSERT INTO cadastro (  nome, 
                            sobrenome, 
                            email, 
                            telefone, 
                            comentario, 
                            dataHoraInclusao,
                            curriculo) 
    VALUES (?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "sssssss",
    $nome,
    $sobrenome,
    $email,
    $telefone,
    $comentario,
    $formattedDatetime,
    $fileData
);

if ($stmt->execute()) {
    $stmt->close();
/*
    $body = file_get_contents('../../email/template-email.html');
    $body = str_replace('{{name}}', $nome, $body);

    $mail = new PHPMailer(exceptions: true);

    try {
        $mail->Host = "mail.conectesites.com.br";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->Username = "envio@conectesites.com.br";
        $mail->Password = "cia2015@@";
        $mail->SetFrom("senac@conectesites.com.br", "Envio");
        $mail->AddReplyTo("senac@conectesites.com.br", "Envio");
        $mail->AddAddress("$email", "Envio");
        $mail->Subject = "Cadastro de Currículo - $nome $sobrenome" ;
        $mail->AltBody = "Não foi possível visualizar a mensagem, por favor, tente novamente!";
        $mail->Body = $body;

    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
*/
} else {
    echo "Erro ao salvar o arquivo no banco de dados: " . $stmt->error;
}