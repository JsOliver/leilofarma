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
	    $mail->Port = 587;
        $mail->Username = "joaovictordada2@gmail.com";
        $mail->Password = "000480126";
        $mail->SetFrom('joaovictordada2@gmail.com', 'Leilofarma');
        $mail->AddReplyTo("joaovictordada2@gmail.com","Leilofarma");
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