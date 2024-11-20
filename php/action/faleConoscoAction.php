<?php

header("Content-Type: text/html; charset=utf-8");

require_once("../../libs/PHPMailer_5.2.0/class.phpmailer.php");
include_once("../connection.php");

echo '<p style="display: none;">pop-up</p>';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

$unwanted_array = [
    'Á'=>'A', 'À'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'á'=>'a', 'à'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
    'É'=>'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'é'=>'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e',
    'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I', 'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i',
    'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'ó'=>'o', 'ò'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o',
    'Ú'=>'U', 'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'ú'=>'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u',
    'Ñ'=>'N', 'ñ'=>'n', 'Ç'=>'C', 'ç'=>'c'
];

$fileType = $_FILES['evidencia']['type'];

//Validação do tipo de arquivo
if ($fileType != 'application/pdf') {
    echo "
        <script>
            Swal.fire({
                title: 'ERRO!',
                text: 'O formato da evidência não é suportado! Por favor, faça o envio em PDF!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../../fale_conosco.php';
            });
        </script>";

    return;
}

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

//Substitui variaveis do template
$body = file_get_contents('../../email/template-email_contato.html');
$body = str_replace('{{:nome}}', $nome, $body);
$body = str_replace('{{:cpf}}', $cpf, $body);
$body = str_replace('{{:email}}', $email, $body);
$body = str_replace('{{:telefone}}', $telefone, $body);
$body = str_replace('{{:comentario}}', $comentario, $body);

$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";
$mail->IsSMTP();

$fileTmpPath = $_FILES['evidencia']['tmp_name'];
$fileData = base64_encode(file_get_contents($fileTmpPath));
$sanitizedFileName = "Evidencia " . strtr($nome, $unwanted_array) . ".pdf";

try {
    $mail->Host = "mail.conectesites.com.br";
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Username = "envio@conectesites.com.br";
    $mail->Password = "cia2015@@";
    $mail->AddReplyTo('senac@conectesites.com.br', 'Construtech Recrutamento');
    $mail->SetFrom('senac@conectesites.com.br', 'Construtech Recrutamento');
    $mail->AddAddress("$email", "$nome");
    $mail->Subject = "=?UTF-8?B?" . base64_encode("Fale Conosco - $nome") . "?=";
    $mail->AltBody = "Não foi possível visualizar a mensagem, por favor, tente novamente!";
    $mail->Body = $body;
    $mail->addAttachment($fileTmpPath, "$sanitizedFileName");
    $mail->send();

} catch (phpmailerException $e) {
    echo $e->errorMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

echo "
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: 'Cadastro realizado com sucesso. Cheque sua caixa de e-mail!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../../index.php';
            });
        </script>";
