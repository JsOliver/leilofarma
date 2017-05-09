<?php $this->load->view('clients/fixed_files/header');

?>
<br>
<div class="content-md margin-bottom-30" style="">
    <div class="container">
        <form class="shopping-cart" action="#" novalidate="novalidate">
            <div role="application" class="wizard clearfix" id="steps-uid-0">
                <div class="content clearfix">

                    <section id="steps-uid-0-p-0" role="tabpanel" aria-labelledby="steps-uid-0-h-0" class="body current"
                             aria-hidden="false">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Lance</th>
                                    <th>Qnt</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                    foreach ($_SESSION['card'] as $dds){


                                        $this->db->from('produtos_disponiveis');
                                        $this->db->where('id_pdp',$dds[0]['produto']);
                                        $get = $this->db->get();
                                        $count = $get->num_rows();

                                        if($count > 0):

                                            $results = $get->result_array();

                                ?>
                                    <tr id="<?php echo $dds[0]['produto'] ;?>">
                                        <td class="product-in-table">
                                            <img class="img-responsive" src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $dds[0]['produto'] . '') ?>" alt="">
                                            <div class="product-it-in">
                                                <h3><?php echo $results[0]['nome_prod'];?></h3>

                                            </div>
                                        </td>
                                        <td>R$ <?php echo $dds[0]['lance'];?></td>
                                        <td>

                                            <input type="number" style="10px; " size="10"  name="qty1" value="<?php echo $dds[0]['quantidade'];?>" id="qty1">

                                        </td>
                                        <td class="shop-red">R$ <?php echo number_format(str_replace('.','.',str_replace(',','.',$dds[0]['lance'])) * $dds[0]['quantidade'],2,'.',',');?></td>
                                        <td>
                                            <button onclick="removeItemCard();" type="button" class="close"><span>×</span><span
                                                    class="sr-only">Fechar</span></button>
                                        </td>
                                    </tr>

                                <?php

                                endif;


                                    }



                                ?>

                                </tbody>
                            </table>
                        </div>
                        <div style="position: absolute;right: 8%;">
                        <a  class="btn" style="background: #445094;color: white;">Atualizar Carrinho</a>
                        <a  class="btn" style="background: #940f14;color: white;">Finalizar Pedido</a>
                   </div>
                    </section>


                </div>

            </div>
        </form>
    </div><!--/end container-->
</div><?php $this->load->view('clients/fixed_files/footer'); ?>
