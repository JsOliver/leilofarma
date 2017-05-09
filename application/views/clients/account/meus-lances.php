<?php $this->load->view('clients/fixed_files/header'); ?>

<script>


    window.onload = function () {


        <?php if(isset($_GET['pg']) and $_GET['pg'] == 'notificacao'):

        ?>
        categoria('<?php echo base_url('');?>','22', '1','0','meuslances','abertos');


    <?php

         else:
        ?>

        categoria('<?php echo base_url('');?>','21', '1','0','meuslances','todos');

    <?php

        endif;?>

    }

</script>
<div class="col-md-9" xmlns="http://www.w3.org/1999/html">
    <div class="profile-body">

        <div class="profile-body margin-bottom-20">
            <div class="tab-v1">
                <ul class="nav nav-justified nav-tabs">
                    <li <?php if(isset($_GET['pg']) and $_GET['pg'] == 'notificacao'): echo ''; else: echo 'class="active"'; endif;?> ><a data-toggle="tab" href="#todos" aria-expanded="true" onclick="categoria('<?php echo base_url('');?>','21', '1','0','meuslances','todos');">Todos os Lances</a></li>
                    <li <?php if(isset($_GET['pg']) and $_GET['pg'] == 'notificacao'): echo 'class="active"'; else: echo ''; endif;?>><a data-toggle="tab" href="#abertos" onclick="categoria('<?php echo base_url('');?>','22', '1','0','meuslances','abertos');">Lances em Aberto</a></li>
                    <li><a data-toggle="tab" href="#encerrados" onclick="categoria('<?php echo base_url('');?>','23', '1','0','meuslances','encerrados');">Lances Finalizados</a></li>
                </ul>
                <div class="tab-content">
                    <div id="todos" class="profile-edit tab-pane fade <?php if(isset($_GET['pg']) and $_GET['pg'] == 'notificacao'): echo ''; else: echo 'active in'; endif;?> ">



                    </div>


                    <div id="abertos" class="profile-edit tab-pane fade <?php if(isset($_GET['pg']) and $_GET['pg'] == 'notificacao'): echo 'active in'; else: echo ''; endif;?>">

                    </div>

                    <div id="encerrados" class="profile-edit tab-pane fade">

                    </div>


                </div>
            </div>
        </div>
        <!--Timeline-->
        <!--End Timeline-->

    </div>
</div>
</div>
</div>
<?php $this->load->view('clients/fixed_files/footer'); ?>
