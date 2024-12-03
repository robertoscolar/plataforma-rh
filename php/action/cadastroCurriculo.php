<?php

header("Content-Type: text/html; charset=utf-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../libs/PHPMailer/src/Exception.php';
require '../../libs/PHPMailer/src/PHPMailer.php';
require '../../libs/PHPMailer/src/SMTP.php';

include_once("../connection.php");
include_once("../sweetAlert.php");
include_once("../utils.php");

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

$fileType = $_FILES['curriculo']['type'];

//Validação do tipo de arquivo
if ($fileType != 'application/pdf') {
    chamaSweetAlert(false, 'O formato do currículo não é suportado. Por favor, faça o envio em PDF!', 'cadastro.php');
    exit;
}

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

$fileTmpPath = $_FILES['curriculo']['tmp_name'];
$fileData = base64_encode(file_get_contents($fileTmpPath));

$datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
$formattedDatetime = $datetime->format('Y-m-d H:i:s');

$resultadoCount = validaRequisicao($conn, "cadastro", 
        "cpf", $cpf, 
        "email", $email);

if ($resultadoCount > 0) {
    chamaSweetAlert(false, "O E-mail e CPF já estão cadastrados no banco de dados!", "index.php");
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO cadastro (  nomeCompleto, 
                            cpf, 
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
    $cpf,
    $email,
    $telefone,
    $comentario,
    $formattedDatetime,
    $fileData
);

if ($stmt->execute()) {
    $stmt->close();

    //Substitui variaveis do template
    $body = file_get_contents('../../email/template-email_cadastro.html');
    $body = str_replace('{{:nome}}', $nome, $body);
    $body = str_replace('{{:cpf}}', $cpf, $body);
    $body = str_replace('{{:email}}', $email, $body);
    $body = str_replace('{{:telefone}}', $telefone, $body);
    $body = str_replace('{{:comentario}}', $comentario, $body);

    $mail = new PHPMailer(true);
    $mail ->CharSet = "UTF-8"; 
    $mail->IsSMTP();

    $sanitizedFileName = "Curriculo " . strtr($nome, $unwanted_array) . ".pdf";

    try {
        $mail->Host        = "mail.conectesites.com.br";
        $mail->SMTPDebug   = 0; 
        $mail->SMTPAuth    = true; 
        $mail->SMTPSecure  = 'ssl';
        $mail->Port        = 465;  
        $mail->Username    = "envio@conectesites.com.br"; 
        $mail->Password    = "cia2015@@"; 
        $mail->AddReplyTo('senac@conectesites.com.br', 'Construtech Recrutamento');
        $mail->SetFrom('senac@conectesites.com.br', 'Construtech Recrutamento');
        $mail->addAddress("$email", "$nome");
        $mail->addBcc('roberto.bscolar@senacsp.edu.br', 'Roberto Scolar');
        $mail->addBcc('gabriel.asantos102@senacsp.edu.br', 'Gabriel Santos');
        $mail->addBcc('rafael.caraujo11@senacsp.edu.br', 'Rafael Araujo'); 
        $mail->Subject = "=?UTF-8?B?".base64_encode("Cadastro de Currículo - $nome")."?=";
        $mail->AltBody = "Não foi possível visualizar a mensagem, por favor, tente novamente!";
        $mail->Body = $body;
        $mail->addAttachment($fileTmpPath, "$sanitizedFileName");
        $mail->send();
        
    } catch (Exception $e) {
        chamaSweetAlert(false, 'Erro ao enviar e-mail! Por favor, tente novamente.', 'cadastro.php');
        exit;
    }

    chamaSweetAlert(true, 'Formulário processado com sucesso. Cheque sua caixa de e-mail!', 'index.php');

} else {
    chamaSweetAlert(false, 'Erro ao realizar registro em banco de dados. Por favor, tente novamente.', 'cadastro.php');
}