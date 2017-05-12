<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContentController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Head');
        $this->load->model('SessionsVerify_Model');
        $this->load->helper('text');
		$this->load->database();
    }

    public function termos()
    {

    	$dados['metas'] = [
            "title" => "Leilomed, Medicamentos com os melhores preços",
            "description" => "Encontre os melhores preços no LeiloFarma",
            "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
        ];
        $dados['title'] = 'LeiloFarma - Termos de Uso';
        $dados['version'] = '1';
        $dados['page'] = 'termos-de-uso';
        $dados['status'] = $this->SessionsVerify_Model->logver();
        $this->load->view('clients/termos', $dados);
    }
}