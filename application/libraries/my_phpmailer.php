<?php 

if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_PHPMailer {
   
    public function My_PHPMailer() {
         require_once("application/core/phpmailer/PHPMailerAutoload.php");
    }

    public function send_mail($subject, $body, $destino) {

    	$mail = new PHPMailer;
       	$mail->CharSet = "UTF-8";
		$mail->IsSMTP(); 

       try {
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;  
            $mail->Port       = 587; 
            $mail->Username = 'joaovictordada2@gmail.com'; 
            $mail->Password = '000480126'; /

            $mail->SetFrom('joaovictordada2@gmail.com', 'Leilofarma'); 
            $mail->AddReplyTo('joaovictordada2@gmail.com', 'Leilofarma'); 
            $mail->Subject = $subject;

            $mail->AddAddress($destino);
            $mail->MsgHTML($body);

            $mail->Send();

        }catch (phpmailerException $e) {
            echo $e->errorMessage(); 
        }

   }
	 
}
?>