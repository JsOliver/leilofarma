<?php $this->load->view('clients/fixed_files/header');

$this->db->from('users');
$this->db->where('id', $_SESSION['ID']);
$query = $this->db->get();
$result = $query->result_array();

if ($result[0]['loja'] <> 0):

$this->db->from('lojas');
$this->db->where('id_loja', $result[0]['loja']);
$get = $this->db->get();
$count = $get->num_rows();
if ($count > 0):
$result = $get->result_array();
?>

    <script>

        window.onload = function () {

            categoria('<?php echo base_url('');?>', '31', '1', '0', 'lancesfarma', 'lfms', '<?php echo $result[0]['id_loja'];?>', '');

            categoria('<?php echo base_url('');?>', '31', '1', '0', 'lancesfarma', 'lfms2', '<?php echo $result[0]['id_loja'];?>', '');

            <?php if(isset($_GET['p'])):
        ?>
            categoria('<?php echo base_url(''); ?>','32', '1','0','estoquefarma','estoquefarmatab','<?php echo $result[0]['id_loja'];?>','<?php echo $_GET['p']?>');
        <?php endif;?>
        }


    </script>

<div class="col-md-9">
    <div class="profile-body">
        <div class="profile-bio">
            <div class="row">
                <div class="col-md-5">
                    <?php

                    if (empty($result[0]['image_1'])):

                        $image = base_url('assets/' . $version . '/img/farma.png');
                    else:
                        $image = base_url('imagem?tp=4&&im=44&&image=' . $_SESSION['ID']);


                    endif;

                    ?>
                    <img id="profileimgLoja" style="width: 300px;height: 200px;object-fit: cover; object-position: center;"
                         class="img-responsive md-margin-bottom-10"
                         src="<?php echo $image; ?>" alt="">
                    <br>
                    <b id="errorDataLoja"></b>
                    <form enctype="multipart/form-data" method="post">
                        <label class="btn-u btn-u-sm" style="cursor: pointer; text-align: center; left: 29%;">Alterar
                            imagem
                            <input style="display: none;" id="fileUploadLoja" name="fileUploadLoja" type="file"/>
                        </label>
                    </form>
                </div>
                <div class="col-md-7">
                    <h2><?php echo $result[0]['nome_loja']; ?></h2>
                    <span><strong>Cidade:</strong> <?php echo $result[0]['cidade']; ?></span>
                    <span><strong>Estado:</strong> <?php echo $result[0]['estado']; ?></span>
                    <hr>
<!--
                    <?php
                    if (empty($result[0]['descricao_loja'])):
                        ?>
                        <p style="color:#a6a6a6;float: left; text-align: left; width: 85%;">

                            Informe a descrição de sua loja aqui.
                        </p>

                        <?php
                    else:

                        echo '<p style="float: left; text-align: left; width: 85%;">
' . $result[0]['descricao_loja'] . '</p>';

                    endif; ?>-->


                    <div class="dropdown show pull-right">
                        <a class="btn btn-secondary dropdown-toggle" href="#" id="cong"  data-toggle="modal" data-target="#deleteloja">
                            <i class="fa fa-trash "></i>
                        </a>


                    </div>


                    <!-- Modal -->
                    <div style="z-index: 1000000000000000000000;" class="modal fade" id="deleteloja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document"  style="margin-top: 5%;z-index: 1000000000000000000000;">
                            <div class="modal-content" style="margin-top: 5%;z-index: 1000000000000000000000;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Excluir Loja</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Tem Certeza que Deseja Excluir sua Loja?</p>
                                    <p><b>Esta ação não poderá se desfeita!</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" onclick="deleteStore();">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo '<p><b>Email Administrativo</b>: '.$result[0]['email'].'</p>';
                    echo '<p><b>Email de Contato</b>: '.$result[0]['email'].'</p>';
                    echo '<p><b>Endereço</b>: '.$result[0]['rua'].'</p>';
                    ?>

                </div>

            </div>
        </div><!--/end row-->
        <hr>
        <div class="row">
            <!--Social Icons v3-->
            <div class="col-md-12">
                <div class="profile-body margin-bottom-20">
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="<?php if(!isset($_GET['p'])): echo 'active'; endif;?>"><a data-toggle="tab" href="#profile" aria-expanded="true">Resumo</a></li>
                            <li class=""><a data-toggle="tab" href="#lancesaltab"
                                            onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','lancesfarma','lancesaltab','<?php echo $result[0]['id_loja'];?>','');"
                                            aria-expanded="false">Lances
                                    Pendentes</a></li>
                            <!--<li><a data-toggle="tab" href="#payment">Relatorios</a></li>-->
                            <li class="<?php if(isset($_GET['p'])): echo 'active';  endif;?>"><a data-toggle="tab" href="#estoquefarmatab"  onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','estoquefarma','estoquefarmatab','<?php echo $result[0]['id_loja'];?>','');">Meu Estoque</a></li>
                        </ul>
                        <div class="tab-content">

                            <div id="profile" class="profile-edit tab-pane fade <?php if(!isset($_GET['p'])): echo 'active in';  endif;?> ">

                                <div class="row">
                                    <div>
                                        <div>

                                            <div class="row margin-bottom-10">
                                                <div class="col-sm-6 sm-margin-bottom-20">
                                                    <div class="service-block-v3 service-block-u">
                                                        <i class="fa fa-users"></i>
                                                        <span class="service-heading">Visitas em Produtos</span>

                                                        <?php


                                                        $this->db->select_sum('pesquisas_farma');
                                                        $this->db->from('produtos_disponiveis');
                                                        $this->db->where('id_loja', $result[0]['id_loja']);
                                                        $this->db->count_all();
                                                        $query = $this->db->get();


                                                        $count = $query->result_array();


                                                        ?>
                                                        <span
                                                            class="counter"><?php echo number_format($count[0]['pesquisas_farma']) ?></span>

                                                        <div class="clearfix margin-bottom-10"></div>

                                                        <!-- <div class="row margin-bottom-20">
                                                             <div class="col-xs-6 service-in">
                                                                 <small>Hoje</small>
                                                                 <h4 class="counter">0</h4>
                                                             </div>
                                                             <div class="col-xs-6 text-right service-in">
                                                                 <small>Esse Mês</small>
                                                                 <h4 class="counter">0</h4>
                                                             </div>
                                                         </div> -->
                                                        <div class="statistics">
                                                            <h3 class="heading-xs">Produtos Exibidos na Busca <!-- <span
                                                                    class="pull-right">0%</span>--></h3>
                                                            <!-- <div class="progress progress-u progress-xxs">
                                                                 <div style="width: 0%" aria-valuemax="100"
                                                                      aria-valuemin="0" aria-valuenow="0"
                                                                      role="progressbar"
                                                                      class="progress-bar progress-bar-light">
                                                                 </div>
                                                             </div>
                                                             <small>17% mais <strong>do ultimo mês</strong></small> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                $this->db->from('lances');
                                                $this->db->where('id_loja', $result[0]['id_loja']);
                                                $query = $this->db->get();
                                                $count = $query->num_rows();

                                                ?>
                                                <div class="col-sm-6">
                                                    <div class="service-block-v3 service-block-blue">
                                                        <i class="fa fa-gavel"></i>
                                                        <span class="service-heading">Lances nos Produtos</span>
                                                        <span
                                                            class="counter"><?php echo number_format($count); ?></span>

                                                        <div class="clearfix margin-bottom-10"></div>

                                                        <!--<div class="row margin-bottom-20">
                                                            <div class="col-xs-6 service-in">
                                                                <small>Hoje</small>
                                                                <h4 class="counter">0</h4>
                                                            </div>
                                                            <div class="col-xs-6 text-right service-in">
                                                                <small>Esse Mês</small>
                                                                <h4 class="counter">0</h4>
                                                            </div>
                                                        </div>-->
                                                        <div class="statistics">
                                                            <h3 class="heading-xs">Ofertas de Compras em Produtos <!--<span
                                                                    class="pull-right">0%</span>--></h3>
                                                            <!-- <div class="progress progress-u progress-xxs">
                                                                 <div style="width: 0%" aria-valuemax="100"
                                                                      aria-valuemin="0" aria-valuenow="0"
                                                                      role="progressbar"
                                                                      class="progress-bar progress-bar-light">
                                                                 </div>
                                                             </div>
                                                             <small>15% mais <strong>do ultimo mês</strong></small> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php

                                            $this->db->from('produtos_disponiveis');
                                            $this->db->where('id_loja', $result[0]['id_loja']);
                                            $get = $this->db->get();
                                            $count = $get->num_rows();
                                            if($count > 0):
                                            ?>
                                            <div class="col-sm-12 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i
                                                                class="fa fa-lightbulb-o"></i> Mais
                                                            Visitados
                                                        </h2>
                                                    </div>
                                                    <div class="panel-body">

                                                        <?php

                                                        $this->db->from('produtos_disponiveis');
                                                        $this->db->where('id_loja', $result[0]['id_loja']);
                                                        $this->db->where('visible', 1);
                                                        $this->db->order_by('pesquisas_farma', 'desc');
                                                        $this->db->limit(5, 0);
                                                        $get = $this->db->get();

                                                        $result = $get->result_array();

                                                        foreach ($result as $dds) {
                                                            ?>
                                                            <small><?php echo character_limiter($dds['nome_prod'],12);?></small>
                                                            <small style="font-weight: bold;"><?php echo number_format($dds['pesquisas_farma']);?></small>
                                                            <div class="progress progress-u progress-xxs">
                                                                <div style="width: 92%" aria-valuemax="100"
                                                                     aria-valuemin="0" aria-valuenow="100"
                                                                     role="progressbar"
                                                                     class="progress-bar progress-bar-u">
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif;?>

                                        </div><!--/end row-->

                                        <hr>

                                        <!--Timeline-->
                                        <div class="panel panel-profile">
                                            <div class="panel-heading overflow-h">
                                                <h2 class="panel-title heading-sm pull-left"><i
                                                        class="fa fa-briefcase"></i> Ultimos Lances</h2>
                                                <a href="<?php echo base_url('minha-loja?pg=lances'); ?>"><i
                                                        class="fa fa-plus pull-right"></i></a>
                                            </div>
                                            <div id="lfms"></div>
                                        </div>
                                        <!--End Timeline-->

                                        <!--Timeline-->
                                        <div class="panel panel-profile">
                                            <div class="panel-heading overflow-h">
                                                <h2 class="panel-title heading-sm pull-left"><i
                                                        class="fa fa-briefcase"></i> Maiores Lances</h2>
                                                <a href="<?php echo base_url('minha-loja?pg=lances'); ?>"><i
                                                        class="fa fa-plus pull-right"></i></a>
                                            </div>
                                            <div id="lfms2"></div>
                                        </div>
                                        <!--End Timeline-->


                                    </div>
                                </div>


                            </div>

                            <div id="lancesaltab" class="profile-edit tab-pane fade">

                            </div>

                            <div id="estoquefarmatab" class="profile-edit tab-pane fade <?php if(isset($_GET['p'])): echo 'active in';  endif;?>">

                            </div>

                            <div id="settings" class="profile-edit tab-pane fade">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <?php
    endif;
    else: ?>
        <div class="col-md-9">
            <div class="profile-body">
                <div class="tab-content">

                    <div id="passwordTab" class="profile-edit tab-pane fade active in">
                        <h2 class="heading-md">Informe os Dados para Adicionar sua Farmacia.</h2>
                        <p>Prencha Todos os Dados nos Campos abaixo .</p>
                        <br>
                        <form class="sky-form" id="sky-form4" action="javascript:newFarma();">
                            <dl class="dl-horizontal">
                                <dt>Nome da Farmacia</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input id="nomefarma" required type="text" placeholder="Nome Da Farmacia"
                                                   name="nome">
                                            <b class="tooltip tooltip-bottom-right">Minha Farma</b>
                                        </label>
                                    </section>
                                </dd>
                                <dt>E-mail de Contato</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-envelope"></i>
                                            <input id="emailcon" required type="email"
                                                   placeholder="E-mail Para Contato dos Clientes" name="email">
                                            <b class="tooltip tooltip-bottom-right">E-mail para os Clientes Entrarem em
                                                Contato</b>
                                        </label>
                                    </section>
                                </dd>
                                <dt>Telefone de Contato</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-lock"></i>
                                            <input required type="text" id="teleph" name="telefone"
                                                   placeholder="(00) 0000-0000">
                                            <b class="tooltip tooltip-bottom-right">(00) 0000-0000</b>
                                        </label>
                                    </section>
                                </dd>
                                <dt>Endereço</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-map-marker"></i>
                                            <input required id="neendereco" type="text" name="endereco"
                                                   placeholder="Meu Endereço">
                                            <b class="tooltip tooltip-bottom-right">Meu Endereço</b>
                                        </label>
                                    </section>
                                </dd>

                                <dt>Estado</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-map-marker"></i>
                                            <input required id="nestado" type="text" name="estado"
                                                   placeholder="Meu Estado">
                                            <b class="tooltip tooltip-bottom-right">Meu Estado</b>
                                        </label>
                                    </section>
                                </dd>

                                <dt>Pais</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-map-marker"></i>
                                            <input required type="text" id="nlpais" name="pais" placeholder="Pais">
                                            <b class="tooltip tooltip-bottom-right">Meu Pais</b>
                                        </label>
                                    </section>
                                </dd>

                                <dt>Cidade</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-map-marker"></i>
                                            <input required type="text" id="necidade" name="pais" placeholder="Pais">
                                            <b class="tooltip tooltip-bottom-right">Meu Pais</b>
                                        </label>
                                    </section>
                                </dd>

                                <dt>CEP</dt>
                                <dd>
                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-map-marker"></i>
                                            <input required type="text" id="nlcep" name="cep" placeholder="Cep">
                                            <b class="tooltip tooltip-bottom-right">Meu Cep</b>
                                        </label>
                                    </section>
                                </dd>

                            </dl>
                            <small><i class="fa fa-info-circle"></i> O site busca sua localização para inserir como o
                                ponto
                                da sua farmacia para sua comodidade.
                            </small>
                            <br>
                            <!--    <label class="toggle toggle-change">

                                    <input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Remember
                                    password</label>
                                <br> -->
                            <b id="resposta"></b>
                            <br>

                            <br>

                            <button type="reset" class="btn-u btn-u-default">Limpar Campos</button>
                            <button class="btn-u" type="submit">Salvar Dados</button>
                        </form>
                    </div>


                </div>

            </div>
        </div>

    <?php endif; ?>
</div>
</div>
</div>
<?php $this->load->view('clients/fixed_files/footer'); ?>
