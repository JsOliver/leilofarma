<?php 

if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_PHPMailer {
   
    public function My_PHPMailer() {
        require_once('PHPMailer/class.phpmailer.php');
    }

    public function send_mail($subject, $body, $destino) {
	    $mail = new PHPMailer();
	    $mail->IsSMTP(); 
	    $mail->SMTPAuth = true; 
	    $mail->SMTPSecure = "ssl"; 
	    $mail->Host = "smtp.gmail.com"; 
	    $mail->Port = 465; 
	    $mail->Username = "username@leilofarma.com";
	    $mail->Password = "*****"; 
	    $mail->SetFrom('email@email.com', 'Leilofarma'); 
	    $mail->AddReplyTo("response@email.com","Leilofarma"); 
	    $mail->Subject = $subject; 
	    $mail->Body = $body;
	    $mail->AltBody = $body;
	    $destino = $destino;
	    $mail->AddAddress($destino);
	 
	    if(!$mail->Send()) {
	        $data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;
	    } else {
	        $data["message"] = "Mensagem enviada com sucesso!";
	    }
	    $this->load->view('sent_mail',$data);
	}
}
?>