<div class="panel-body margin-bottom-40">

    <?php

    $this->db->from('lances');
    $this->db->where('id_loja', $_POST['keyword']);
    $get = $this->db->get();
    $count1 = $get->num_rows();
    $max = 15;
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
    $this->db->from('lances');
    $this->db->join('lances_users_dados', 'lances_users_dados.id_lance = lances.id', 'inner');

    if(!empty($_POST['details'])):
        $this->db->like('lances_users_dados.email', $_POST['details']);
    endif;
    $this->db->where('lances.id_loja', $_POST['keyword']);
    $this->db->where('lances.status !=', 5);
    $this->db->limit($max, $atual);
    $this->db->order_by('lances.resposta', 'asc','lances.id', 'desc');
    $get = $this->db->get();
    $count = $get->num_rows();

    if ($count > 0):

        $result = $get->result_array();
        ?>
    <?php
    if($_POST['tipo'] == '32'):

    ?>
    <section>
        <label for="emailcog" class="input">
            <input type="email" id="buscaestoque" size="85" style="padding: 1%;" placeholder="Buscar no Estoque" name="email" value="<?php if(isset($_POST['details'])): echo $_POST['details']; endif;?>">

        </label>            <a style="margin: 0 0 0 3%; " href="javascript:categoria('<?php echo base_url(''); ?>','32', '1','0','lancesfarma','lancesaltab','<?php echo $_POST['keyword'];?>','',$('#buscaestoque').val());"><i class="icon-append fa fa-search"></i></a>

    </section>
        <br>
        <br>
    <?php  endif; ?>
        <ul class="timeline-v2 timeline-me">

        <?php



        foreach ($result as $dds) {


        if ($dds['status'] == 1):

            $dado['status'] = 2;
            $this->db->where('id', $dds['id_lance']);
            $this->db->update('lances', $dado);

        endif;

            $this->db->from('produtos_disponiveis');
            $this->db->where('id_pdp', $dds['id_produto']);
            $get = $this->db->get();
            $count55 = $get->num_rows();

            if($count55):

                $ddsah = $get->result_array();
        $this->db->from('medicamentos');
        $this->db->where('id', $ddsah[0]['id_produto']);
        $get = $this->db->get();
        $count = $get->num_rows();
        $data = $dds['data_lance'];
        $ano = substr($data, 0, 4);
        $dia = substr($data, 6, 2);
        $mes = substr($data, 4, 2);
        if ($count > 0):
            $result = $get->result_array();
            ?>

            <li id="itemlist<?php echo $dds['id_lance']; ?><?php echo $_POST['tipo']; ?>">
                <a onclick="FunctionreadFtn('<?php echo base_url(''); ?>','<?php echo $dds['id_lance']; ?>');"
                   style="text-decoration: none;cursor: pointer;" data-toggle="modal"
                   data-target="#infolance<?php echo $dds['id_lance'] . $_POST['tipo']; ?>">
                    <time datetime="" class="cbp_tmtime">
                        <span><?php echo $result[0]['nome']; ?></span>
                        <span><?php echo $dia . '/' . $mes . '/' . $ano; ?></span>
                    </time>
                    <?php if ($dds['resposta'] > 0): ?>
                        <i style="background: #00CC00;" class="cbp_tmicon rounded-x hidden-xs"></i>

                    <?php else: ?>
                        <i class="cbp_tmicon rounded-x hidden-xs"></i>

                    <?php endif; ?>
                    <div class="cbp_tmlabel">
                        <h2><?php echo $result[0]['nome']; ?></h2>
                        <p><?php echo $result[0]['fixa_cal']; ?></p>
                        <h4>Info da Oferta:<br>
                            <small><b>Total:</b>
                                R$<?php echo number_format(str_replace(',', '.', $dds['valor']) * $dds['unidades'], 2, '.', ','); ?>
                                - <b>Unitário:</b> R$<?php echo $dds['valor']; ?> -
                                <b>Unidades:</b> <?php echo number_format($dds['unidades']); ?></small>
                        </h4>
                        <?php
                        $this->db->from('users');
                        $this->db->where('id', $dds['id_cliente']);
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if ($count > 0):

                            $result1 = $get->result_array();
                            ?>

                            <?php
                            /*   $this->db->from('');
                               $this->db->where('','');
                               $get =  $this->db->get();
                               $count = $get->num_rows();
                               if($count > 0):

                                   endif; */


                            $this->db->from('lances_users_dados');
                            $this->db->where('id_lance', $dds['id_lance']);
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            if ($count > 0):

                                $result = $get->result_array();

                                ?>


                                <?php

                            endif; ?>
                            <h6><b>Nome:</b> <?php echo $result[0]['nome']; ?><br><b>Email:</b> <a
                                    title="Enviar e-mail para <?php echo $result[0]['email']; ?>"
                                    href="mailto:<?php echo $result[0]['email']; ?>"><?php echo $result[0]['email']; ?></a>
                            </h6>

                        <?php endif; ?>
                    </div>
                </a>

            </li>
        <?php endif; ?>




        <!-- Modal -->
        <div class="modal fade" id="infolance<?php echo $dds['id_lance'] . $_POST['tipo']; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" style="border-radius: 0px;margin: 2%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Status do Lance
                            - <?php echo $result[0]['nome']; ?> </h4>
                    </div>
                    <div class="modal-body" style="border-radius: 0px;">
                        <div class="row" style="padding: 2%">
                            <div class="col-md-8">
                                <h4 style="font-weight: bold;color: black; font-size: 12pt;">Lance sobre
                                    o produto<br> <a style="color: #940f14;"> <?php echo $result[0]['nome']; ?></a></h4>
                                <hr>
                                <!-- <h5 style="color: black;text-align: left;">Sobre o Produto</h5>
                                <?php echo $result[0]['fixa_cal']; ?> -->
                                <h3>Info de Estoque</h3>
                                <?php

                                $this->db->from('produtos_disponiveis');
                                $this->db->where('id_pdp', $dds['id_produto']);
                                $get = $this->db->get();
                                if ($get->num_rows() > 0):

                                    $result = $get->result_array();


                                    if (!empty($result[0]['unidades'])):

                                        echo '<b>' . $result[0]['unidades'] . '</b> unidades restantes.';

                                    else:

                                        echo '<b>Unidades Ilimitadas</b>';
                                    endif;

                                    if (!empty($result[0]['desconto'])):

                                        echo '<br><b>' . $result[0]['desconto'] . '%</b> de desconto.';

                                    endif;
                                    echo '<br><b>R$' . $result[0]['preco'] . '</b> Preço Original.';

                                else:
                                    echo 'Dados do Produto Indisponível.';
                                endif;

                                ?>
                                <h3>Dados do Ofertante</h3>
                                <div style="text-align: left;">
                                    <form>
                                        <label style="width: 28%;">
                                            <b style="font-size: 15pt;">R$ <?php echo $dds['valor']; ?>|</b>

                                        </label>
                                        <label style="width:28%;">
                                            <b style="font-size: 12pt;">Qntd.</b>

                                            <?php echo number_format($dds['unidades']); ?> </label>
                                    </form>
                                    <br>
                                    <?php
                                    /*   $this->db->from('');
                                       $this->db->where('','');
                                       $get =  $this->db->get();
                                       $count = $get->num_rows();
                                       if($count > 0):

                                           endif; */


                                    $this->db->from('lances_users_dados');
                                    $this->db->where('id_lance', $dds['id_lance']);
                                    $get = $this->db->get();
                                    $count = $get->num_rows();
                                    if ($count > 0):

                                        $result = $get->result_array();

                                        ?>
                                        <p>
                                            <b>Nome do Ofertante: </b> <?php

                                            if (empty($result[0]['nome'])):

                                                echo 'Nome Indisponivel';
                                            else:
                                                echo $result[0]['nome'];
                                            endif;

                                            ?> </p>


                                        <p>

                                        <p>
                                            <b>Telefone de Contato: </b> <?php

                                            if (empty($result[0]['telefone'])):

                                                echo 'Telefone Indisponivel';
                                            else:
                                                echo $result[0]['telefone'];
                                            endif;

                                            ?> </p>


                                        <p>
                                            <b>Email para Contato: </b>

                                            <?php

                                            if (empty($result[0]['email'])):

                                                echo 'E-mail Indisponivel';
                                            else:
                                                echo '<a title="Enviar e-mail para ' . $result[0]['email'] . '" href="mailto:' . $result[0]['email'] . '">' . $result[0]['email'] . '</a>';
                                            endif;

                                            ?>

                                        </p>


                                        <?php

                                    endif; ?>

                                    <p class="text-info">
                                        <small><b>Observação:</b> Sempre confirme os dados com o cliente antes de
                                            realizar o envio.
                                        </small>
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid #dfdfdf;">
                                <a><img style="width: 100%;"
                                        src="<?php

                                        if(empty($result[0]['image_1'])):
                                            echo base_url('assets/1/img/empty_prod_pannel.ico');
                                            else:
                                                echo base_url('imagem?tp=1&im=1&image='.$result[0]['id_pdp']);
                                                endif;

                                       ?>"
                                        data-pin-nopin="true"></a>
                                <br>
                                <hr>

                                <div>
                                    <b style="margin-top: 5px;">Valor total:
                                        R$ <?php echo number_format(str_replace(',', '.', $dds['valor']) * $dds['unidades'], 2, '.', ','); ?></b><br>
                                    <b>Enviada: <i style="color: #30944c;" class="fa fa-check" aria-hidden="true"></i>
                                    </b><br>

                                    <b>Recebida: <i style="color: #30944c;" class="fa fa-check" aria-hidden="true"></i>
                                    </b><br>
                                    <b>Lida: <i style="color: #30944c;" class="fa fa-check" aria-hidden="true"></i> </b><br>

                                    <b>Resposta:

                                        <?php if ($dds['resposta'] <= 0): ?>
                                            <span class="text-info">Aguardando...</span>
                                        <?php elseif ($dds['resposta'] == 1): ?>

                                            <span class="text-danger">Negado</span>


                                        <?php elseif ($dds['resposta'] == 2): ?>
                                            <span class="text-success">Aceito</span>


                                        <?php else: ?>
                                            <span class="text-danger">Indisponivel</span>


                                        <?php endif; ?>


                                    </b>

                                </div>

                                <br>
                            </div>

                            <?php if ($dds['resposta'] > 0): ?>
                                  <span style="text-align: center;"> <a href="javascript:removelista('<?php echo $dds['id_lance']?>','<?php echo $_POST['tipo']?>')" style="margin-top: 5px;" class="btn btn-u" >Remover da Lista</a></span>
                            <?php endif;?>


                        </div>
                    </div>
        <?php if ($dds['resposta'] <= 0): ?>
                    <div class="modal-footer" id="respfooter<?php echo $dds['id_lance']; ?><?php echo $_POST['tipo']; ?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-danger"
                                id="denied<?php echo $dds['id_lance']; ?><?php echo $_POST['tipo']; ?>"
                                onclick="lanceResposta('<?php echo base_url(''); ?>','0','<?php echo $dds['id_lance']; ?>','<?php echo $_POST['tipo']; ?>','denied');">
                            Recusar
                        </button>
                        <button id="accept<?php echo $dds['id_lance']; ?><?php echo $_POST['tipo']; ?>" type="button"
                                class="btn btn-success"
                                onclick="lanceResposta('<?php echo base_url(''); ?>','1','<?php echo $dds['id_lance']; ?>','<?php echo $_POST['tipo']; ?>','accept');">
                            Aceitar
                        </button>
                    </div>

            <?php endif; ?>
                </div>
            </div>
        </div><br><br><br>
            <?php
            endif;

    }
    echo '</ul>';


    else:

        ?>

        <br>
        <h2 style="text-align: center;">Nenhum Resultado</h2>

        <?php

    endif; ?>


    <?php
    if ($_POST['tipo'] == 32):


        ?>

        <nav aria-label="Page navigation">
            <ul class="pager">
                <li>
                    <a href="javascript:categoria('<?php echo base_url(''); ?>','32', '<?php if ($atualpg <= 1): echo $atualpg;
                    else: echo $atualpg - 1; endif; ?>','1','lancesfarma','lancesaltab',<?php echo $_POST['keyword'] ?>,'');"
                       aria-label="Previous">
                        Anterior
                    </a>
                </li>

                <li>
                    <a href="javascript:categoria('<?php echo base_url(''); ?>','32', '<?php echo $atualpg + 1; ?>','1','lancesfarma','lancesaltab',<?php echo $_POST['keyword'] ?>,'');"
                       aria-label="Next">
                        Proximo
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>
