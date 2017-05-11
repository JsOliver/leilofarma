<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminControler extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SessionsVerify_Model');
        $this->load->model('Functions_Model');
        $this->load->library('email');
        @session_start();

    }


    public function index(){

     $dados['statusAdmin'] = $this->SessionsVerify_Model->logVerAdmin();
    $this->load->view('admin/views/home',$dados);
  

    }
}

