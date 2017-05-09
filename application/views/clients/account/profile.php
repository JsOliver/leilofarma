<?php $this->load->view('clients/fixed_files/header'); ?>


<!-- Profile Content -->
<div class="col-md-9">
    <div class="profile-body">
        <div class="row margin-bottom-20">
            <!--Profile Post-->
            <div class="col-sm-6">
                <div class="panel panel-profile no-bg">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Visitados</h2>
                    </div>
                    <div id="scrollbar" class="panel-body no-padding mCustomScrollbar _mCS_2 mCS-autoHide"
                         data-mcs-theme="minimal-dark" style="position: relative; overflow: visible;">
                        <div id="mCSB_2" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside"
                             tabindex="0">
                            <div id="mCSB_2_container" class="mCSB_container"
                                 style="position:relative; top:0; left:0;" dir="ltr">
                                <?php

                                $this->db->from('visitados');
                                $this->db->where('id_user', $_SESSION['ID']);
                                $this->db->order_by('id', 'desc');
                                $this->db->limit(5, 0);
                                $get = $this->db->get();
                                $count = $get->num_rows();
                                if ($count > 0):
                                    $result = $get->result_array();

                                    $i = 0;
                                    foreach ($result as $dds) {
                                        $i++;
                                        $this->db->from('produtos_disponiveis');
                                        $this->db->where('id_pdp', $dds['id_item']);
                                        $get = $this->db->get();
                                        $count = $get->num_rows();

                                        if ($count > 0):
                                            $result = $get->result_array();

                                            $name = $result[0]['nome_prod'];
                                            $data = $dds['data_visita'];
                                            $ano = substr($data, 0, 4);
                                            $mes = substr($data, 4, 2);
                                            $dia = substr($data, 6, 2);
                                            $hora = substr($data, 8, 2);
                                            $minuto = substr($data, 10, 2);
                                            $segundo = substr($data, 12, 2);

                                            $data = 'Vista realizada no dia ' . $dia . ' do mês ' . $mes . ' as ' . $hora . ':' . $minuto . ':' . $segundo . ' de ' . $ano;
                                        else:

                                            $name = 'Produto Indisponivel';
                                            $data = 'Data Indisponivel';

                                        endif;

                                        $this->db->from('lojas');
                                        $this->db->where('id_loja', $result[0]['id_loja']);
                                        $get = $this->db->get();
                                        $count = $get->num_rows();
                                        $arrayreplace = array("(", ")", "-");

                                        if ($count > 0):

                                            $results = $get->result_array();

                                        $nomeloja = $results[0]['nome_loja'];
                                        $url =  base_url('produto/' . str_replace(' ', '-',str_replace($arrayreplace, '', strtolower($nomeloja))) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($name)))). '/' . $dds['id_item'];

                                        else:

                                            $url = '';

                                        endif;
                                        ?>
                                        <div class="profile-post color-one">
                                            <span class="profile-post-numb"><?php echo $i; ?></span>
                                            <div class="profile-post-in">
                                                <h3 title="<?php echo $name;?>" class="heading-xs"><a
                                                        href="<?php echo $url; ?>"><?php echo character_limiter($name,25); ?></a>
                                                </h3>
                                                <p><?php echo $data; ?></p>
                                            </div>
                                        </div>

                                        <?php
                                    }

                                    else:
                                    ?>

                                        <div class="profile-post color-one">
                                            <span class="profile-post-numb"></span>
                                            <div class="profile-post-in">
                                                <h3 class="heading-xs" style="text-align: center;"><a
                                                        >Nenhuma Busca</a>
                                                </h3>
                                            </div>
                                        </div>
                                <?php
                                endif;
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Profile Post-->

            <!--Profile Event-->
            <div class="col-sm-6 md-margin-bottom-20">
                <div class="panel panel-profile no-bg">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Melhores Ofertas
                        </h2>
                    </div>
                    <div id="scrollbar2" class="panel-body no-padding mCustomScrollbar _mCS_3 mCS-autoHide"
                         data-mcs-theme="minimal-dark" style="position: relative; overflow: visible;">
                        <div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside"
                             tabindex="0">
                            <div id="mCSB_3_container" class="mCSB_container"
                                 style="position:relative; top:0; left:0;" dir="ltr">


                                <?php



                                $this->db->from('produtos_disponiveis');
                                $this->db->where('desconto > ',1);
                                $this->db->order_by('desconto', 'desc');
                                $this->db->limit(3, 0);
                                $get = $this->db->get();
                                $count = $get->num_rows();
                                if ($count > 0):
                                $result = $get->result_array();

                                $i = 0;
                                foreach ($result as $dds) {
                                    $data = $dds['data_adicionado'];
                                    $ano = substr($data, 0, 4);
                                    $mes = substr($data, 4, 2);
                                    $dia = substr($data, 6, 2);
                                    $hora = substr($data, 8, 2);
                                    $minuto = substr($data, 10, 2);
                                    $segundo = substr($data, 12, 2);
                                ?>
                                    <div class="profile-event">
                                        <div class="date-formats">
                                            <span><?php echo $dds['desconto'];?>%</span>
                                            <small>desconto</small>
                                        </div>
                                        <div class="overflow-h">
                                            <h3 title="<?php echo $dds['nome_prod'];?>" class="heading-xs"><a href="#"><?php echo character_limiter($dds['nome_prod'],22);?></a></h3>
                                            <p>Compre agora <?php echo character_limiter($dds['nome_prod'],40);?> com até <?php echo $dds['desconto']?>% de desconto.</p>

                                            <p>de <b style="font-size: 12pt;"><?php echo $dds['preco']?></b> por <b style="font-size: 14pt;font-weight: 600; color: #940f14;">R$<?php echo number_format($dds['preco'] - $dds['preco'] / 100 * $dds['desconto'], 2, ',', '.'); ?></b></p>
                                        </div>
                                    </div>
                                <?php }

                                endif;
                                ?>


                            </div>
                        </div>
                        <div id="mCSB_3_scrollbar_vertical"
                             class="mCSB_scrollTools mCSB_3_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical"
                             style="display: block;">
                            <div class="mCSB_draggerContainer">
                                <div id="mCSB_3_dragger_vertical" class="mCSB_dragger"
                                     style="position: absolute; min-height: 50px; display: block; height: 213px; max-height: 286px;"
                                     oncontextmenu="return false;">
                                    <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                </div>
                                <div class="mCSB_draggerRail"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Profile Event-->
        </div><!--/end row-->

        <hr>
        <br>

        <!--
        <div class="panel panel-profile">
            <div class="panel-heading overflow-h">
                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tasks"></i>Farmacias Salvas</h2>
                <a href="page_profile_users.html"
                   class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right">Ver Tudo</a>
            </div>
            <div class="panel-body">
                <div class="row">

                    <?php for ($i = 0; $i < 2; $i++): ?>
                        <div class="col-sm-6">
                            <div class="profile-blog blog-border">
                                <img class="rounded-x" src="assets/img/testimonials/img1.jpg" alt="">
                                <div class="name-location">
                                    <strong>Mikel Andrews</strong>
                                    <span><i class="fa fa-map-marker"></i><a href="#">California,</a> <a
                                            href="#">US</a></span>
                                </div>
                                <div class="clearfix margin-bottom-20"></div>
                                <p>Donec non dignissim eros. Mauris faucibus turpis volutpat sagittis rhoncus.
                                    Pellentesque et rhoncus sapien, sed ullamcorper justo.</p>
                                <hr>
                                <ul class="list-inline share-list">
                                    <li><i class="fa fa-bell"></i><a href="#">12 Notifications</a></li>
                                    <li><i class="fa fa-group"></i><a href="#">54 Followers</a></li>
                                    <li><i class="fa fa-twitter"></i><a href="#">Retweet</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div> <hr>
-->


        <div class="table-search-v1 margin-bottom-20">

            <h2>Meus Lances</h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">

                    <thead>

                    <tr>
                        <th>Item</th>
                        <th class="hidden-sm">Descrição</th>
                        <th>Localidade</th>
                        <th style="width: 100px;">Status</th>
                        <th>Contacts</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                    $this->db->from('lances');
                    $this->db->join('produtos_disponiveis','produtos_disponiveis.id_pdp = lances.id_produto');
                    $this->db->join('lojas','lojas.id_loja = produtos_disponiveis.id_loja');
                    $this->db->where('lances.id_cliente',$_SESSION['ID']);
                    $this->db->order_by('lances.id','desc');
                    $get = $this->db->get();
                    if($get->num_rows() > 0):

                        $result = $get->result_array();
                        foreach ($result as $dds) {
                            $this->db->from('lojas');
                            $this->db->where('id_loja', $dds['id_loja']);
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            $arrayreplace = array("(", ")", "-");
                            $result = $get->result_array();
                            $url =  base_url('produto/' . str_replace(' ', '-',str_replace($arrayreplace, '', strtolower($result[0]['nome_loja']))) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome_prod'])))). '/' . $dds['id_pdp'];
                            ?>
                            <tr>
                                <td>
                                    <a href="<?php echo $url;?>"><small><?php echo $dds['nome_prod'];?></small></a>
                                </td>
                                <td class="td-width"><small>Você deu lance no: <b><?php echo $dds['nome_prod'];?></b></small>
                                </td>

                                <td>
                                    <div class="m-marker">
                                        <a href="#"><i class="color-green fa fa-map-marker"></i></a>
                                        <a href="<?php if(empty($dds['pais'])): echo '#'; else: echo 'https://www.google.com.br/?gws_rd=cr&ei=RJW4WKvFNcSgwgSK-YbYAg#q=pais:'.str_replace(' ','+',$dds['pais']).'&*'; endif;?>"



                                           target="_blank" class="display-b"><?php if(empty($dds['pais_uf'])): echo 'Não Informado'; else: echo $dds['pais_uf']; endif;?></a>,
                                        <a href="<?php if(empty($dds['cidade'])): echo '#'; else: echo 'https://www.google.com.br/?gws_rd=cr&ei=RJW4WKvFNcSgwgSK-YbYAg#q=cidade:'.str_replace(' ','+',$dds['cidade']).'&*'; endif;?>"  target="_blank"><?php if(empty($dds['cidade'])): echo 'Não Informado'; else: echo $dds['cidade']; endif; ?></a>
                                    </div>
                                </td>


                                <td>


                                    <?php
                                    if($dds['status'] == 1 and $dds['resposta'] == 0):

                                        echo '
                                     <button class="btn-u btn-u-info btn-block btn-u-xs"><i
                                            class="fa fa-sort-amount-desc margin-right-5"></i>Solicitação Enviada
                                    </button>
';
                                    endif;
                                    ?>


                                    <?php
                                    if($dds['status'] == 2 and $dds['resposta'] == 0):

                                        echo '  <button class="btn-u btn-u-info btn-block btn-u-xs"><i
                                            class="fa fa-sort-amount-desc margin-right-5"></i>Solicitação Recebida
                                    </button>';

                                    endif;
                                    ?>

                                    <?php
                                    if($dds['status'] == 3 and $dds['resposta'] == 0):

                                        echo '<button class="btn-u btn-u-warning btn-block btn-u-xs"><i
                                            class="fa fa-sort-amount-desc margin-right-5"></i> Lida
                                    </button>';

                                    endif;
                                    ?>


                                    <?php

                                    if($dds['resposta'] == 1):
                                        echo '<button class="btn-u btn-u-danger btn-block btn-u-xs"><i
                                            class="fa fa-sort-amount-desc margin-right-5"></i> Negado
                                    </button>';
                                    endif;
                                        if($dds['resposta'] == 2):

                                        echo '<button class="btn-u btn-u-success btn-block btn-u-xs"><i
                                            class="fa fa-sort-amount-desc margin-right-5"></i> Aceito
                                    </button>';

                                    endif;
                                    ?>



                                </td>
                                <td>
                                    <span><?php if(empty($dds['telefone'])):  echo 'Não Informado'; else: echo $dds['telefone'];  endif; ?></span>
                                    <span><a href="#"><?php if(empty($dds['telefone'])): echo 'Não Informado'; else: echo $dds['email_contato']; endif;?></a></span>
                                </td>
                            </tr>
                            <?php

                        }

else:

                        ?>

    <tr>
        <td>
            -- --
        </td>

        <td>
            -- --
        </td>

        <td>
            -- --
        </td>

        <td>
            -- --
        </td>

        <td>
            -- --
        </td>

    </tr>

    <?php

                    endif;

                    ?>

                    </tbody>

                </table>
            </div>
            <a href="<?php echo base_url('meus-lances');?>" class="btn-u btn-u-default btn-u-sm btn-block">Ver Mais</a>
        </div>

    </div>
</div>
</div>
</div>
<?php $this->load->view('clients/fixed_files/footer'); ?>
