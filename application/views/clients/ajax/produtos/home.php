<?php
if(!isset($_POST['pg1']) and !isset($_POST['tipo']) and !isset($_POST['keyword']) and !isset($_POST['details'])):

    $_POST['pg1'] = $pg1;
    $_POST['tipo'] = $tipo;
    $_POST['keyword'] = $keyword;
    $_POST['details'] = $details;
    $_POST['page'] = $details;

    endif;
?>
<?php if ($_POST['pg1'] == 11 and $_POST['tipo'] == 0):
    if (isset($_POST['keyword']) and !empty($_POST['keyword'])):
        echo '<h4>Exibindo resultados de <small>' . ucwords($_POST['keyword']) . '</small></h4>';

    else:
        echo '<h4>Lista de Produtos || LeiloFarma</h4>';

    endif;
else:

    $this->db->from('categorias');
    $this->db->where('id', $_POST['tipo']);
    $this->db->order_by('id', 'desc');
    $get = $this->db->get();
    $count = $get->num_rows();
    if ($count > 0 or $count < 0):

        $result = $get->result_array();
        if(isset($_POST['details']) and $_POST['details'] == 0):
            echo '<h3>Exibindo Resultados</h3>';

            else:

        echo '<h3>' . $result[0]['titulo'] . ' <small style="font-weight:bold; color:#972227;">' . ucwords($_POST['keyword']) . '</small></h3>';
endif;
    else:
        if ($_POST['tipo'] <> 777):

            echo '<h3>Recomendados para você</h3>';

        endif;
    endif;


endif;
?>
    <br>
    <br>
    <div class="row" style="padding: 0 0 0 3%; ">
        <style>

            @media screen and (max-width: 992px) {
                #compra {
                    width: 100%;
                }

            }
        </style>
        <style>
            .pager a {
                color: #940f14;
            }

            /*Add to Cart*/
            .illustration-v2 .add-to-cart {

                visibility: hidden;
                background: rgba(255, 255, 255, 0.8);
            }

            .illustration-v2 .add-to-cart:hover {
                color: #fff;
                text-decoration: none;
                background: rgba(24, 171, 155, 0.5);
                transition: background-color 0.2s ease-in-out;
            }

            .illustration-v2 .add-to-cart:hover i {
                color: #fff;
            }

            .illustration-v2 .product-img:hover .add-to-cart {
                visibility: visible;
            }

            <?php if($_POST['tipo'] == 11 or $_POST['pg1'] == 11): ?>

            @media (min-width: 991px) {
                #compra {
                    width: 40%;
                }
            }

            }

            <?php  endif;?>
        </style>
        <?php
        $this->db->from('produtos_disponiveis');
        $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_produto', 'inner');
        $this->db->where('produtos_disponiveis.visible', 1);
        if ($_POST['tipo'] <> 0):
            $this->db->like('produtos_disponiveis.categorias', $_POST['tipo']);
        endif;
        if ($_POST['pg1'] == 11):
            $this->db->like('medicamentos.nome', $_POST['keyword']);
            $this->db->or_like('produtos_disponiveis.keywords', $_POST['keyword']);
        endif;

        $this->db->order_by('produtos_disponiveis.preco', 'min');
        $get = $this->db->get();
        $count1 = $get->num_rows();

        $max = 21;
        $total = ceil($count1 / $max);
        $pagepost = $_POST['page'];
        if (isset($pagepost)):
            if ($pagepost <= 1):
                $atual = 0;
                $atualpg = 1;
            else:
                $atual = $max * $pagepost - $max;
                $atualpg = $pagepost;

            endif;
        else:
            $atual = 0;
            $atualpg = 1;

        endif;

        $this->db->from('produtos_disponiveis');
        $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_produto', 'inner');
        $this->db->where('produtos_disponiveis.visible', 1);
        if ($_POST['tipo'] <> 0):
            $this->db->like('produtos_disponiveis.categorias', $_POST['tipo']);
        endif;

        if ($_POST['pg1'] == 11 and !empty($_POST['keyword'])):

            $this->db->like('medicamentos.nome', $_POST['keyword']);
            $this->db->or_like('medicamentos.nome', ucwords($_POST['keyword']));
            $this->db->or_like('medicamentos.nome', strtoupper($_POST['keyword']));
            $this->db->or_like('medicamentos.nome', ucfirst($_POST['keyword']));
            $this->db->or_like('medicamentos.substancia', ucwords($_POST['keyword']));
            $this->db->or_like('medicamentos.substancia', strtoupper($_POST['keyword']));
            $this->db->or_like('medicamentos.substancia', strtoupper($_POST['keyword']));
            $this->db->or_like('produtos_disponiveis.keywords', $_POST['keyword']);
            $this->db->or_like('produtos_disponiveis.keywords', str_replace(' ', '-', $_POST['keyword']));
        endif;
        $this->db->limit($max, $atual);

if(isset($_POST['details']) and $_POST['details'] == 0):

    if($_POST['tipo'] == 'a1'):
        $this->db->order_by('produtos_disponiveis.id_pdp', 'desc');

        endif;

    if($_POST['tipo'] == 'a2'):
        $this->db->order_by('produtos_disponiveis.id_pdp', 'asc');

        endif;

    if($_POST['tipo'] == 'a3'):
        $this->db->order_by('produtos_disponiveis.pesquisas_farma', 'desc');

        endif;

    if($_POST['tipo'] == 'a4'):
        $this->db->order_by('produtos_disponiveis.preco', 'desc');

        endif;

    if($_POST['tipo'] == 'a5'):
        $this->db->order_by('produtos_disponiveis.preco', 'asc');

        endif;

else:
    $this->db->order_by('produtos_disponiveis.preco', 'min', 'produtos_disponiveis.pesquisas_farma', 'desc');

endif;
        $get = $this->db->get();
        $count = $get->num_rows();

        if ($count > 0 and $_POST['tipo'] <> 777):

            $result = $get->result_array();
            foreach ($result as $dds) {


                if ($_POST['pg1'] == 11):
                    $this->db->from('medicamentos');
                    $this->db->where('id', $dds['id_produto']);
                    $get = $this->db->get();
                    $reultprod = $get->result_array();
                    $buscas = $reultprod[0]['pesquisas'];


                    $buscan = $buscas + 1;
                    $dado['pesquisas'] = $buscan;
                    $this->db->where('id', $dds['id_produto']);
                    $this->db->update('medicamentos', $dado);
                endif;
                ?>
                <?php
                $this->db->from('lojas');
                $this->db->where('id_loja', $dds['id_loja']);
                $get = $this->db->get();
                $countlg = $get->num_rows();
                $fetchad = $get->result_array();
                $arrayreplace = array("(", ")", "-");
                ?>



                <div class="col-sm-5 col-md-<?php if ($_POST['tipo'] == 11): echo '3';
                else: echo '4'; endif; ?> illustration-v2" id="compra" style="border: none; float: left;height: 400px">

                    <div class="thumbnail product-img"
                         style="border:none; border-radius:0;box-shadow:none; border-right: 1px solid #f2f2f2; ">
                        <?php if (!empty($dds['desconto'])): ?>
                            <span
                                style="position: absolute;left: 68%; padding: 1% 3% 1% 2% ;color: white;font-weight: 600; background: #972227; float: right;">- <?php echo $dds['desconto']; ?>
                                % OFF</span>

                        <?php endif; ?>

                        <a style="position: absolute;top:30%; text-decoration:none;left: 38%; padding: 2% 4% 2% 4% ;color: white;font-weight: 600; background: #972227; float: right;"
                           class="add-to-cart"

                            <?php
                            if ($countlg > 0):

                                echo 'href="' . base_url('produto/' . str_replace(' ', '-', strtolower($fetchad[0]['nome_loja'])) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome'])))) . '/' . $dds['id_pdp'] . '"';
                            endif;
                            ?>
                        ><i
                                class="fa fa-shopping-cart"></i> Ver Detalhes</a>

                        <?php
                        if (empty($reultprod[0]['image_1']) and empty($dds['image_1'])):

                            ?>

                            <img style="height: 200px;"
                                 src="<?php echo base_url('assets/1/img/empty_prod_pannel.ico'); ?>"
                                 alt="...">
                            <?php

                        else:


                            ?>
                            <img style="height: 200px;"
                                 src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $dds['id'] . '') ?>"
                                 alt="...">
                        <?php endif; ?>

                        <div class="caption">
                            <div style="float: left; width: 70%; padding-left: -10px;margin-right: 10px; ">
                                <h4 style="margin-bottom: 0;"><b><a style="color: black;text-decoration: none;"
                                            <?php
                                            if ($countlg > 0):

                                                echo 'href="' . base_url('produto/' . str_replace(' ', '-', strtolower($fetchad[0]['nome_loja'])) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome'])))) . '/' . $dds['id_pdp'] . '"';
                                            endif;
                                            ?>
                                        >

                                            <?php echo substr($dds['nome'],0,35); ?></a></b></h4>
                                <?php

                                if ($countlg > 0):
                                    echo '<span>Em <a href="' . base_url('loja/' . str_replace(' ', '-', strtolower($fetchad[0]['nome_loja'])) . '/' . $dds['id_loja']) . '" style="color: #940f14;font-weight: 600;">' . ucwords($fetchad[0]['nome_loja']) . '</a></span>';

                                else:

                                    echo '<span><a style="color: #940f14;font-weight: 600;">Produto Indisponivel</a></span>';
                                endif;
                                ?>

                                <br>
                                <b data-toggle="modal" data-target="#addcarditem<?php echo $dds['id_pdp'];?>" style="cursor: pointer;"><i class="glyphicon glyphicon-shopping-cart"></i> Adicionar ao Carrinho</b>
                                <a data-toggle="modal" data-target="#lance<?php echo $dds['id_pdp'];?>" class="btn" style="background:#dc0000;width: 100%;color: white;border-radius: 0;padding: 3%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>

                                

                                <!-- Modal -->

                                <?php

$this->db->from('produtos_disponiveis');
$this->db->where('id_pdp', $dds['id_pdp']);
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
<div style="top: 10%;border-radius: 0; z-index: 200000;" class="modal fade" id="lance<?php echo $dds['id_pdp'];?>" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel<?php echo $dds['id_pdp'];?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius:0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="float: left;color: black;">FAÇA SEU LANCE</h4>
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

                                    <?php 

                                        $desconto = 0;
                                        $valor = 0;

                                        if (empty($result[0]['desconto'])){
                                            $desconto = number_format($result[0]['preco'], 2, ',', '.');
                                        } else {
                                            $desconto = number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');
                                        }

                                        if(empty($result[0]['desconto'])){
                                            $valor = number_format($result[0]['preco'], 2, ',', '.');
                                        } else {
                                            $valor = number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');
                                        }

                                        ?>

                                    <input
                                        style="outline: none;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                        size="9" type="text" id="moneys"
                                        placeholder="<?php echo $desconto; ?>" value="<?php echo $valor; ?>">
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
                            $this->db->where('id', $dds['id_pdp']);
                            $query = $this->db->get();
                            $rest = $query->result_array();
                            if (empty($rest[0]['image_1'])):


                                $this->db->from('produtos_disponiveis');
                                $this->db->where('id_pdp', $dds['id_pdp']);
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
                                $this->db->where('id_pdp', $dds['id_pdp']);
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

                                    <?php 

                                        $desconto = 0;
                                        $valor = 0;

                                        if (empty($result[0]['desconto'])){
                                            $desconto = number_format($result[0]['preco'], 2, ',', '.');
                                        } else {
                                            $desconto = number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');
                                        }

                                        if(empty($result[0]['desconto'])){
                                            $valor = number_format($result[0]['preco'], 2, ',', '.');
                                        } else {
                                            $valor = number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');
                                        }

                                        ?>

                                   
                                    <input
                                        style="outline: none;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                        size="9" type="text" id="moneys"
                                        placeholder="<?php echo $desconto; ?>" value="<?php echo $valor; ?>">
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

                                <!--- // Fim Modal -->
                                

                            </div>

                            <div style="float: right;border-left: 1px solid #d6d6d6; padding-left: 10px;">
                                <?php if (empty($dds['desconto'])):
                                    ?>
                                    <br>
                                    <span
                                        style="font-size: 14pt;font-weight: 600; color: #940f14;">R$<?php echo number_format($dds['preco'], 2, ',', '.'); ?></span>

                                    <?php
                                else:
                                    ?>
                                    <span
                                        style="color: #a9acb1;">de R$<?php echo number_format($dds['preco'], 2, ',', '.'); ?></span>
                                    <br>
                                    <span
                                        style="font-size: 14pt;font-weight: 600; color: #940f14;">R$<?php echo number_format($dds['preco'] - $dds['preco'] / 100 * $dds['desconto'], 2, ',', '.'); ?></span>



                                <?php endif; ?>

                            </div>

                            <br>
                            <br>
                            <br>

                        </div>
                    </div>


                </div>

                <!-- Modal -->
                <div style="position: absolute;z-index: 100000000000000000000000000000000000000;" class="modal fade" id="addcarditem<?php echo $dds['id_pdp'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document" style="z-index: 100000000000000000000000000000000000000;">
                        <div class="modal-content" style="z-index: 100000000000000000000000000000000000000;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

            }
        else:

            echo '<h1>Nenhum Resultado encontrado</h1>';

        endif;
        ?>


    </div>
<?php if ($count1 > 20): ?>
    <nav aria-label="" style="position: absolute; left: 50%;">
        <ul class="pager" style=" float: left;">
            <li>
                <a href="javascript:categoria('<?php echo base_url(''); ?>',<?php echo $_POST['tipo']; ?>,'<?php if ($atualpg <= 1): echo $atualpg;
                else: echo $atualpg - 1; endif; ?>','1','produtoshome','produtos','<?php echo $_POST['keyword'] ?>','<?php echo $_POST['pg1']; ?>');"
                   aria-label="Previous">
                    Anterior
                </a>
            </li>

            <li>
                <a href="javascript:categoria('<?php echo base_url(''); ?>',<?php echo $_POST['tipo']; ?>,<?php echo $_POST['page'] + 1; ?>,'1','produtoshome','produtos','<?php echo $_POST['keyword'] ?>','<?php echo $_POST['pg1']; ?>');"
                   aria-label="Next">
                    Próximo
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>