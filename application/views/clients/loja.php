<?php $this->load->view('clients/fixed_files/header');


$this->db->from('lojas');
$this->db->where('id_loja', $this->uri->segment(3));
$getlj = $this->db->get();
if ($getlj->num_rows() == 0):

    redirect(base_url('home'), 'refresh');

else:

    $resultlj = $getlj->result_array();
    $arrayreplace = array("(", ")", "-");

    $nome = $resultlj[0]['nome_loja'];

endif;

$this->db->from('produtos_disponiveis');
$this->db->where('id_loja', $this->uri->segment(3));
$getljit = $this->db->get();
$pridcounts = $getljit->num_rows();

if ($pridcounts <= 1):
    $rst = 'Resultado';
else:
    $rst = 'Resultados';

endif;
?>

    <br>
    <br>

    <div class="content container">
        <div class="row">

            <div class="col-md-12">
                <div class="row margin-bottom-5">
                    <div class="col-sm-12 result-category">
                        <h3><?php echo ucwords($nome); ?> <small class="text-danger"><?php echo number_format($pridcounts) . ' ' . $rst; ?></small></h3>



                    </div>

                </div><!--/end result category-->


                <div class="filter-results">
                    <div class="row illustration-v2 margin-bottom-30">

                        <?php

                        $max = 15;
                        if (!isset($_GET['pg']) or isset($_GET['pg']) and $_GET['pg'] <= 1):

                           $atual = 0;

                        else:
                            $atual = ceil($max * $_GET['pg'] - $max);

                        endif;
                        $this->db->from('produtos_disponiveis');
                        $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_produto', 'inner');
                        $this->db->where('produtos_disponiveis.visible', 1);
                        $this->db->where('produtos_disponiveis.id_loja',$this->uri->segment(3));
                        $this->db->limit($max, $atual);
                        $this->db->order_by('produtos_disponiveis.id_pdp', 'desc');



                        $get = $this->db->get();

                        $counts = $get->num_rows();
                        if ($counts <= 0):

                            echo '<h1 style="text-align: center;">Nenhum item encontrado</h1>';

                        else:


                            $result = $get->result_array();
                            foreach ($result as $dds) {


                                ?>
                                <div class="col-md-4" title="<?php echo $dds['nome']; ?>">
                                    <div class="product-img product-img-brd">
                                        <a href="<?php echo base_url('produto/' . $this->uri->segment(2) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome']))) . '/' . $dds['id_pdp']); ?>"><img
                                                class="full-width img-responsive"
                                                style="height: 200px; object-fit: cover; object-position: center;"
                                                src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $dds['id'] . '') ?>"
                                                alt=""></a>

                                        <a class="add-to-cart"
                                           href="<?php echo base_url('produto/' . $this->uri->segment(2) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome']))) . '/' . $dds['id_pdp']); ?>"><i
                                                class="fa fa-shopping-cart"></i>Ver Mais</a>
                                        <!--<div class="shop-rgba-dark-green rgba-banner">New</div>-->
                                    </div>
                                    <div class="product-description product-description-brd margin-bottom-30">
                                        <div class="overflow-h margin-bottom-5">
                                            <div class="pull-left">
                                                <h4 class="title-price"><a
                                                        href="<?php echo base_url('produto/' . $this->uri->segment(2) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome']))) . '/' . $dds['id_pdp']); ?>"><?php echo ucwords(character_limiter($dds['nome'], 20)); ?></a>
                                                </h4>

                                            </div>
                                            <div class="product-price">

                                                <?php if (empty($dds['desconto'])):
                                                    ?>
                                                    <br>
                                                    <span
                                                        class="title-price">R$<?php echo number_format($dds['preco'], 2, ',', '.'); ?></span>

                                                    <?php
                                                else:
                                                    ?>
                                                    <span
                                                        class="title-price">R$<?php echo number_format($dds['preco'] - $dds['preco'] / 100 * $dds['desconto'], 2, ',', '.'); ?></span>
                                                    <span
                                                        class="title-price line-through">R$<?php echo number_format($dds['preco'], 2, ',', '.'); ?></span>

                                                <?php endif; ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <?php
                            }
                        endif;

                        ?>


                    </div>

                </div><!--/end filter resilts-->
                <div class="row margin-bottom-5">
                    <div class="col-sm-12 result-category">
                        <p><b>Endereço:</b> <?php echo $resultlj[0]['rua'].' - '.$resultlj[0]['estado'].' / '.$resultlj[0]['cidade'];?></p>
                        <p><b>Telefone:</b> <?php echo $resultlj[0]['telefone'];?></p>
                        <p><b>Email de Contato:</b> <?php echo $resultlj[0]['email_contato'];?></p>



                    </div>

                </div><!--/end result category-->

                <div class="text-center">
                    <ul class="pagination pagination-v2">

                        <?php

                        if (!isset($_GET['pg']) or isset($_GET['pg']) and $_GET['pg'] <= 1):

                            $next = 2;
                            $before = 1;

                        else:
                            $next = $_GET['pg'] + 1;
                            $before = $_GET['pg'] - 1;

                        endif;

                        ?>

                        <li><a href="?pg=<?php echo $before;?>">Anterior</a></li>
                        <li><a href="?pg=<?php echo  $next?>">Proximo</a></li>
                    </ul>
                </div><!--/end pagination-->
            </div>
        </div><!--/end row-->
    </div>

<?php $this->load->view('clients/fixed_files/footer'); ?>