<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Head');
        $this->load->model('SessionsVerify_Model');
        $this->load->helper('text');
		$this->load->database();



    }

    public function index()
    {
        $dados['metas'] = [
            "title" => "Leilomed, Medicamentos com os melhores preços",
            "description" => "Encontre os melhores preços no LeiloFarma",
            "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
        ];
        $dados['title'] = 'LeiloFarma';
        $dados['version'] = '1';
        $dados['page'] = 'home';
        $dados['status'] = $this->SessionsVerify_Model->logver();
        $this->load->view('clients/home', $dados);
    }

    public function busca()
    {


        if (!isset($_GET['q'])):
            $key = '';

        else:
            $key = $_GET['q'];

        endif;

        if (!isset($_GET['c'])):

            if (strripos($this->uri->segment(2), '?') == true):

                $explode = explode('?', $this->uri->segment(2));
                $categ = $explode[0];


            else:
                $categ = $this->uri->segment(2);


            endif;

        else:


            $categ = $_GET['c'];

        endif;

        if (!empty($categ)):


            $categ = $categ;

            $this->db->from('categorias');
            $this->db->where('tipo', 1);
            $this->db->like('nome', $categ);
            $get = $this->db->get();
            $countct = $get->num_rows();
            if ($countct > 0):
                $fetchct = $get->result_array();

                $categ = $fetchct[0]['id'];

            else:

                $categ = 777;

            endif;


        else:

            $categ = 0;
        endif;

        $this->db->from('medicamentos');
        $this->db->like('nome', $key);
        $this->db->or_like('nome', ucwords($key));
        $this->db->or_like('nome', strtoupper($key));
        $this->db->or_like('substancia', ucwords($key));
        $this->db->or_like('substancia', strtoupper($key));
        $this->db->or_like('medicamentos.nome', ucfirst($key));
        $this->db->or_like('keywords', $key);
        $this->db->or_like('keywords', str_replace(' ', '-', $key));
        $this->db->order_by('cliques', 'max');
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):
            $result = $get->result_array();
            $keywords = ',' . $result[0]['keywords'];
            $nome = $result[0]['nome'];
            $categoria = $result[0]['categorias'];
            $subcategoria = $result[0]['categorias'];

        else:


            $this->db->from('produtos_disponiveis');
            $this->db->like('keywords', $key);
            $this->db->or_like('keywords', ucwords($key));
            $this->db->or_like('keywords', strtoupper($key));
            $this->db->or_like('keywords', ucfirst($key));
            $this->db->or_like('keywords', str_replace(' ', '-', $key));
            $this->db->order_by('pesquisas_farma', 'max');
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $result = $get->result_array();

                $keywords = ',' . $result[0]['keywords'];
                $nome = $key;
                $categoria = $result[0]['categorias'];
                $subcategoria = $result[0]['categorias'];

                else:

            $keywords = '';
            $nome = $key;
            $categoria = 0;
            $subcategoria = 0;
        endif;
        endif;

        if ($categ <> 0):
            $categs = ucwords($this->uri->segment(2));
        else:

            $categs = '';

        endif;
        $dados['metas'] = [
            "title" => "Buscar " . $categs . " " . ucwords($nome) . " || LeiloFarma",
            "description" => "Ofertas de  " . $categs . " " . ucwords($nome) . " para você, na LeiloFarma",
            "keywords" => "LeiloFarma,leilão" . $keywords . "," . $categs . " "
        ];
        $dados['title'] = "Busca de " . $categs . " " . ucwords($nome) . " na LeiloFarma ";
        $dados['version'] = '1';
        $dados['page'] = 'busca';
        $dados['key'] = $key;
        $dados['categ'] = $categ;
        $dados['buscas'] = 'produtos';
        $dados['buscasn'] = $count;

        $dados['status'] = $this->SessionsVerify_Model->logver();

        if (!empty($key)):
            $dado['keyword'] = $key;
            $dado['categoria'] = $categoria;
            $dado['subcategoria'] = $subcategoria;
            if ($this->SessionsVerify_Model->logver() == true):
                $dado['id_user'] = $_SESSION['ID'];

            else:
                $dado['id_user'] = 0;

            endif;
            $dado['data_busca'] = date('YmdHis');
            $this->db->insert('buscas', $dado);

        endif;
        $this->load->view('clients/busca', $dados);

    }

    public function profile()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'profile';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/profile', $dados);
        else:

            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function meus_lances()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'meus-lances';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/meus-lances', $dados);


        else:

            redirect(base_url('entrar'), 'refresh');

        endif;
    }

    public function itens_salvos()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'itens-salvos';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/itens-salvos', $dados);

        else:
            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function farmacias_salvas()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'farmacias-salvas';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/farmacias-salvas', $dados);

        else:

            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function historico()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'historico';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/historico', $dados);

        else:
            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function configuracao()
    {

        if ($this->SessionsVerify_Model->logver() == true):


            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'configuracao';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/configuracao', $dados);


        else:

            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function minha_loja()
    {

        if ($this->SessionsVerify_Model->logver() == true):


            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['page'] = 'lojaa';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $this->load->view('clients/account/minha-loja', $dados);


        else:

            redirect(base_url('entrar'), 'refresh');

        endif;

    }

    public function carrinho()
    {

        $dados['metas'] = [
            "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
            "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
        ];
        $dados['title'] = 'LeiloFarma';
        $dados['version'] = '1';
        $dados['page'] = 'carrinho';
        $dados['status'] = $this->SessionsVerify_Model->logver();
        $this->load->view('clients/carrinho', $dados);


    }

    public function produto()
    {

        $dados['metas'] = [
            "title" => "Compre " . ucwords(str_replace('-', ' ', $this->uri->segment(3))) . " na " . ucwords(str_replace('-', ' ', $this->uri->segment(2))) . " pelo site da MedFarma",
            "description" => "Comprar " . ucwords(str_replace('-', ' ', $this->uri->segment(3))) . " na " . ucwords(str_replace('-', ' ', $this->uri->segment(2))) . " || MedFarma",
            "keywords" => "" . ucwords(str_replace('-', ' ', $this->uri->segment(2))) . "," . ucwords(str_replace('-', ' ', $this->uri->segment(4))) . ",MedFarma,medfarma,Medicamentos,leilão,leilão de medicamentos"
        ];
        $dados['title'] = "Comprar " . ucwords(str_replace('-', ' ', $this->uri->segment(3))) . " na " . ucwords(str_replace('-', ' ', $this->uri->segment(2))) . " || MedFarma";
        $dados['version'] = '1';
        $dados['status'] = $this->SessionsVerify_Model->logver();
        $dados['page'] = 'produtos';


        $this->db->from('produtos_disponiveis');
        $this->db->where('id_pdp', $this->uri->segment(4));
        $get = $this->db->get();
        $countn = $get->num_rows();
        if ($countn > 0):

            $prt = $get->result_array();

            $prts = $prt[0]['id_produto'];
            $bstfarm = $prt[0]['pesquisas_farma'];
            $iditen = $prt[0]['id_pdp'];

            $this->db->from('medicamentos');
            $this->db->where('id',$prts);
            $get = $this->db->get();
            $buscas = $get->result_array()[0]['cliques'];
            $buscan = $buscas + 1;
            $dado['cliques'] = $buscan;
            $this->db->where('id',$prts);
            $this->db->update('medicamentos',$dado);


            $mypesquise = $bstfarm + 1;
            $dadosbs['pesquisas_farma'] = $mypesquise;
            $this->db->where('id_pdp',$iditen);
            $this->db->update('produtos_disponiveis',$dadosbs);

            if($this->SessionsVerify_Model->logver() == true):
                $dvisita['id_user'] = $_SESSION['ID'];
                $dvisita['id_item'] = $this->uri->segment(4);
                $dvisita['data_visita'] = date('YmdHis');
                $this->db->insert('visitados',$dvisita);

            endif;

        endif;


        $this->load->view('clients/produto', $dados);
    }


    public function loja()
    {


        $this->db->from('lojas');
        $this->db->where('id_loja', $this->uri->segment(3));
        $get = $this->db->get();
        $countn = $get->num_rows();
        if ($countn > 0):
            $resultLj = $get->result_array();

            $nome = $resultLj[0]['nome_loja'];
            $descricao_loja = strip_tags($resultLj[0]['descricao_loja']);

        endif;

        $dados['metas'] = [
            "title" => $nome.'|| MedFarma',
            "description" => $descricao_loja,
            "keywords" => "" . ucwords(str_replace('-', ' ', $this->uri->segment(2))) . "," . ucwords(str_replace('-', ' ', $this->uri->segment(4))) . ",MedFarma,medfarma,Medicamentos,leilão,leilão de medicamentos"
        ];
        $dados['title'] = $nome.' || MedFarma';
        $dados['version'] = '1';
        $dados['status'] = $this->SessionsVerify_Model->logver();
        $dados['page'] = 'loja';


        $this->load->view('clients/loja', $dados);
    }

    public function logcad()
    {
        if ($this->SessionsVerify_Model->logver() == false):

            $dados['metas'] = [
                "title" => "Leilomed, Medicamentos com os melhores preços",
                "description" => "Encontre os melhores preços no LeiloFarma",
                "keywords" => "Medicamentos,leilão,leilão de medicamentos,google me ache"
            ];
            $dados['title'] = 'LeiloFarma';
            $dados['version'] = '1';
            $dados['status'] = $this->SessionsVerify_Model->logver();
            $dados['page'] = 'logcad';
            $this->load->view('clients/acesso/logcad', $dados);
        else:

            redirect(base_url('minha-conta'), 'refresh');
        endif;

    }


    public function logout()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            @session_destroy();
            redirect(base_url('home'), 'refresh');

        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

}
