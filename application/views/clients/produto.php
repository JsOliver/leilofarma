<?php $this->load->view('clients/fixed_files/header');


$this->db->from('produtos_disponiveis');
$this->db->where('id_pdp', $this->uri->segment(4));
$this->db->where('visible', 1);
$get = $this->db->get();
$count = $get->num_rows();
if ($count == 0):
    redirect(base_url('home'), 'refresh');
else:
    $result = $get->result_array();


    $this->db->from('medicamentos');
    $this->db->where('id', $result[0]['id_produto']);
    $getmed = $this->db->get();
    $countmd = $getmed->num_rows();
    if ($countmd == 0):

        redirect(base_url('home'), 'refresh');

    else:
        $resultmed = $getmed->result_array();

    endif;

    $this->db->from('lojas');
    $this->db->where('id_loja', $result[0]['id_loja']);
    $getlj = $this->db->get();
    if ($getlj->num_rows() == 0):

        redirect(base_url('home'), 'refresh');

    else:

        $resultlj = $getlj->result_array();
        $arrayreplace = array("(", ")", "-");

    endif;

endif;
?>


<br>
<div class="shop-product">
    <div class="container">
        <ul class="breadcrumb-v5">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
            <li>
                <a href="<?php echo base_url('loja/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($resultlj[0]['nome_loja']))).'/'.$resultlj[0]['id_loja']); ?>"><?php echo ucwords($resultlj[0]['nome_loja']); ?></a>
            </li>
            <li class="active"
                style="color: #940f14;font-weight: 600;"><?php echo ucwords(str_replace('%20', '', $resultmed[0]['nome'])); ?></li>
        </ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 md-margin-bottom-50">
                <div class="ms-showcase2-template">
                    <!-- Master Slider -->
                    <div class="master-slider ms-skin-default" id="masterslider">

                        <?php
                        $this->db->from('medicamentos');
                        $this->db->where('id', $result[0]['id_produto']);
                        $query = $this->db->get();
                        $rest = $query->result_array();
                        if (empty($rest[0]['image_1'])):


                        $this->db->from('produtos_disponiveis');
                        $this->db->where('id_pdp', $this->uri->segment(4));
                        $query = $this->db->get();
                            $resps = $query->result_array();
                        if(!empty($resps[0]['image_1'])):
                            ?>

                            <div class="ms-slide">
                                <img class="ms-brd"
                                     src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                     src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                            </div>
                            <div class="ms-slide">
                                <img class="ms-brd"
                                     src="<?php echo base_url('imagem?tp=5&&im=2&&image=' . $this->uri->segment(4) . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                     src="<?php echo base_url('imagem?tp=5&&im=2&&image=' . $this->uri->segment(4) . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                            </div>

                            <?php else:?>


                                <img style="width: 150px;top: 0;"
                                     src="<?php echo base_url('assets/'.$version.'/img/remedio.jpg')?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">



                        <?php endif; else:

                            $this->db->from('produtos_disponiveis');
                            $this->db->where('id_pdp', $this->uri->segment(4));
                            $query = $this->db->get();
                            if(!empty($query->result_array()['image_1'])):

                            ?>
                                <div class="ms-slide">
                                    <img class="ms-brd"
                                         src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>"
                                         alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                    <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                         src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>"
                                         alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                </div>
                                <div class="ms-slide">
                                    <img class="ms-brd"
                                         src="<?php echo base_url('imagem?tp=5&&im=2&&image=' . $this->uri->segment(4) . '') ?>"
                                         alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                    <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                         src="<?php echo base_url('imagem?tp=5&&im=2&&image=' . $this->uri->segment(4) . '') ?>"
                                         alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                </div>
                                <?php else:?>
                            <div class="ms-slide">
                                <img class="ms-brd"
                                     src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $result[0]['id_produto'] . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                
                            </div>
                          

                                <?php endif;?>

                            <?php

                            if(!empty($result[0]['image_3'])):

                            ?>
                            <div class="ms-slide">
                                <img class="ms-brd"
                                     src="<?php echo base_url('imagem?tp=1&&im=3&&image=' . $result[0]['id_produto'] . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                     src="<?php echo base_url('imagem?tp=1&&im=3&&image=' . $result[0]['id_produto'] . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                            </div>
                                <?php endif;?>

                        <?php

                        if(!empty($result[0]['image_4'])):

                            ?>
                            <div class="ms-slide">
                                <img class="ms-brd"
                                     src="<?php echo base_url('imagem?tp=1&&im=4&&image=' . $result[0]['id_produto'] . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                                <img class="ms-thumb" style="height: 110px;object-fit: cover; object-position: center;"
                                     src="<?php echo base_url('imagem?tp=1&&im=4&&image=' . $result[0]['id_produto'] . '') ?>"
                                     alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">
                            </div>
                        <?php endif;?>

                        <?php endif; ?>


                    </div>
                    <!-- End Master Slider -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="shop-product-heading">
                    <h2><?php echo ucwords(str_replace('%20', '', $resultmed[0]['nome'])); ?></h2><br>
                    <ul class="list-inline shop-product-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                    <br>
                    <small style="float: left;">Codigo do Produto: <b>#MD0<?php echo $resultmed[0]['id']; ?></b></small>
                    <br><br><br>
                </div><!--/end shop product social-->



                <?php echo $resultmed[0]['fixa_cal']; ?>

                <br>
                <a href="<?php echo $result[0]['link_produto'];?>" target="_blank" class="btn" style="background:#dc0000;width: 100%;color: white;border-radius: 0;padding: 3%;font-weight: 600;"><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Compar</a>
                <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                    <br>
                    <li class="wishlist-in">
                         <a data-toggle="modal" data-target="#addcard"  style="cursor:pointer;font-size: 9pt;font-weight: 600;">Adicionar ao Carrinho</a>
                    </li>

                </ul>
                <br>

                <br>
                <h6><b>Informações do Produto:</b></h6>
                <ul class="list-inline shop-product-prices margin-bottom-30">

                    <?php if (empty($result[0]['desconto'])):
                        ?>
                        <li class="shop-red">R$<?php echo number_format($result[0]['preco'], 2, ',', '.'); ?></li>

                        <?php
                    else:
                        ?>
                        <li class="shop-red">
                            R$<?php echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.'); ?>
                           </li>
                        <li class="line-through">
                            R$<?php echo number_format($result[0]['preco'], 2, ',', '.'); ?>
                           </li>


                    <?php endif; ?>
                    <?php if (!empty($result[0]['data_vencimento'])):

                        echo ' <li> <small class="shop-bg-red time-day-left">1 days left</small>
      
                    </li>';

                    else:


                        echo '<br>';
                    endif;
                    ?>


                    <li>
                        <small style="font-size: 11pt;top:0;margin-top: 0;">Em <a
                                href="<?php echo base_url('loja/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($resultlj[0]['nome_loja']))).'/'.$result[0]['id_loja']); ?>"
                                style="color: #940f14;font-weight: 600;"><?php echo ucwords($resultlj[0]['nome_loja']); ?></a>
                        </small>
                    </li>
                </ul><!--/end shop product prices-->



                <p class="wishlist-category"><strong>Categoria:</strong>

                    <?php


                    $this->db->from('categorias');
                    $this->db->where('tipo', 1);
                    $get = $this->db->get();
                    $countc = $get->num_rows();
                    if ($countc > 0):
                    $fetch = $get->result_array();
                        echo '<a href="' . base_url('busca/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($fetch[0]['nome'])))) . '">' . $fetch[0]['nome'].'</a>';

                    endif;

                    ?>
</p>


</p>
            </div>



            <div class="col-md-3">
                <div style="padding: 0 0 0 20%; text-align: center;">
                    <h4>Não Achou o preço justo?</h4>
                    <h4><b>Quer pagar Quanto?</b></h4>
                    <a data-toggle="modal" data-target="#lance" class="btn"
                       style="background:#dc0000;width: 100%;color: white;border-radius: 0;padding: 6%;font-weight: 600;"><i
                            class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>
                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <br>
                        <li class="wishlist-in">
                            <a  style="font-size: 9pt;font-weight: 600;">Produto de Responsabilidade do Vendedor</a>
                           <!-- <a  data-toggle="modal" data-target="#addcard"  style="font-size: 9pt;font-weight: 600;">Adicionar a Lista de Interesse</a>-->
                        </li>

                    </ul>


                    <!-- Modal -->
                    <div style="top: 10%;border-radius: 0; z-index: 200000;" class="modal fade" id="lance" tabindex="-1"
                         role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-radius:0px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel" style="float: left;color: black;">FAÇA SEU
                                        LANCE</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="padding: 2%">
                                        <div class="col-md-8">
                                            <h4 style="font-weight: bold;color: black; font-size: 12pt;">Você quer dar
                                                um lance para adiquirir este produto? <a style="color: #940f14;"><?php echo $result[0]['nome_prod'];?></a></h4>
                                            <hr>
                                            <h5 style="color: black;text-align: left;">Indique a quantidade desejada e o
                                                valor de sua proposta</h5>

                                            <div style="text-align: left;">
                                                <form>
                                                    <label style="width: 50%;">
                                                        <b style="font-size: 15pt;">R$</b>

                                                        <input
                                                            style="outline: none;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                                            size="9" type="text" id="moneys"
                                                            placeholder="<?php if (empty($result[0]['desconto'])):

                                                                echo number_format($result[0]['preco'], 2, ',', '.');

                                                            else:

                                                                echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                                                            endif;

                                                            ?>

" value="<?php if (empty($result[0]['desconto'])):

                                                            echo number_format($result[0]['preco'], 2, ',', '.');

                                                        else:

                                                            echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                                                        endif;

                                                        ?>">
                                                    </label>
                                                    <label style="width:35%;">
                                                        <b style="font-size: 12pt;">Qntd.</b>

                                                        <input
                                                            style="outline: none;width:70px;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                                            size="2" type="number" id="quantidade" placeholder="1" value="1">
                                                    </label>
                                                </form>

                                            </div>
                                        </div>
                                        <div class="col-md-4" style="border: 1px solid #dfdfdf;">
                                            <a>

                                                <?php
                                                $this->db->from('medicamentos');
                                                $this->db->where('id', $result[0]['id_produto']);
                                                $query = $this->db->get();
                                                $rest = $query->result_array();
                                                if (empty($rest[0]['image_1'])):


                                                    $this->db->from('produtos_disponiveis');
                                                    $this->db->where('id_pdp', $this->uri->segment(4));
                                                    $query = $this->db->get();
                                                    $resps = $query->result_array();
                                                    if(!empty($resps[0]['image_1'])):
                                                        ?>


                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>">
                                                    <?php else:?>


                                                        <img style="width: 150px;top: 0;"
                                                             src="<?php echo base_url('assets/'.$version.'/img/remedio.jpg')?>"
                                                             alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">



                                                    <?php endif; else:

                                                    $this->db->from('produtos_disponiveis');
                                                    $this->db->where('id_pdp', $this->uri->segment(4));
                                                    $query = $this->db->get();
                                                    if(!empty($query->result_array()['image_1'])):

                                                        ?>


                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>">
                                                    <?php else:?>

                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $result[0]['id_produto'] . '') ?>">
                                                    <?php endif;?>


                                                <?php endif; ?>

</a>
                                        </div>
                                        <?php if ($status == false): ?>
                                            <div class="col-md-12">

                                                <h5 style="font-weight: 600; color: black;">Preencha corretamente os
                                                    campos abaixo para que nossos especialistas entrem em contato.</h5>
                                                <div style="text-align: left;">
                                                    <br>
                                                    <label style="width: 48%;">
                                                        <b>Nome:</b>
                                                        <input id="nomenl"
                                                            style="padding: 2%;outline: none;border-radius: 5px;border: 1px solid #cccccc;"
                                                            type="text" placeholder="Seu nome">
                                                    </label>

                                                    <label style="width: 47%;">
                                                        <b>E-mail:</b>
                                                        <input id="emailnl"
                                                            style="padding: 2%;outline: none;border-radius: 5px;border: 1px solid #cccccc;"
                                                            type="text" placeholder="Seu e-mail">
                                                    </label>
                                                    <br>
                                                    <br>
                                                    <label style="width: 100%;">
                                                        <b>Telefone:</b>
                                                        <input id="dddnl"
                                                            style="padding: 1%;outline: none;border-radius: 5px;border: 1px solid #cccccc;"
                                                            type="text" placeholder="DDD" size="2">
                                                        <input id="telefonenl"
                                                            style="padding: 1%;outline: none; border-radius: 5px;border: 1px solid #cccccc;"
                                                            type="text" placeholder="" size="14">
                                                        <span id="btns">   <a href="javascript:lance('<?php echo $result[0]['id_loja'];?>' , '<?php echo '#MD0'.$resultmed[0]['id'].''; ?>' , '<?php echo $this->uri->segment(4);?>');" class="btn"
                                                           style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i
                                                                class="fa fa-gavel" aria-hidden="true"></i> DAR
                                                            LANCE</a> </span>
                                                        <br>
                                                        <h3 style="text-align: center;" id="lanceresult"></h3>
                                                    </label>


                                                </div>
                                            </div>

                                        <?php else: ?>
                                           <span id="btns"> <a href="javascript:lance('<?php echo $result[0]['id_loja'];?>' , '<?php echo '#MD0'.$resultmed[0]['id'].''; ?>' , '<?php echo $this->uri->segment(4);?>');" class="btn"
                                               style="background:#ae1b21;color: white; width:30%; float: right; margin: 10px 0 0 1%;border-radius: 5px;padding: 2.1% 0.5% 2.1% 0.5%;font-weight: 600;"><i
                                                    class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a> </span>
                                            <br>
                                            <b id="lanceresult"></b>
                                        <?php endif; ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div style="top: 10%;border-radius: 0; z-index: 200000;" class="modal fade" id="addcard" tabindex="-1"
                         role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-radius:0px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel" style="float: left;color: black;">Adicionar ao Carrinho</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="padding: 2%">
                                        <div class="col-md-8">
                                            <h4 style="font-weight: bold;color: black; font-size: 12pt;">Você quer dar
                                                um lance para adiquirir este produto? <a style="color: #940f14;"><?php echo $result[0]['nome_prod'];?></a></h4>
                                            <hr>
                                            <h5 style="color: black;text-align: left;">Indique a quantidade desejada e o
                                                valor de sua proposta</h5>


                                            <div id="div2" style="text-align: left;">
                                                <form>
                                                    <label style="width: 50%;">
                                                        <b style="font-size: 15pt;">R$</b>

                                                        <input
                                                            style="outline: none;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                                            size="9" type="text" id="moneyscard"
                                                            placeholder="<?php if (empty($result[0]['desconto'])):

                                                                echo number_format($result[0]['preco'], 2, ',', '.');

                                                            else:

                                                                echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                                                            endif;

                                                            ?>

" value="<?php if (empty($result[0]['desconto'])):

                                                            echo number_format($result[0]['preco'], 2, ',', '.');

                                                        else:

                                                            echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                                                        endif;

                                                        ?>">
                                                    </label>
                                                    <label style="width:35%;">
                                                        <b style="font-size: 12pt;">Qntd.</b>

                                                        <input
                                                            style="outline: none;width:70px;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                                            size="2" type="number" id="quantidadecard" placeholder="1" value="1">
                                                    </label>
                                                </form>
                                                <?php if(!empty($resultmed[0]['fixa_cal'])):?>

                                                    <p style="margin-top: 5px;">
                                                        <b>Detalhes:</b>  <?php echo $resultmed[0]['fixa_cal'];?>
                                                    </p>
                                                <?php endif;?>

                                                <?php if(!empty($resultmed[0]['posologia'])):?>
                                                    <p>
                                                        <b>Posologia:</b>  <?php echo $resultmed[0]['posologia'];?>
                                                    </p>
                                                <?php endif;?>
                                                <?php if(!empty($resultmed[0]['indicacoes'])):?>

                                                    <p>
                                                        <b>Indicações:</b> <?php echo $resultmed[0]['indicacoes'];?>
                                                    </p>
                                                <?php endif;?>
                                                <?php if(!empty($resultmed[0]['contra_indicacoes'])):?>

                                                    <p>
                                                        <b>Contra Indicações:</b> <?php echo $resultmed[0]['contra_indicacoes'];?>
                                                    </p>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="border: 1px solid #dfdfdf;">
                                            <a>

                                                <?php
                                                $this->db->from('medicamentos');
                                                $this->db->where('id', $result[0]['id_produto']);
                                                $query = $this->db->get();
                                                $rest = $query->result_array();
                                                if (empty($rest[0]['image_1'])):


                                                    $this->db->from('produtos_disponiveis');
                                                    $this->db->where('id_pdp', $this->uri->segment(4));
                                                    $query = $this->db->get();
                                                    $resps = $query->result_array();
                                                    if(!empty($resps[0]['image_1'])):
                                                        ?>


                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>">
                                                    <?php else:?>


                                                        <img style="width: 150px;top: 0;"
                                                             src="<?php echo base_url('assets/'.$version.'/img/remedio.jpg')?>"
                                                             alt="<?php echo  str_replace('-',' ',ucwords($this->uri->segment(3)));?>">



                                                    <?php endif; else:

                                                    $this->db->from('produtos_disponiveis');
                                                    $this->db->where('id_pdp', $this->uri->segment(4));
                                                    $query = $this->db->get();
                                                    if(!empty($query->result_array()['image_1'])):

                                                        ?>


                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=5&&im=1&&image=' . $this->uri->segment(4) . '') ?>">
                                                    <?php else:?>

                                                        <img style="width: 100%;"
                                                             src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $result[0]['id_produto'] . '') ?>">
                                                    <?php endif;?>


                                                <?php endif; ?>

                                            </a>
                                        </div>

                                           <span id="btnscr"> <a href="javascript:addcard('<?php echo $result[0]['id_loja'];?>' , '<?php echo '#MD0'.$resultmed[0]['id'].''; ?>' , '<?php echo $this->uri->segment(4);?>');" class="btn"
                                               style="background:#ae1b21;color: white; width:30%; float: right; margin: 10px 0 0 1%;border-radius: 5px;padding: 2.1% 0.5% 2.1% 0.5%;font-weight: 600;"><i
                                                    class="fa fa-card" aria-hidden="true"></i> Add ao Carrinho</a> </span>
                                            <br>
                                            <b id="lanceresult"></b>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div><!--/end shop product social-->

            </div>

            <div class="col-md-1" style="padding: 0 0 0 2%;">
                <!-- LOMADEE - BEGIN -->
                <script type="text/javascript" language="javascript">
                    lmd_source = "35752989";
                    lmd_si = "33857233";
                    lmd_pu = "22719751";
                    lmd_c = "BR";
                    lmd_wi = "120";
                    lmd_he = "600";
                </script>
                <script src="http://image.lomadee.com/js/ad_lomadee.js" type="text/javascript"
                        language="javascript"></script>
                <!-- LOMADEE - END -->
            </div>
            <div class="row margin-bottom-5">
                <div class="col-sm-12 result-category">
<!--
                    <?php if(!empty($resultmed[0]['fixa_cal'])):?>

                        <p style="margin-top: 5px;">
                        <h1>Detalhes:</h1>  <?php echo $resultmed[0]['fixa_cal'];?>
                        </p>
                    <?php endif;?>

                    <div class="collapse" id="collapseExample">
                        <div class="well">
                            <?php if(!empty($resultmed[0]['posologia'])):?>
                                <p>
                                <h1>Posologia:</h1>  <?php echo $resultmed[0]['posologia'];?>
                                </p>
                            <?php endif;?>
                            <?php if(!empty($resultmed[0]['indicacoes'])):?>

                                <p>
                                <h1>Indicações:</h1> <?php echo $resultmed[0]['indicacoes'];?>
                                </p>
                            <?php endif;?>
                            <?php if(!empty($resultmed[0]['contra_indicacoes'])):?>

                                <p>
                                <h1>Contra Indicações:</h1> <?php echo $resultmed[0]['contra_indicacoes'];?>
                                </p>
                            <?php endif;?>
                            <h2>Dados da Loja</h2><br><br><br><br>
                            <p><b>Endereço:</b> <?php echo $resultlj[0]['rua'].' - '.$resultlj[0]['estado'].' / '.$resultlj[0]['cidade'];?></p>
                            <p><b>Telefone:</b> <?php echo $resultlj[0]['telefone'];?></p>
                            <p><b>Email de Contato:</b> <?php echo $resultlj[0]['email_contato'];?></p>


                        </div>
                    </div>
                    <a style="text-align: center;" class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-arrow-down"></i> Ver Mais
                    </a>

-->



                </div>

            </div><!--/end result category-->
        </div><!--/end row-->
    </div>
</div>
<!--=== End Shop Product ===-->

<!--=== Illustration v2 ===-->
<div class="container">
    <?php

    $this->db->from('produtos_disponiveis');
    $this->db->like('keywords',$result[0]['keywords']);
    $get = $this->db->order_by('preco','asc','desconto','desc');
    $get = $this->db->limit(5,0);

    $get = $this->db->get();
    $countts = $get->num_rows();
    if($countts > 0):

        $resultsd = $get->result_array();
    ?>
    <br>
    <table class="table">
        <tr style="border-top: 10px solid white;">
            <th style="color: #969696;padding-left: 3.5%;">PRODUTO</th>
            <th style="color: #969696;padding-left: 3.5%;">FARMÁCIA</th>
            <th style="color: #969696;padding-left: 3.5%;">EM ESTOQUE</th>
            <th style="color: #969696;padding-left: 3.5%;">TELEFONE</th>
            <th style="color: #969696;padding-left: 3.5%;">VALOR</th>
        </tr>
        <?php

        foreach ($resultsd as $dds){
        ?>
        <tr>
            <td style="font-weight: bold;color: #940f14;text-align: center;"><a style="color: #940f14;"><?php echo $dds['nome_prod'];?></a></td>

            <?php

            $this->db->from('lojas');
            $this->db->where('id_loja',$dds['id_loja']);
            $get = $this->db->get();
            $countlj = $get->num_rows();
            if($countlj > 0):
                $resultlj = $get->result_array();
            ?>
            <td style="font-weight: bold;color: #940f14;text-align: center;"><a href="<?php echo base_url('loja/'.str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($resultlj[0]['nome_loja']))).'/'.$dds['id_loja']);?>" style="color: #940f14;"><?php echo $resultlj[0]['nome_loja']?></a></td>
<?php else:?>

                <td> -- --</td>
                <?php endif;?>

            <?php if($dds['unidades'] == '0'):?>
                <td style="text-align: center;"><i style="color: #ae1b21;" class="fa fa-times" aria-hidden="true"></i></td>

            <?php else:?>
                <td style="text-align: center;"><i style="color: #30944c;" class="fa fa-check" aria-hidden="true"></i></td>


                <?php endif;?>
            <?php if($countlj > 0):?>
            <td style="text-align: center;"><?php echo $resultlj[0]['telefone'];?></td>
                <?php else:?>
                <td> -- --</td>

            <?php endif;?>
            <?php if(empty($dds['desconto'])):
            ?>
                <td style="">
                    <span style="color: #727272;margin: 0 0 0 10%;" class="line-through"><span
                        style="font-weight: bold;color: #940f14;" class="shop-red">R$<?php echo number_format($dds['preco'],2,'.',',');?></span>
                </td>
                <?php else:?>

                <td style="text-align: center;">
                    <span style="color: #727272;text-decoration: line-through;" class="line-through">de R$<?php echo number_format($dds['preco'],2,'.',',');?></span> <span
                        style="font-weight: bold;color: #940f14;" class="shop-red">R$<?php echo number_format($dds['preco'] - $dds['preco'] / 100 * $dds['desconto'], 2, ',', '.');?></span> &nbsp;&nbsp;&nbsp; <span
                        style=" padding: 1% 2% 1% 2% ;color: white;font-weight: 600; background: #972227;">- <?php echo $dds['desconto'];?>% OFF</span>
                </td>
                <?php

                endif;
                ?>

        </tr>

        <?php }?>


    </table>
    <br>
    <?php endif;?>


</div>
<!--=== End Illustration v2 ===-->


<?php $this->load->view('clients/fixed_files/footer'); ?>
