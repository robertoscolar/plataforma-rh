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

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpfCnpj = isset($_POST['cpfCnpj']) ? $_POST['cpfCnpj'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

$datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
$formattedDatetime = $datetime->format('Y-m-d H:i:s');

$arquivoEnviado = true;

if (isset($_FILES['evidencia']) && $_FILES['evidencia']['error'] == UPLOAD_ERR_OK) {
    $fileType = $_FILES['evidencia']['type'];

    if ($fileType != 'application/pdf') {
        echo "
            <script>
                Swal.fire({
                    title: 'ERRO!',
                    text: 'O formato da evidência não é suportado! Por favor, faça o envio em PDF!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../faleconosco.php';
                });
            </script>";

        return;
    }

    $fileTmpPath = $_FILES['evidencia']['tmp_name'];
    $fileData = base64_encode(file_get_contents($fileTmpPath));

    $sanitizedFileName = "Evidencia " . strtr($nome, $unwanted_array) . ".pdf";

}else {
    $fileData = null;
    $sanitizedFileName = null;
    $arquivoEnviado = false;
}

$stmt = $conn->prepare("
    INSERT INTO contato (  nomeCompleto, 
                            cpfCnpj, 
                            email, 
                            telefone, 
                            comentario, 
                            dataHoraInclusao,
                            evidencia) 
    VALUES (?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "sssssss",
    $nome,
    $cpfCnpj,
    $email,
    $telefone,
    $comentario,
    $formattedDatetime,
    $fileData
);

if ($stmt->execute()) {
    $stmt->close();

    //Substitui variaveis do template
    $body = file_get_contents('../../email/template-email_contato.html');
    $body = str_replace('{{:nome}}', $nome, $body);
    $body = str_replace('{{:cpfCnpj}}', $cpfCnpj, $body);
    $body = str_replace('{{:email}}', $email, $body);
    $body = str_replace('{{:telefone}}', $telefone, $body);
    $body = str_replace('{{:comentario}}', $comentario, $body);

    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP();

    try {
        $mail->Host = "mail.conectesites.com.br";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = "envio@conectesites.com.br";
        $mail->Password = "cia2015@@";
        $mail->AddReplyTo('senac@conectesites.com.br', 'Construtech Recrutamento');
        //$mail->AddReplyTo('roberto.bscolar@senacsp.edu.br', 'Gerencial');
        //$mail->AddReplyTo('gabriel.asantos102@senacsp.edu.br', 'Gerencial');
        //$mail->AddReplyTo('rafael.caraujo11@senacsp.edu.br', 'Gerencial');
        $mail->SetFrom('senac@conectesites.com.br', 'Construtech Recrutamento');
        $mail->AddAddress("$email", "$nome");
        $mail->Subject = "=?UTF-8?B?" . base64_encode("Fale Conosco - $nome") . "?=";
        $mail->AltBody = "Não foi possível visualizar a mensagem, por favor, tente novamente!";
        $mail->Body = $body;

        if ($arquivoEnviado) {
            $mail->addAttachment($fileTmpPath, "$sanitizedFileName");
        }
        
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
                    text: 'Formulário processado com sucesso. Cheque sua caixa de e-mail!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../index.php';
                });
            </script>";

} else {
    echo "
        <script>
            Swal.fire({
                title: 'ERRO!',
                text: 'Erro ao processar formulário. Tente novamente!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../../cadastro.php';
            });
        </script>"; 
}