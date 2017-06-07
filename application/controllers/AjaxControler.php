<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxControler extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SessionsVerify_Model');
        $this->load->model('Cadastro_Model');
        $this->load->model('Functions_Model');
        $this->load->library('email');
        @session_start();

    }

    public function produtoshome()
    {

        $this->load->view('clients/ajax/produtos/home');
    }

    public function meuslances()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/account/meus-lances');
        endif;
    }

    public function farmaciassalvas()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/account/farmacias-salvas');

        endif;
    }

    public function lancesfarma()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/loja/lances');

        endif;
    }

    public function estoquefarma()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/loja/estoque');

        endif;
    }

    public function historico()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/account/historico');

        endif;
    }


    public function itenssalvos()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->load->view('clients/ajax/account/itens-salvos');

        endif;
    }

    public function adicionar()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):

                    $this->load->view('clients/ajax/loja/adicionar');

                endif;
            endif;
        endif;
    }

    public function additenscampo()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):

                    $this->load->view('clients/ajax/loja/listaProdutos');

                endif;
            endif;
        endif;
    }

    public function meusprodutos()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):

                    $this->load->view('clients/ajax/loja/prodsestoque');

                endif;
            endif;
        endif;
    }

    public function ajaxCadastro()
    {

        if ($this->SessionsVerify_Model->logver() == false):


            if (isset($_POST['nome']) and isset($_POST['emailcad']) and isset($_POST['passcad']) and isset($_POST['telefone']) and isset($_POST['cpf'])):


                if ($this->Cadastro_Model->cadastro(1, $_POST['emailcad'], $_POST['passcad'], '', $_POST['nome'], $_POST['telefone'], $_POST['cpf']) == 11):
                    echo 11;
                else:
                    echo $this->Cadastro_Model->cadastro(1, $_POST['emailcad'], $_POST['passcad'], '', $_POST['nome'], $_POST['telefone'], $_POST['cpf']);

                endif;
            endif;
        endif;

    }

    public function ajaxLogin()
    {
        if ($this->SessionsVerify_Model->logver() == false):

            if (isset($_POST['emaillog']) and isset($_POST['passlog'])):

                echo $this->Cadastro_Model->login(1, $_POST['emaillog'], $_POST['passlog'], '');

            endif;
        endif;


    }


    public function uploadimage()
    {
        $allowed = 'jpeg,jpge,jpg,png,gif';
        $upload = $this->Functions_Model->uploadimage('pp', 'id', 'profile_image', 'users', $_FILES['fileUpload'], $allowed, 3, $_SESSION['ID']);
        echo $upload;
    }

    public function uploadimageLoja()
    {
        $allowed = 'jpeg,jpge,jpg,png,gif';
        $upload = $this->Functions_Model->uploadimage('pp', 'id_dono', 'image_1', 'lojas', $_FILES['fileUploadLoja'], $allowed, 3, $_SESSION['ID']);
        echo $upload;
    }


    public function actionpedido()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();

            if ($count > 0):


                if ($_POST['action'] == 1):
                    $dado['status'] = 4;
                    $dado['resposta'] = 1;
                    $this->db->where('id', $_POST['pedido']);
                    $this->db->where('id_cliente ', $_SESSION['ID']);
                    $this->db->update('lances', $dado);
                    echo 11;

                endif;

                if ($_POST['action'] == 2):

                    $this->db->where('id', $_POST['pedido']);
                    $this->db->where('resposta <', 2);
                    $this->db->where('id_cliente ', $_SESSION['ID']);
                    $this->db->delete('lances');
                    echo 11;

                endif;

            endif;
        endif;
    }

    public function removelistaped()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();

            if ($count > 0):

                $result = $get->result_array();

                $dado['status'] = '5';
                $this->db->where('id_loja', $result[0]['loja']);
                $this->db->where('id', $_POST['pedido']);
                $this->db->update('lances', $dado);


            endif;

        endif;

    }

    public function ajaxupdadopd($tipo, $idxml, $file)
    {
        if (isset($tipo)):
            /*
                        if ($tipo == 1):

                            $this->db->from('xmlfiles');
                            $this->db->where('id', $idxml);
                            $get = $this->db->get();
                            $count = $get->num_rows();

                            if ($count > 0):

                                $result = $get->result_array();

                                $dado = simplexml_load_string($result[0]['xmlFile']);
                            else:


                                $filex = $file['tmp_name'];
                                $dado = file_get_contents(addslashes(trim($filex)));
                                $dado = simplexml_load_string($dado);

                            endif;


            */

            $filex = $file['tmp_name'];
            $dado = file_get_contents(addslashes($filex));
            $dado = simplexml_load_string($dado);


            foreach ($dado as $dds) {


                if (isset($dds->oferta_id)): $oferta_id = $dds->oferta_id;
                else: $oferta_id = ''; endif;
                if (isset($dds->oferta_descricao)): $nome = $dds->oferta_descricao;
                else: $nome = ''; endif;
                if (isset($dds->formula)): $formula = $dds->formula;
                else: $formula = ''; endif;
                if (isset($dds->substancia)): $substancia = $dds->substancia;
                else: $substancia = ''; endif;
                if (isset($dds->oferta_valor)): $preco = $dds->oferta_valor;
                else: $preco = ''; endif;
                if (isset($dds->oferta_link)): $link_produto = $dds->oferta_link;
                else: $link_produto = ''; endif;
                if (isset($dds->desconto)): $desconto = $dds->desconto;
                else: $desconto = ''; endif;
                if (isset($dds->categoria1)): $categoria1 = $dds->categoria1;
                else: $categoria1 = ''; endif;
                if (isset($dds->categoria2)): $categoria2 = $dds->categoria2;
                else: $categoria2 = ''; endif;
                if (isset($dds->oferta_fabricante)): $laboratorio = $dds->oferta_fabricante;
                else: $laboratorio = ''; endif;
                if (isset($dds->unidades)): $unidades = $dds->unidades;
                else: $unidades = ''; endif;
                if (isset($dds->oferta_principio_ativo)): $fixacal = $dds->oferta_principio_ativo;
                else: $fixacal = ''; endif;
                if (isset($dds->oferta_codigo_barra)): $codigobarra = $dds->oferta_codigo_barra;
                else: $codigobarra = ''; endif;
                if (isset($dds->opcional->miligramas)): $miligramas = $dds->opcional->miligramas;
                else: $miligramas = ''; endif;
                if (isset($dds->opcional->indicacoes)): $indicacoes = $dds->opcional->indicacoes;
                else: $indicacoes = ''; endif;
                if (isset($dds->oferta_img)): $imagem1 = $dds->oferta_img;
                else: $imagem1 = ''; endif;
                if (isset($dds->imagem2)): $imagem2 = $dds->imagem2;
                else: $imagem2 = ''; endif;
                if (isset($dds->imagem3)): $imagem3 = $dds->imagem3;
                else: $imagem3 = ''; endif;
                if (isset($dds->imagem4)): $imagem4 = $dds->imagem4;
                else: $imagem4 = ''; endif;
                if (isset($dds->opcional->contraIndicacoes)): $contra_indicacoes = $dds->opcional->contraIndicacoes;
                else: echo $contra_indicacoes = ''; endif;
                if (isset($dds->opcional->posologia)): $posologia = $dds->opcional->posologia;
                else: $posologia = ''; endif;
                if (isset($dds->opcional->CaracteristicasFarmacologicas)): $CaracteristicasFarmacologicas = $dds->opcional->CaracteristicasFarmacologicas;
                else: $CaracteristicasFarmacologicas = ''; endif;
                if (isset($dds->opcional->armazenagem)): $armazenagem = $dds->opcional->armazenagem;
                else: $armazenagem = ''; endif;
                echo $armazenagem;

                $keyword = str_replace(' ', ',', $nome) . ',' . str_replace(' ', ',', $laboratorio) . ',' . str_replace(' ', ',', $formula) . ',' . str_replace(' ', ',', $substancia) . ',' . $nome . ',' . $formula . ',' . $substancia . ',' . $laboratorio;

                echo $keyword . '<br><br>';


                if (!empty($imagem1)):
                    $date['image_1'] = @trim(file_get_contents(addslashes($imagem1)));
                endif;


                /*
                                                               if(!empty($imagem2)):
                                                                   $date['image_2'] = trim(file_get_contents(addslashes($imagem2)));
                                                               endif;

                                                               if(!empty($imagem3)):
                                                                   $date['image_3'] = trim(file_get_contents(addslashes($imagem3)));
                                                               endif;

                                                               if(!empty($imagem4)):
                                                                   $date['image_4'] = trim(file_get_contents(addslashes($imagem4)));
                                                               endif;
                */

                $this->db->from('medicamentos');
                $this->db->where('id_medicamento', $oferta_id);
                $this->db->where('add_by', $_SESSION['ID']);
                $getctm = $this->db->get();
                $countctm = $getctm->num_rows();
                if ($countctm == 0):
                    if (!empty($imagem1)):
                        $dada['image_1'] = @trim(file_get_contents(addslashes($imagem1)));
                    endif;

                    if (!empty($imagem2)):
                        $dada['image_2'] = trim(file_get_contents(addslashes($imagem2)));
                    endif;
                    $dada['keywords'] = trim($keyword);
                    $dada['marca'] = trim($laboratorio);
                    $dada['nome'] = trim($nome);
                    $dada['substancia'] = trim($substancia);
                    $dada['tipo'] = 1;
                    $dada['add_by'] = trim($_SESSION['ID']);
                    $dada['miligramas'] = trim($miligramas);
                    $dada['fixa_cal'] = trim($fixacal);
                    $dada['id_medicamento'] = trim($oferta_id);
                    $dada['indicacoes'] = trim($indicacoes);
                    $dada['contra_indicacoes'] = trim($contra_indicacoes);
                    $dada['posologia'] = trim($posologia);
                    $dada['caracteristicas_farmacologicas'] = trim($CaracteristicasFarmacologicas);
                    $dada['armazenagem'] = trim($armazenagem);
                    $dada['data_add'] = date('YmdHis');
                    $dada['pesquisas'] = '0';
                    $dada['cliques'] = '0';
                    $dada['data_add'] = date('YmdHis');


                    if ($this->db->insert('medicamentos', $dada)):
                        $insertp = $this->db->insert_id();

                        $this->db->from('users');
                        $this->db->where('id', $_SESSION['ID']);
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if ($count > 0):

                            $result = $get->result_array();

                            $dados['keywords'] = trim($keyword);
                            $dados['id_produto'] = trim($insertp);
                            $dados['nome_prod'] = trim($nome);
                            $dados['link_produto'] = trim($link_produto);
                            $dados['cod_produto'] = trim('#MD0' . $insertp);
                            $dados['preco'] = trim($preco);
                            $dados['desconto'] = trim($desconto);
                            $dados['id_loja'] = trim($result[0]['loja']);
                            $dados['visible'] = '1';
                            $dados['unidades'] = trim($unidades);
                            $dados['data_adicionado'] = date('YmdHis');

                            if (!empty($imagem1)):
                                $dados['image_1'] = @trim(file_get_contents(addslashes($imagem1)));
                            endif;

                            if (!empty($imagem2)):
                                $dados['image_2'] = trim(file_get_contents(addslashes($imagem2)));
                            endif;

                            /*if(!empty($categoria1)):
                            $this->db->from('categorias');
                            $this->db->like('nome', $categoria1);
                            $this->db->or_like('nome', $categoria2);
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            if($count > 0):

                                $result = $get->result_array();
                                $categorias = '';
                                foreach ($result as $dda) {

                                    $categorias .= $dda['id'] . ',';

                                }

                                $dados['categorias'] = $categorias;
                                                                    endif;

*/
                            if ($this->db->insert('produtos_disponiveis', $dados)):

                                echo 11;
                            else:
                                echo 11;
                            endif;


                        endif;
                    else:
                        echo 11;
                    endif;

                else:
                    echo 11;

                endif;

                sleep(3);
            }

            /*
                        else:

                            echo '11';
                        endif;
                    else:

                        echo '0';
                    endif;
            */


        endif;
    }

    public function uploadXML()
    {
        /*  $allowed = 'xml';
          $upload = $this->Functions_Model->uploadimage('xml', $_SESSION['ID'], 'xmlFile', 'xmlfiles', $_FILES['xmlFileUpload'], $allowed, 200, $_SESSION['ID']);
          if ($upload > 0):
              echo $this->ajaxupdadopd(1, $upload);
          else:
              echo 'Erro ao Enviar Dados';
          endif;*/
        echo $this->ajaxupdadopd(1, 0, $_FILES['xmlFileUpload']);

    }

    public function card()
    {


        if (isset($_SESSION['card']) and !empty($_SESSION['card'])):


            $_SESSION['card'][$_POST['produto']] = array(["produto" => $_POST['produto'], "lance" => $_POST['valor'], "quantidade" => $_POST['quantidade']]) + $_SESSION['card'];


        else:

            $_SESSION['card'][$_POST['produto']] = array(["produto" => $_POST['produto'], "lance" => $_POST['valor'], "quantidade" => $_POST['quantidade']]);


        endif;


    }

    public function lance()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('produtos_disponiveis');
            $this->db->where('id_pdp', $_POST['produto']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $unidade = $result[0]['unidades'];
                if ($unidade >= $_POST['quantidade'] or $unidade == '--' or empty($unidade)):

                    $data['id_produto'] = $_POST['produto'];
                    $data['cod_produto'] = $_POST['codigo'];
                    $data['id_cliente'] = $_SESSION['ID'];
                    $data['unidades'] = $_POST['quantidade'];
                    $data['id_loja'] = $_POST['loja'];
                    $data['data_lance'] = date('YmdHis');
                    $data['status'] = '1';
                    $data['valor'] = $_POST['valor'];
                    $this->db->insert('lances', $data);

                    $datans['id_lance'] = $this->db->insert_id();
                    $datans['nome'] = $_SESSION['NAME'];
                    $datans['email'] = $_SESSION['EMAIL'];
                    $datans['telefone'] = $_SESSION['TEL'];
                    $datans['data_lance'] = date('YmdHis');
                    $datans['ip_user'] = $_SERVER["REMOTE_ADDR"];
                    $this->db->insert('lances_users_dados', $datans);

                    /* Início envio de e-mail para as farmácias e insert lances */
                    $lojas = $this;
                    $lojas->db->from('lojas');
                    $getLojas = $lojas->$db->get();
                    $countLojas = $getLojas->num_rows();

                    if($countLojas > 0){

                        $this->load->library('My_PHPMailer');

                        $resultLojas = $get->result_array();
                        $subject = "Um cliente deu um lance em um produto";
                        $body = "O cliente " . $_SESSION['NAME'] . "deu um lance em um produto entre no site para ver"; 

                        foreach ($getLojas->result() as $row){
                            /* Insert nas outras lojas */
                            $data["id_loja"] = $row["id_loja"];
                            $this->db->insert('lances', $data);

                            send_mail($subject, $body, $row["email"]);

                        }
                    /* Fim envio de e-mail para as farmácias */

                    }

                else 
                    echo 'Quantidade em estoque limite atingida. Escolha entre 1 e ' . $unidade . ' unidades.';
                endif;


            endif;


            echo 11;

        elseif ($this->SessionsVerify_Model->logver() == false):


            if (!empty($_POST['nome']) and !empty($_POST['email']) and !empty($_POST['telefone'])):
                $this->db->from('produtos_disponiveis');
                $this->db->where('id_pdp', $_POST['produto']);
                $get = $this->db->get();
                $count = $get->num_rows();
                if ($count > 0):
                    $result = $get->result_array();
                    $unidade = $result[0]['unidades'];
                    if ($unidade >= $_POST['quantidade'] or empty($unidade)):
                        $data['id_produto'] = $_POST['produto'];
                        $data['cod_produto'] = $_POST['codigo'];
                        $data['id_cliente'] = 0;
                        $data['unidades'] = $_POST['quantidade'];
                        $data['id_loja'] = $_POST['loja'];
                        $data['data_lance'] = date('YmdHis');
                        $data['status'] = '1';
                        $data['valor'] = $_POST['valor'];
                        $this->db->insert('lances', $data);

                        $datans['id_lance'] = $this->db->insert_id();
                        $datans['nome'] = $_POST['nome'];
                        $datans['email'] = $_POST['email'];
                        $datans['telefone'] = $_POST['telefone'];
                        $datans['data_lance'] = date('YmdHis');
                        $datans['ip_user'] = $_SERVER["REMOTE_ADDR"];
                        $this->db->insert('lances_users_dados', $datans);

                    else:
                        echo 'Quantidade em estoque limite atingida. Escolha entre 1 e ' . $unidade . ' unidades.';
                    endif;


                endif;


                echo 11;


            else:

                echo 'Prencha Todas as Informações de Contato ';


            endif;


        endif;


    }

    public function ajaxdeletestore()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();

                $this->db->where('id_loja', $result[0]['loja']);
                $this->db->delete('lojas');


                $this->db->where('id_loja', $result[0]['loja']);
                $this->db->delete('produtos_disponiveis');

                $this->db->where('id_loja', $result[0]['loja']);
                $this->db->delete('produtos_disponiveis');

                $this->db->where('id_loja', $result[0]['loja']);
                $this->db->delete('lances');
                $ddsa['loja'] = '0';
                $this->db->where('id', $_SESSION['ID']);
                $this->db->update('users', $ddsa);

                echo 11;
            endif;
        endif;
    }

    public function exibir()
    {

        if ($_GET['tp'] == 1):
            $database = 'medicamentos';

        elseif ($_GET['tp'] == 2):
            $database = 'users';

        elseif ($_GET['tp'] == 4):
            $database = 'lojas';

        elseif ($_GET['tp'] == 5):
            $database = 'produtos_disponiveis';

        else:
            $database = 'medicamentos';

        endif;
        $this->db->from($database);
        if ($_GET['tp'] == 4):

            $this->db->where('id_dono', addslashes($_GET['image']));

        elseif ($_GET['tp'] == 5):

            $this->db->where('id_pdp', addslashes($_GET['image']));

        else:

            $this->db->where('id', addslashes($_GET['image']));


        endif;
        $query = $this->db->get();
        $fetch = $query->result_array();
        header("content-type: jpg");

        if ($_GET['im'] == 1):
            $imagefim = $fetch[0]['image_1'];

        elseif ($_GET['im'] == 2):
            $imagefim = $fetch[0]['image_2'];


        elseif ($_GET['im'] == 3):

            $imagefim = $fetch[0]['image_3'];

        elseif ($_GET['im'] == 4):


            $imagefim = $fetch[0]['image_4'];

        elseif ($_GET['im'] == 22):
            $imagefim = $fetch[0]['profile_image'];

        elseif ($_GET['im'] == 44):
            $imagefim = $fetch[0]['image_1'];

        else:
            $imagefim = $fetch[0]['image_1'];


        endif;
        echo $imagefim;


    }

    public function readitem()
    {
        if ($this->SessionsVerify_Model->logver() == true):


            if (isset($_POST['identidade'])):

                $this->db->from('users');
                $this->db->where('id', $_SESSION['ID']);
                $get = $this->db->get();
                $count = $get->num_rows();
                if ($count > 0):

                    $result = $get->result_array();

                    $this->db->from('lances');
                    $this->db->where('id', $_POST['identidade']);
                    $this->db->where('id_loja', $result[0]['loja']);
                    $get = $this->db->get();
                    if ($get->num_rows()):

                        $dado['status'] = 3;
                        $this->db->where('id', $_POST['identidade']);
                        if ($this->db->update('lances', $dado)):
                            echo 1;
                        else:
                            echo 0;
                        endif;

                    endif;
                else:
                    echo 0;

                endif;
            else:
                echo $_POST['identidade'];
            endif;

        endif;
    }


    public function respostaitem()
    {
        if ($this->SessionsVerify_Model->logver() == true):


            if (isset($_POST['resposta']) and isset($_POST['produto'])):

                $this->db->from('users');
                $this->db->where('id', $_SESSION['ID']);
                $get = $this->db->get();
                $count = $get->num_rows();
                if ($count > 0):

                    $result = $get->result_array();

                    $this->db->from('lances');
                    $this->db->where('id', $_POST['produto']);
                    $this->db->where('id_loja', $result[0]['loja']);
                    $get = $this->db->get();
                    if ($get->num_rows()):

                        $result1 = $get->result_array();

                        $dado['status'] = '4';
                        $dado['loja_read'] = '4';
                        if (isset($_POST['resposta'])):
                            $dado['resposta'] = $_POST['resposta'] + 1;
                        endif;
                        $this->db->from('produtos_disponiveis');
                        $this->db->where('id_produto', $_POST['produto']);
                        $this->db->where('id_loja', $result[0]['loja']);
                        $get = $this->db->get();
                        $count2 = $get->num_rows();
                        if ($count2 > 0):
                            $result2 = $get->result_array();
                            $unidades = $result1[0]['unidades'];
                            $unidadesAtuais = $result2[0]['unidades'];
                            if ($unidades - $unidadesAtuais <= 0):
                                $novounidades = 0;
                            else:

                                $novounidades = $unidades - $unidadesAtuais;

                            endif;

                        else:
                            $novounidades = 0;
                        endif;

                        $this->db->where('id', $_POST['produto']);
                        $this->db->where('resposta', 0);
                        $this->db->update('lances', $dado);
                        $dadol['unidades'] = $novounidades;
                        $this->db->where('id_produto', $_POST['produto']);
                        $this->db->where('id_loja', $result[0]['loja']);
                        $this->db->update('produtos_disponiveis', $dadol);

                        if ($_POST['resposta'] == 0):

                            $title = 'Lance Recusado Pelo Vendedor.';
                        else:

                            $title = 'Lance Aceito Pelo Vendedor.';

                        endif;
                        $dodon['title'] = $title;
                        $dodon['id_user'] = $result1[0]['id_cliente'];
                        $dodon['tpnotific'] = '3';
                        $dodon['id_loja'] = $result1[0]['id_loja'];
                        $dodon['data'] = date('YmdHis');
                        $dodon['url_notificacao'] = base_url('meus-lances?pg=notificacao');
                        $this->db->insert('notificacoes', $dodon);
                        /*
                                                //Inicia o processo de configuração para o envio do email
                                                $config['protocol'] = 'mail'; // define o protocolo utilizado
                                                $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
                                                $config['validate'] = TRUE; // define se haverá validação dos endereços de email
                        */

                        echo 11;


                    endif;
                else:
                    echo 0;

                endif;
            else:
                echo 0;
            endif;
        else:
            echo 0;

        endif;
    }

    public function cogs()
    {
        if ($this->SessionsVerify_Model->logver() == true):


            if ($_SESSION['PASS'] == 'fbonly'):


                if (!empty($_POST['email']) and !empty($_POST['nsenha']) and !empty($_POST['rnsenha'])):

                    if ($_SESSION['EMAIL'] == $_POST['email']):

                        if ($_SESSION['PASS'] == 'fbonly'):

                            if ($_POST['nsenha'] == $_POST['rnsenha']):

                                $dado['pass'] = hash('whirlpool', md5(sha1($_POST['nsenha'])));
                                $_SESSION['PASS'] = hash('whirlpool', md5(sha1($_POST['nsenha'])));
                                $this->db->where('id', $_SESSION['ID']);
                                if ($this->db->update('users', $dado)):

                                    echo '<b class="text-success">Dados Alterados com Sucesso.</b>';


                                else:

                                    echo '<b class="text-danger">Erro ao Alterar Senhas.</b>';

                                endif;

                            else:

                                echo '<b class="text-info">As Senhas não Coincidem.</b>';

                            endif;


                        else:
                            echo '<b class="text-warning">Email atual Incorreta.</b>';


                        endif;


                    else:
                        echo '<b class="text-warning">Email incorreto.</b>';


                    endif;

                else:
                    echo 'Nenhum Campo Pode Ficar em Branco';
                endif;


            else:
                if (!empty($_POST['email']) and !empty($_POST['senha']) and !empty($_POST['nsenha']) and !empty($_POST['rnsenha'])):

                    if ($_SESSION['EMAIL'] == $_POST['email']):

                        if (hash('whirlpool', md5(sha1($_POST['senha']))) == $_SESSION['PASS']):

                            if ($_POST['nsenha'] == $_POST['rnsenha']):

                                $dado['pass'] = hash('whirlpool', md5(sha1($_POST['nsenha'])));
                                $_SESSION['PASS'] = hash('whirlpool', md5(sha1($_POST['nsenha'])));
                                $this->db->where('id', $_SESSION['ID']);
                                if ($this->db->update('users', $dado)):

                                    echo '<b class="text-success">Dados Alterados com Sucesso.</b>';


                                else:

                                    echo '<b class="text-danger">Erro ao Alterar Senhas.</b>';

                                endif;

                            else:

                                echo '<b class="text-info">As Senhas não Coincidem.</b>';

                            endif;


                        else:
                            echo '<b class="text-warning">Email atual Incorreta.</b>';


                        endif;


                    else:
                        echo '<b class="text-warning">Email incorreto.</b>';


                    endif;

                else:
                    echo 'Nenhum Campo Pode Ficar em Branco';
                endif;
            endif;


        endif;
    }

    public function alts()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            if (isset($_POST['type']) and isset($_POST['valor'])):

                $valor = $_POST['valor'];

                if ($_POST['type'] == 0):
                    $dado['firstname'] = $valor;
                    $this->db->where('id', $_SESSION['ID']);
                    if ($this->db->update('users', $dado)):
                        echo 1;
                    else:
                        echo 2;

                    endif;


                elseif ($_POST['type'] == 1):

                    $dado['email_contato'] = $valor;
                    $this->db->where('id', $_SESSION['ID']);
                    if ($this->db->update('users', $dado)):
                        echo 1;
                    else:
                        echo 2;

                    endif;

                elseif ($_POST['type'] == 2):

                    $dado['telefone'] = $valor;
                    $this->db->where('id', $_SESSION['ID']);
                    if ($this->db->update('users', $dado)):
                        echo 1;
                    else:
                        echo 2;

                    endif;

                elseif ($_POST['type'] == 3):

                    $dado['endereco'] = $valor;
                    $this->db->where('id', $_SESSION['ID']);
                    if ($this->db->update('users', $dado)):
                        echo 1;
                    else:
                        echo 2;

                    endif;
                else:

                endif;

            endif;

        endif;
    }

    public function maps()
    {


        if ($this->SessionsVerify_Model->logver() == true):

            if (!empty($_POST['country']) and !empty($_POST['state']) and !empty($_POST['city']) and !empty($_POST['address']) and !empty($_POST['latitude']) and !empty($_POST['longitude'])):

                $dado['pais'] = $_POST['country'];
                $dado['estado'] = $_POST['state'];
                $dado['cidade'] = $_POST['city'];
                $dado['address'] = $_POST['address'];
                $dado['lat'] = $_POST['latitude'];
                $dado['long'] = $_POST['longitude'];
                $this->db->where('id', $_SESSION['ID']);
                $this->db->update('users', $dado);

            endif;

        else:

        endif;
    }

    public function addfarma()
    {


        if ($this->SessionsVerify_Model->logver() == true):

            if (empty($_POST['pais']) or empty($_POST['estado']) or empty($_POST['cidade']) or empty($_POST['endereco']) or empty($_POST['emailcn']) or empty($_POST['telefone']) or empty($_POST['nome']) or empty($_POST['cep'])):


                echo 'Nenhum Campo Pode Ficar Vazio.';

            else:

                $this->db->from('lojas');
                $this->db->where('nome_loja', $_POST['nome']);
                $this->db->where('estado', $_POST['estado']);
                $this->db->where('cidade', $_POST['cidade']);
                $this->db->where('cep', $_POST['cep']);
                $query = $this->db->get();
                $count = $query->num_rows();
                if ($count > 0):
                    $fetch = $query->result_array();

                    echo 'Já Existe uma Farmacia com o nome <a target="_blank" href="' . base_url('loja/' . str_replace(' ', '-', strtolower($fetch[0]['nome_loja'])) . '/' . $fetch[0]['id_loja']) . '" style="color:#a10f2b; font-weight: bold;">' . $fetch[0]['nome_loja'] . '</a> cadastrada na sua região.';

                else:

                    $dado['pais'] = $_POST['pais'];
                    $dado['estado'] = $_POST['estado'];
                    $dado['cidade'] = $_POST['cidade'];
                    $dado['rua'] = $_POST['endereco'];
                    $dado['id_dono'] = $_SESSION['ID'];
                    $dado['email_contato'] = $_POST['emailcn'];
                    $dado['email'] = $_SESSION['EMAIL'];
                    $dado['telefone'] = $_POST['telefone'];
                    $dado['data_add'] = date('YmdHis');
                    $dado['nome_loja'] = $_POST['nome'];
                    $dado['pais_uf'] = 'BR';
                    $dado['pais'] = $_POST['pais'];
                    $dado['cep'] = $_POST['cep'];
                    if ($this->db->insert('lojas', $dado)):
                        $dados['loja'] = $this->db->insert_id();
                        $this->db->where('id', $_SESSION['ID']);
                        if ($this->db->update('users', $dados)):

                            $data['title'] = 'Você Adicionou a ' . $_POST['nome'] . ' no LeiloMed. ';
                            $data['id_user'] = $_SESSION['ID'];
                            $data['tpnotific'] = '2';
                            $data['id_loja'] = $this->db->insert_id();
                            $data['data'] = date('YmdHis');
                            $data['url_notificacao'] = base_url('minha-loja?pg=notificacao');
                            $this->db->insert('notificacoes', $data);


                            $datact['nome'] = $_POST['nome'];
                            $datact['titulo'] = 'Catálogo ' . $_POST['nome'];
                            $datact['tipo'] = 2;
                            $datact['data_add'] = date('YmdHis');
                            $datact['data_add'] = date('YmdHis');
                            $datact['add_by'] = $_SESSION['ID'];
                            $this->db->insert('categorias', $datact);

                            echo 11;

                        else:

                            echo 'Erro Ao Salvar os Dados, Tente Mais Tarde.';

                        endif;

                    else:
                        echo 'Erro Ao Salvar os Dados, Tente Mais Tarde.';

                    endif;


                endif;


            endif;
        endif;

    }

    public function adicionaritemlj()
    {
        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):


                endif;
            endif;
        endif;
    }

    public function alteritem()
    {

        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):


                    if (isset($_POST['nome']) and isset($_POST['keywords']) and isset($_POST['preco']) and isset($_POST['desconto']) and isset($_POST['unidade']) and isset($_POST['produtoid'])):

                        if (!empty($_POST['nome']) and !empty($_POST['keywords']) and !empty($_POST['preco']) and !empty($_POST['produtoid'])):


                            $dados['nome_prod'] = $_POST['nome'];
                            $dados['keywords'] = $_POST['keywords'];
                            $dados['preco'] = str_replace(',', '.', $_POST['preco']);
                            $dados['desconto'] = $_POST['desconto'];
                            $dados['unidades'] = $_POST['unidade'];
                            $dados['categorias'] = $_POST['categoria'];
                            $this->db->where('id_pdp', $_POST['produtoid']);
                            $this->db->where('id_loja', $loja);
                            if ($this->db->update('produtos_disponiveis', $dados)):

                                echo 11;

                            else:

                                echo 'Você não tem Permissão para Alterar os Dados Dessa Loja.';

                            endif;


                        else:

                            echo 'Nenhum Campo Pode Ficar Vazio.';

                        endif;

                    else:
                        echo 'Erro ao Receber Dados.';

                    endif;


                endif;
            endif;
        endif;

    }

    public function removeitem()
    {


        if ($this->SessionsVerify_Model->logver() == true):

            $this->db->from('users');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $loja = $result[0]['loja'];
                if (!empty($loja) and $loja > 0):

                    if (isset($_POST['item']) and !empty($_POST['item'])):


                        $this->db->where('id_pdp', $_POST['item']);
                        if ($this->db->delete('produtos_disponiveis')):

                            echo 11;

                        else:

                            echo 0;

                        endif;


                    endif;


                endif;
            endif;
        endif;

    }


    public function facebookloginapi()
    {


        require_once 'application/core/api/facebook/Facebook/autoload.php';

        $fb = new Facebook\Facebook([
            'app_id' => '1870186193247282',
            'app_secret' => '57f8277f7c2f9249165c840bef55d8de',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getJavaScriptHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            echo 'No cookie set or no OAuth data could be obtained from cookie.';
            exit;
        }

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

//$_SESSION['fb_access_token'] = (string) $accessToken;


        if (isset($_POST['email'])):

            $email_acesso = $_POST['email'];

        else:

            $email_acesso = '';

        endif;
        $token = (string)$accessToken;
        $this->dadosfacebookrecupera($token, $email_acesso);

    }


    public function dadosfacebookrecupera($token, $email)
    {


        require_once 'application/core/api/facebook/Facebook/autoload.php';

//$token = $_SESSION['fb_access_token'];
        $fb = new Facebook\Facebook([
            'app_id' => '1870186193247282',
            'app_secret' => '57f8277f7c2f9249165c840bef55d8de',
            'default_graph_version' => 'v2.2',
        ]);

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,email', $token);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();


        if (!empty($email) and !isset($user['email'])):


            if (!preg_match('/^[0-9a-z\_\.\-]+\@[0-9a-z\_\.\-]*[0-9a-z\_\-]+\.[a-z]{2,3}$/i', $email)) {
                $user['email'] = '';
                echo 'Email Inválido';

            } else {
                $user['email'] = $email;

            }


        endif;

        if (isset($user['email'])):

            $this->db->select('firstname,email,pass,telefone');
            $this->db->from('users');
            $this->db->where('email', $user['email']);
            $this->db->or_where('fbid', $user['id']);
            $get = $this->db->get();
            if ($get->num_rows() > 0):
//Aqui o Email vindo do facebook já Existe então realiza Login

                if ($this->Cadastro_Model->login(2, $user['email'], $get->result_array()[0]['pass'], '') == 11):

                    echo 11;
                else:

                    echo 'Erro ao Logar com o Usuario, tente Mais Tarde';

                endif;


            else:
//Aqui o Email vindo do facebook não Existe então realiza Cadastro

                if ($this->Cadastro_Model->cadastro(2, $user['email'], 'fbonly', $user['id'], $user['name'], '', '') == 11):

                    echo 11;

                else:
                    echo 'Erro ao Cadastrar o Usuario, tente Mais Tarde';


                endif;

            endif;

        else:

            echo '0727';

        endif;

//echo 'Name: ' . $user['name'];
// OR
// echo 'Name: ' . $user->getName();

    }

    public function adminLogin()
    {

        if ($this->SessionsVerify_Model->logVerAdmin() == false):


            if (isset($_POST['user']) and isset($_POST['pass'])):


                $this->db->from('admin');
                $this->db->where('name', $_POST['user']);
                $this->db->where('pass', hash('whirlpool', md5(sha1($_POST['pass']))));
                $get = $this->db->get();

                if ($get->num_rows() > 0):

                    $result = $get->result_array();

                    $_SESSION['NAME_ADMIN'] = $_POST['user'];
                    $_SESSION['PASS_ADMIN'] = hash('whirlpool', md5(sha1($_POST['pass'])));
                    $_SESSION['ID_ADMIN'] = $result[0]['id_admin'];
                    $_SESSION['Auth02'] = 'true';

                    echo 11;

                else:

                    echo 'Usuario ou senha incorretos.';

                endif;
            else:
                echo 'Dados de Entrada não recebidos';
            endif;
        endif;
    }

    public function adminLogout()
    {
        if ($this->SessionsVerify_Model->logVerAdmin() == true):

            @session_destroy();
            echo 11;
        endif;
    }

    public function requestadm()
    {
        if ($this->SessionsVerify_Model->logVerAdmin() == true):


            if (!isset($_POST['atual_pg'])):
                $_POST['atual'] = 0;
            endif;

            if ($_POST['method'] == 1):

                $this->load->view('admin/views/actions/tables', $_POST);
            endif;

            if ($_POST['method'] == 2):
                $this->load->view('admin/views/actions/details', $_POST);
            endif;

        endif;
    }

    public function deleteadmitem()
    {

        if ($this->SessionsVerify_Model->logVerAdmin() == true):

            //Deletar usuarios
            if ($_POST['bancodedados'] == 'users'):
                $this->db->where('id', $_POST['id']);
            endif;

            //Deletar lojas
            if ($_POST['bancodedados'] == 'lojas'):
                $this->db->where('id_loja', $_POST['id']);
            endif;

            //Deletar medicamentos
            if ($_POST['bancodedados'] == 'medicamentos'):
                $this->db->where('id', $_POST['id']);
            endif;

            //Deletar produtos disponiveis
            if ($_POST['bancodedados'] == 'produtos_disponiveis'):
                $this->db->where('id_produto', $_POST['id']);
            endif;

            if ($this->db->delete($_POST['bancodedados'])):

                echo 11;

            else:
                echo 'Erro ao deletar dados, tente mais tarde.';

            endif;


        endif;

    }

    public function editleilao()
    {
        if ($this->SessionsVerify_Model->logVerAdmin() == true):
            if (isset($_POST)):

                if($_POST['tpdatabase'] == 'users'):
                    $this->db->where('id',$_POST['wherecond']);
                endif;

                if($_POST['tpdatabase'] == 'medicamentos'):
                    $this->db->where('id',$_POST['wherecond']);
                endif;


                if($_POST['tpdatabase'] == 'lojas'):
                    $this->db->where('id_loja',$_POST['wherecond']);
                endif;

                if($_POST['tpdatabase'] == 'produtos_disponiveis'):
                    $this->db->where('id_pdp',$_POST['wherecond']);
                endif;

                $database = $_POST['wherecond'];
                unset($_POST['wherecond']);
                unset($_POST['tpdatabase']);
                if($this->db->update($database,$_POST)):

                    echo 11;

                else:

                    echo 'Erro ao alterar dados, tente novamente.';

                endif;

            endif;
        endif;
    }
}