<?php $this->load->view('clients/fixed_files/header'); ?>
    <br>

    <div class="navbar faixa-darkred desktopdarkred">
        <div class="container-fluid">
            <div class="collapse navbar-collapse faixa-darkred-sub" id="bs-example-navbar-collapse-1"></div>
        </div>
    </div>
    <div class="container">

        <div class="cards">

            <ul class="nav nav-pills cards-pill">
                <li class="licards"><a id="cardlink"> <i class="glyphicon glyphicon-search"></i> </a>
                    <h4>&nbsp;&nbsp;&nbsp;Pesquise</h4>
                    <p>Pesquise os medicamentos que<br> deseja comprar.</p>
                </li>

                <li class="licards"><a id="cardlink"> <i class="glyphicon glyphicon-usd"></i> </a>
                    <h4>&nbsp;&nbsp;&nbsp;Compare</h4>
                    <p>Compare os preços e diga<br> o quanto quer pagar.</p>


                </li>


                <li class="licards-last"><a id="cardlink-last"> <i class="glyphicon glyphicon-piggy-bank"></i> </a>
                    <h4>&nbsp;&nbsp;&nbsp;Economize</h4>
                    <p>Economize muito<br> em suas compras.</p>

                </li>


            </ul>
        </div>

    </div>
    <br>
    <br>

    <div class="banner-top" style="position: relative;">
        <!-- LOMADEE - BEGIN -->
        <script type="text/javascript" language="javascript">
            lmd_source="35752991";
            lmd_si="33857233";
            lmd_pu="22719751";
            lmd_c="BR";
            lmd_wi="728";
            lmd_he="90";
        </script>
        <script src="http://image.lomadee.com/js/ad_lomadee.js" type="text/javascript" language="javascript"></script>
        <!-- LOMADEE - END -->    </div>
    <style>

        .explication {
            margin-top: 15px;
        }

    </style>


    <div class="filtro">
        <div class="inputs-filtro">
            <h5 style="float: left;color: #727272;">Filtrar por:&nbsp;&nbsp;&nbsp;</h5>


            <i style="color: #940f14;" class="glyphicon glyphicon-th-large"></i>
            <select onchange="categoria('<?php echo base_url('');?>',this.value,'1','1','produtoshome','produtos','','');" class="categoria-filtro">
                <option style="display: none;" disabled selected>Categorias</option>
                <?php
                $this->db->from('categorias');
                $this->db->where('tipo',1);
                $this->db->order_by('id','desc');
                $get = $this->db->get();
                $count = $get->num_rows();
                if($count > 0):

                    $result = $get->result_array();
                    foreach ($result as $dds){

                        echo '<option value="'.$dds['id'].'">'.$dds['nome'].'</option>';
                    }

                else:

                    echo '<option value="0" disabled>Nenhuma Categoria</option>';

                endif;

                ?>



            </select>
            &nbsp;&nbsp;&nbsp;
            <i style="color: #940f14;" class="glyphicon glyphicon-th-list"></i>
            <select onchange="categoria('<?php echo base_url('');?>',this.value,'1','1','produtoshome','produtos','','111','0','0');" class="farmaceutica-filtro">
                <option style="display: none;" selected disabled>Ordenar Por</option>

                <option value="a1">Ultimos Adicionados</option>
                <option value="a2">Mais Antigos</option>
                <option value="a3">Mais Buscados</option>
                <option value="a4">Maiores Preços</option>
                <option value="a5">Menores Preços</option>




            </select>
        </div>


        <div class="container explication">

            <div id="Loading">

            </div>

            <script>

                //window.onload = function () {

                    //categoria('<?php echo base_url('');?>','0', '1','0','produtoshome','produtos','','');

                //}

            </script>

            <div id="produtos" style="z-index: 10; position: relative;">

                <?php

                $array = ([
                    "pg1" => "",
                    "tipo" => "0",
                    "keyword" => "produtos",
                    "details" => "1"
                ]);

                $this->load->view('clients/ajax/produtos/home', $array);


                ?>
            </div>

        </div>

    </div>


<div class="container carrosecontent" style="margin-top: 50px;z-index: 0;">

          <div class="row"><br>

              <br>
             <!-- <div class="col-md-12">
                  <h3 style="margin-top: 60px;">Farmácias Anunciantes</h3>

                  <div id="Carousel" class="carousel slide">




                      <div class="carousel-inner" >

                          <?php for($i=0;$i<=4;$i++):?>




                              <div class="item <?php if($i == 0):echo 'active'; endif;?>">
                                  <div class="row">
                                      <?php for($o=0;$o<4;$o++):?>
                                          <div class="col-md-3"><a href="#" class="thumbnail" style="border: none;"><img class="imgCarrossel" src="<?php echo base_url('assets/'.$version.'/img/site/partiner/1.png');?>" alt="Image" style="max-width:100%;"></a></div>
                                      <?php endfor; ?>

                                  </div>
                              </div><

                          <?php endfor; ?>


                      </div>
                      <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                      <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                  </div>

              </div>-->
        </div>
    </div>

<?php $this->load->view('clients/fixed_files/footer'); ?>