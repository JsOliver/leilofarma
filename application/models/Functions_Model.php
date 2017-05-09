<?php

class Functions_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }

    public function uploadimage($nameimage,$where, $colname, $tablename, $file, $allowed, $max_size,$idps)
    {

        if (!empty($file['name'])):
            $filex = $file['tmp_name'];
            $size = $file['size'];
            $type = $file['type'];
            $name = $file['name'];

            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if (strstr($allowed, $extension)):


                if ($size > $max_size * 1000000):

                    return 'Tamanho maximo de ' . $max_size . 'MB, excedido.';

                else:

                    if($colname == 'xmlFile'):

                        $date['id_user'] =  $_SESSION['ID'];
                        $date['data_add'] =  date('YmdHis');
                        $date['xmlFile'] = file_get_contents(addslashes($filex));
                        if ($this->db->insert('xmlfiles', $date)) {
                            return $this->db->insert_id();
                        } else {
                            return 'Erro a salvar o XML, tente mais tarde.';
                        }

                    else:
                    $date[$colname] = file_get_contents(addslashes($filex));
                    $this->db->where($where, $idps);
                    if ($this->db->update($tablename, $date)) {
                        return $_SESSION['ID'];
                    } else {
                        return 'Erro a salvar a imagem, tente mais tarde.';
                    }

                endif;
                endif;


            else:

                return 'Somente as extensões ' . $allowed . ' são permitidas.';

            endif;


        else:


            return 'Por favor selecione o arquivo.';


        endif;


    }
    public function ajaxupdadopd($tipo, $idxml)
    {
        if (isset($tipo) and isset($idxml) and !empty($tipo) and !empty($idxml)):

            if ($tipo == 1):

                $this->db->from('xmlfiles');
                $this->db->where('id', $idxml);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    $result = $get->result_array();

                    $dado = simplexml_load_string($result[0]['xmlFile']);

                    foreach ($dado as $dds) {

                        if(!empty($dds->nome) or empty($dds->formula) or empty($dds->substancia) or empty($dds->categoria) or empty($dds->laboratorio) or empty($dds->fixacal) or empty($dds->preco)):

                            if(isset($dds->nome)):  $nome = $dds->nome; else:  $nome = ''; endif;
                            if(isset($dds->formula)):  $formula = $dds->formula; else:  $formula = ''; endif;
                            if(isset($dds->substancia)):  $substancia = $dds->substancia; else:  $substancia = ''; endif;
                            if(isset($dds->preco)):  $preco = $dds->preco; else:  $preco = ''; endif;
                            if(isset($dds->desconto)):  $desconto = $dds->desconto; else:  $desconto = ''; endif;
                            if(isset($dds->categoria1)):  $categoria1 = $dds->categoria1; else:  $categoria1 = ''; endif;
                            if(isset($dds->categoria2)):  $categoria2 = $dds->categoria2; else:  $categoria2 = ''; endif;
                            if(isset($dds->laboratorio)):  $laboratorio = $dds->laboratorio; else:  $laboratorio = ''; endif;
                            if(isset($dds->unidades)):  $unidades = $dds->unidades; else:  $unidades = ''; endif;
                            if(isset($dds->fixacal)):  $fixacal = $dds->fixacal; else:  $fixacal = ''; endif;
                            if(isset($dds->opcional->miligramas)):  $miligramas = $dds->opcional->miligramas; else:  $miligramas = ''; endif;
                            if(isset($dds->opcional->indicacoes)):  $indicacoes = $dds->opcional->indicacoes; else:  $indicacoes = ''; endif;
                            if(isset($dds->imagem1)):  $imagem1 = $dds->imagem1; else:  $imagem1 = ''; endif;
                            if(isset($dds->imagem2)):  $imagem2 = $dds->imagem2; else:  $imagem2 = ''; endif;
                            if(isset($dds->imagem3)):  $imagem3 = $dds->imagem3; else:  $imagem3 = ''; endif;
                            if(isset($dds->imagem4)):  $imagem4 = $dds->imagem4; else:  $imagem4 = ''; endif;
                            if(isset($dds->opcional->contraIndicacoes)):  $contra_indicacoes = $dds->opcional->contraIndicacoes; else: echo $contra_indicacoes = ''; endif;
                            if(isset($dds->opcional->posologia)):  $posologia = $dds->opcional->posologia; else:  $posologia = ''; endif;
                            if(isset($dds->opcional->CaracteristicasFarmacologicas)):  $CaracteristicasFarmacologicas = $dds->opcional->CaracteristicasFarmacologicas; else:  $CaracteristicasFarmacologicas = ''; endif;
                            if(isset($dds->opcional->armazenagem)):  $armazenagem = $dds->opcional->armazenagem; else:  $armazenagem = ''; endif;
                            echo $armazenagem;

                            $keyword = str_replace(' ', ',', $nome) . ',' . str_replace(' ', ',', $laboratorio) . ',' . str_replace(' ', ',', $formula) . ',' . str_replace(' ', ',', $substancia) . ',' . $nome . ',' . $formula . ',' . $substancia . ',' . $laboratorio;


                            if(!empty($imagem1)):
                                $date['image_1'] = file_get_contents(addslashes($imagem1));
                            endif;

                            if(!empty($imagem2)):
                                $date['image_2'] = file_get_contents(addslashes($imagem2));
                            endif;

                              if(!empty($imagem3)):
                                $date['image_3'] = file_get_contents(addslashes($imagem3));
                            endif;

                            if(!empty($imagem4)):
                                $date['image_4'] = file_get_contents(addslashes($imagem4));
                            endif;

                            $dada['keywords'] = $keyword;
                            $dada['marca'] = $laboratorio;
                            $dada['nome'] = $nome;
                            $dada['substancia'] = $substancia;
                            $dada['tipo'] = 1;
                            $dada['add_by'] = $_SESSION['ID'];
                            $dada['miligramas'] = $miligramas;
                            $dada['fixa_cal'] = $fixacal;
                            $dada['indicacoes'] = $indicacoes;
                            $dada['contra_indicacoes'] = $contra_indicacoes;
                            $dada['posologia'] = $posologia;
                            $dada['caracteristicas_farmacologicas'] = $CaracteristicasFarmacologicas;
                            $dada['armazenagem'] = $armazenagem;
                            $dada['data_add'] = date('YmdHis');
                            $dada['pesquisas'] = '0';
                            $dada['cliques'] = '0';
                            $dada['data_add'] = date('YmdHis');


                            if($this->db->insert('medicamentos',$dada)):

                                $this->db->from('users');
                                $this->db->where('id', $_SESSION['ID']);
                                $get = $this->db->get();
                                $count = $get->num_rows();
                                if($count > 0):

                                    $result = $get->result_array();

                                    $dados['keywords'] = $keyword;
                                    $dados['id_produto'] = $this->db->insert_id();
                                    $dados['nome_prod'] = $nome;
                                    $dados['cod_produto'] = '#MD0' . $this->db->insert_id();
                                    $dados['preco'] = $preco;
                                    $dados['desconto'] = $desconto;
                                    $dados['id_loja'] = $result[0]['loja'];
                                    $dados['unidades'] = $unidades;
                                    $dados['data_adicionado'] = date('YmdHis');

                                    if(!empty($imagem1)):
                                        $dados['image_1'] = file_get_contents(addslashes($imagem1));
                                    endif;

                                    if(!empty($imagem2)):
                                        $dados['image_2'] = file_get_contents(addslashes($imagem2));
                                    endif;

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
                                        if ($this->db->insert('produtos_disponiveis',$dados)):

                                            return 11;
                                        else:
                                            return 0;
                                        endif;


                                    endif;
                                else:
                                    return 0;
                                endif;

                            else:
                                return 0;

                            endif;
                        else:
                            return 0;
                        endif;


                    }

                else:

                    return '0';

                endif;
            else:

                return '0';
            endif;
        else:

            return '0';
        endif;

    }
}

?>