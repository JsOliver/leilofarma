<?php $this->load->view('clients/fixed_files/header'); ?>

<br>


<br>
<br>
<br>
<div class="container s-results margin-bottom-50" >
    <div class="row">
        <div class="col-md-2 hidden-xs related-search">
            <div class="row">
                <div class="col-md-12 col-sm-4">
                    <h3>Relacionados</h3>
                    <ul class="list-unstyled">


                        <?php

                        $this->db->from('produtos_disponiveis');
                        $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_pdp', 'inner');
                        $this->db->where('produtos_disponiveis.visible',1);
                        $this->db->like('medicamentos.nome', $key);
                        $this->db->or_like('medicamentos.nome', ucwords($key));
                        $this->db->or_like('medicamentos.nome', strtoupper($key));
                        $this->db->or_like('medicamentos.nome', ucfirst($key));
                        $this->db->or_like('medicamentos.substancia', ucwords($key));
                        $this->db->or_like('medicamentos.substancia', strtoupper($key));
                        $this->db->or_like('medicamentos.substancia', strtoupper($key));
                        $this->db->or_like('produtos_disponiveis.keywords',$key);
                        $this->db->or_like('produtos_disponiveis.keywords', str_replace(' ', '-', $key));
                        $this->db->order_by('preco','min');
                        $this->db->limit(3,0);
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if($count > 0):
                        $fetch = $get->result_array();
                            $arrayreplace = array("(", ")", "-");

                        foreach ($fetch as $dds){
                            $this->db->from('medicamentos');
                            $this->db->where('id',$dds['id_pdp']);
                            $get =  $this->db->get();
                            $countn =  $get->num_rows();
                            if($countn > 0):
                                $fetchm = $get->result_array();

                                $name = $fetchm[0]['nome'];

                                else:

                                $name = 'Indisponivel';

                            endif;


                            $this->db->from('lojas');
                            $this->db->where('id_loja',$dds['id_loja']);
                            $get =  $this->db->get();
                            $countn =  $get->num_rows();
                            if($countn > 0):
                                $fetchad = $get->result_array();

                                echo '<li title="'.$name.'"><a href="'. base_url('produto/' . str_replace(' ', '-', strtolower($fetchad[0]['nome_loja'])) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($name)))) . '/' . $dds['id_pdp'] .'" target="_blank">'.character_limiter($name,10).'</a></li>';
                                else:

                                    echo '<li><a href="'.base_url('404').'" target="_blank">'.$name.'</a></li>';


                            endif;


                        }

                        else:

                            echo '<li><a onclick="return false;" target="_blank" style="color:#c1c1c1; cursor:not-allowed; text-decoration:none;">Nenhuma Sugestão</a></li>';

                        endif;

                        ?>


                    </ul>
                    <hr>
                </div>

                <div class="col-md-12 col-sm-4">
                    <h3>Mais Buscados</h3>
                    <ul class="list-unstyled">
                        <?php
                        $this->db->from('medicamentos');
                        $this->db->order_by('pesquisas','desc');
                        $this->db->limit(3,0);
                        $get = $this->db->get();
                        $countms = $get->num_rows();
                        if($countms > 0):
                            $fetchms = $get->result_array();

                            foreach ($fetchms as $dds){


                    echo '<li title="'.$dds['nome'].'"><a href="'.base_url('busca?q='.str_replace(' ','+',strtolower($dds['nome']))).'">'.character_limiter($dds['nome'],10).'</a></li>';
                            }
                        else:
                            echo '<li><a onclick="return false;" target="_blank" style="color:#c1c1c1; cursor:not-allowed; text-decoration:none;">Nenhuma Sugestão</a></li>';

                        endif;

                        ?>

                    </ul>
                    <hr>
                </div>

                <div class="col-md-12 col-sm-4">
                    <h3>Indicados</h3>
                    <ul class="list-unstyled">
                        <?php

                        $this->db->from('produtos_disponiveis');
                        $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_pdp', 'inner');
                        $this->db->where('produtos_disponiveis.visible',1);
                        $this->db->like('medicamentos.nome', $key);
                        $this->db->or_like('medicamentos.nome', ucwords($key));
                        $this->db->or_like('medicamentos.nome', strtoupper($key));
                        $this->db->or_like('medicamentos.nome', ucfirst($key));
                        $this->db->or_like('medicamentos.substancia', ucwords($key));
                        $this->db->or_like('medicamentos.substancia', strtoupper($key));
                        $this->db->or_like('medicamentos.substancia', strtoupper($key));
                        $this->db->or_like('produtos_disponiveis.keywords',$key);
                        $this->db->or_like('produtos_disponiveis.keywords', str_replace(' ', '-', $key));
                        $this->db->order_by('produtos_disponiveis.id_pdp','rand()');
                        $this->db->limit(3,0);
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if($count > 0):
                            $fetch = $get->result_array();
                            $arrayreplace = array("(", ")", "-");

                            foreach ($fetch as $dds){
                                $this->db->from('medicamentos');
                                $this->db->where('id',$dds['id_pdp']);
                                $get =  $this->db->get();
                                $countn =  $get->num_rows();
                                if($countn > 0):
                                    $fetchm = $get->result_array();

                                    $name = $fetchm[0]['nome'];

                                else:

                                    $name = 'Indisponivel';

                                endif;


                                $this->db->from('lojas');
                                $this->db->where('id_loja',$dds['id_loja']);
                                $get =  $this->db->get();
                                $countn =  $get->num_rows();
                                if($countn > 0):
                                    $fetchad = $get->result_array();

                                    echo '<li title="'.$name.'"><a href="'. base_url('produto/' . str_replace(' ', '-', strtolower($fetchad[0]['nome_loja'])) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($name)))) . '/' . $dds['id_pdp'] .'" target="_blank">'.character_limiter($name,10).'</a></li>';
                                else:

                                    echo '<li><a href="'.base_url('404').'" target="_blank">'.$name.'</a></li>';


                                endif;


                            }

                        else:

                            echo '<li><a onclick="return false;" target="_blank" style="color:#c1c1c1; cursor:not-allowed; text-decoration:none;">Nenhuma Sugestão</a></li>';

                        endif;

                        ?>
                    </ul>
                    <hr>
                </div>

                <?php if($status == true):?>
                <div class="col-md-12 col-sm-4">
                    <h3>Ultimas Buscas</h3>
                    <ul class="list-unstyled">

                        <?php
                    $this->db->from('buscas');
                    $this->db->where('id_user',$_SESSION['ID']);
                    $this->db->order_by('id','desc');
                    $this->db->limit(4,0);
                    $get = $this->db->get();
                    $counths = $get->num_rows();
                    if($counths > 0):
                        $fetchhs = $get->result_array();

                        foreach ($fetchhs as $dds){
                            $this->db->from('buscas');
                            $this->db->where('keyword',$dds['keyword']);
                            $get = $this->db->get();
                            $countime = $get->num_rows();

                            echo '<li title="'.$dds['keyword'].'"><a href="'.base_url('busca?q='.$dds['keyword']).'">'.character_limiter($dds['keyword'],9).' <b>('.number_format($countime).')</b></a></li>';
                        }
                        else:
                            echo '<li><a onclick="return false;" target="_blank" style="color:#c1c1c1; cursor:not-allowed; text-decoration:none;">Nenhuma Busca</a></li>';
                        endif;

                        ?>
                    </ul>
                    <!-- <a class="see-all" href="#">See all</a> -->
                    <hr>
                </div>

                <?php endif;?>

                <div class="col-md-12 col-sm-4">
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
            </div>
        </div><!--/col-md-2-->

        <div class="col-md-10">
            <span class="results-number"><?php echo number_format($buscasn);  if($buscasn == 1): echo ' relação'; else:  echo ' relações'; endif;?>  ao produto</span>.

            <div class="filtro" style="width: 100%; overflow: hidden;">
                <div class="inputs-filtro" >
                    <h5 style="float: left;color: #727272;">Filtrar por:&nbsp;&nbsp;&nbsp;</h5>


                    <i style="color: #940f14;" class="glyphicon glyphicon-th-large"></i>
                    <select onchange="categoria('<?php echo base_url('');?>',this.value,'1','1','produtoshome','produtos','<?php echo $key;?>','11');" class="categoria-filtro">
                        <option style="display: none;" disabled selected>Categorias</option>
                        <option value="1000" class="text-info">Mais Proximos</option>
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
                    <select onchange="categoria('<?php echo base_url('');?>',this.value,'1','1','produtoshome','produtos','','11','0','0');" class="farmaceutica-filtro">
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

                    <div id="produtos" style="z-index: 10; position: relative;">

                    </div>

                </div>

            </div>
            </div>
            <!-- Begin Inner Results -->
        <br>
        <div class="banner-top" style="position: relative;float: left;">
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
            <div class="margin-bottom-30"></div>


        </div><!--/col-md-10-->
    </div>
</div>

<style>

    .explication {
        margin-top: 15px;
    }

</style>





<div class="container carrosecontent" style="margin-top: 50px;z-index: 0;">

    <div class="row"><br>

        <br>
        <div class="col-md-12">


        </div>
    </div>
</div><!--.container-->

<?php $this->load->view('clients/fixed_files/footer'); ?>
