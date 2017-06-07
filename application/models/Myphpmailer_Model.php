<?php 

if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class Myphpmailer_Model extends CI_Model  {


    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }

    public function My_PHPMailer() {
    }

    public function send_mail($subject, $body, $destino) {

        include("application/models/PHPMailer/PHPMailerAutoload.php");

        $mail = new PHPMailer;
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();

        try {
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'joaovictordada2@gmail.com';
            $mail->Password = '000480126';

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