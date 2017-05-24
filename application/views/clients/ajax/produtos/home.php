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