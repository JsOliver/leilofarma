<?php

class Cadastro_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }


    public function login($tp,$email,$pass,$fbid){

        $this->db->from('users');

        if($tp == 1):
            $this->db->where('email', $email);
            $this->db->where('pass', hash('whirlpool',md5(sha1($pass))));
        endif;
        if($tp == 2):
        $this->db->where('email', $email);
        $this->db->where('pass',$pass);
        endif;
        $get = $this->db->get();
        $count = $get->num_rows();
        $result = $get->result_array();
        if($count > 0):

            $_SESSION['Auth01'] = true;
            $_SESSION['NAME'] = $result[0]['firstname'].' '.$result[0]['lastname'];
            $_SESSION['EMAIL'] = $result[0]['email'];
            $_SESSION['PASS'] = $result[0]['pass'];
            $_SESSION['ID'] = $result[0]['id'];
            $_SESSION['TEL'] = $result[0]['telefone'];
            return 11;
            else:
                return 'Email ou senha incorretos, tente novamente.';

                endif;

    }

    public function cadastro($type, $email, $pass, $idfacebook, $name,$telefone,$cpf)
    {

        if ($type == 1 or $type == 2):

            $this->db->from('users');
            $this->db->where('email', $email);
            $get = $this->db->get();
            $count = $get->num_rows();
            $result = $get->result_array();

            if ($count > 0):

                return 'Conta já cadastrada.';

            else:

                if (strlen($email) < 1):

                    return 'Informe o Email';
                else:
                    if (!preg_match('/^[0-9a-z\_\.\-]+\@[0-9a-z\_\.\-]*[0-9a-z\_\-]+\.[a-z]{2,3}$/i', $email)):
                        return 'Email Inválido';
                    else:

                        if(!preg_match('/^[0-9a-z]{6,25}$/i',$pass) and $type == 1):
                            return 'Senha Inválida';
                        else:

                            if(!empty($name)):
                                $dados['firstname'] = $name;
                                $dados['email'] = $email;
                                if($type == 1):
                                $dados['pass'] = hash('whirlpool',md5(sha1($pass)));
                                else:
                                $dados['pass'] = $pass;
                                endif;
                                $dados['telefone'] = $telefone;
                                $dados['cpf'] = $cpf;
                                if($type == 2):
                                $dados['fbid'] = $idfacebook;
                                endif;
                                $dados['status'] = 1;
                                $dados['verify'] = 0;
                                $dados['type'] = 1;


                                if($this->db->insert('users',$dados)):
                                    $_SESSION['Auth01'] = true;
                                    $_SESSION['NAME'] = $name;
                                    $_SESSION['EMAIL'] = $email;
                                    if($type == 2):
                                    $_SESSION['PASS'] = $pass;

                                        else:
                                    $_SESSION['PASS'] = hash('whirlpool',md5(sha1($pass)));

                                    endif;
                                    $_SESSION['ID'] = $this->db->insert_id();
                                    $_SESSION['TEL'] = $telefone;

                                    return 11;
                                    else:
                                    return 0;
                                    endif;



                                else:
                                return 0;
                                endif;


                    endif;
                    endif;
                endif;


            endif;

        endif;

    }
}

?>