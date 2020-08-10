<?php
	header("Content-Type: application/json; charset=utf-8");
	header("Access-Control-Allow-Origin: *");



	$Fnome = $_GET['nome'];
	$Fcpf = $_GET['cpf'];
	$Fcep = $_GET['cep'];
	$Ftelefone = $_GET['telefone'];
	#$Fendereco = $_GET['logradouro'];


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';

	$assunto = "Novo Lead - Chatbot";
	$mensagem = "Um novo Cadastro no chatbot<br> <b>CEP sem viabilidade</b><br><br>Nome: ".$Fnome."<br>CPF: ".$Fcpf."<br>Telefone: ".$Ftelefone."<br>CEP: ".$Fcep."<br>	";

	$eee = "bruno.vasconcellos@vipbrtelecom.com.br";
	$seu_email = $eee;
	$seu_nome = $eee;
	$sua_senha = base64_decode("UGl2NTg5OTE2MDY=");
	$host_do_email = "smtp.skymail.net.br";

	
	$mail = new PHPMailer();
	$destino = "bruno.vasconcellos@vipbrtelecom.com.br";
	

	$mail->AddAddress($destino);

	$mail->IsSMTP();
	$mail->Host = $host_do_email;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "none";
	$mail->Port = 587;
	$mail->Username = $seu_email;
	$mail->Password = $sua_senha;


	$mail->From = $seu_email;
	$mail->FromName = $seu_nome;

	$mail->IsHTML(true); 

	$mail->CharSet = 'UTF-8';

	$mail->Subject  = $assunto;
	$mail->Body = $mensagem;
	$mail->AltBody = trim(strip_tags($mensagem));
	/* Envia o email */
	$email_enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	if ($email_enviado) {
	 	echo "ok";
	}else{
	 	echo "erro";
	}
		

?>