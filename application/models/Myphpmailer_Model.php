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

        @include("application/models/PHPMailer/class.phpmailer.php");
        @include("application/models/PHPMailer/class.smtp.php");

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

            $mail->SetFrom('contato@leilofarma.com.br', 'Leilofarma');
            $mail->AddReplyTo('contato@leilofarma.com.br', 'Leilofarma');
            $mail->Subject = $subject;

            $expl = explode('(<==>)',$destino);
            $cons = count($expl);

            for($np=0;$np<$cons;$np++):
                $mail->AddAddress($expl[$np]);
            endfor;
            $mail->MsgHTML($body);

            if($mail->Send()):
                //return 15;
            else:
                //return $destino;
            endif;

        }catch (phpmailerException $e) {
            echo $e->errorMessage();
        }

    }

}
?>
