<?php
    header("Content-type: text/html;charset=utf-8");

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $telefone = isset($_POST["t5elefone"]) ? $_POST["telefone"] : "";
    $comentario = isset($_POST["comentario"]) ? $_POST["comentario"] : "";
     
    require_once("../library/PHPMailer_5.2.0/class.phpmailer.php");
    
    $subject = "Teste Envio";

    // Carrega o conteúdo do arquivo HTML externo
    $body = file_get_contents("../email/template-email.html");

    // Substitui variáveis no conteúdo HTML se necessário
    $body = str_replace("{{:nome:}}", $nome, $body);
    $body = str_replace("{{:email:}}", $email, $body);
    $body = str_replace("{{:telefone:}}", $telefone, $body);
    $body = str_replace("{{:comentario:}}", $comentario, $body);
     
    $mail = new PHPmailer(true);
    $mail ->CharSet = "UTF-8"; 
    $mail->IsSMTP();
    
    try{
        $mail->Host        = "mail.conectesites.com.br";
        $mail->SMTPDebug   = 0; 
        $mail->SMTPAuth    = true; 
        $mail ->SMTPSecure = "ssl";
        $mail->Port        = 465; 
        $mail->Username    = "envio@conectesites.com.br"; 
        $mail->Password    = "cia2015@@"; 
        $mail->AddReplyTo("senac@conectesites.com.br", "Envio");
        $mail->AddAddress("senac@conectesites.com.br", "Envio");
        $mail->SetFrom("senac@conectesites.com.br", "Envio");
        $mail->Subject =  $subject; 
        $mail->AltBody = "Não foi possível visualizar a mensagem, por favor, tente novamente!";
        $mail->Body = $body;
        
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }
?>