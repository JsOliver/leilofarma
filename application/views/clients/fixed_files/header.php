<?php echo $this->head->header(0, $title, $metas, $version, $page); ?>

<body style="margin: 0;padding: 0;width: 100%;height: 100%;">
<script>
var DIR = '<?php echo base_url();?>';
</script>

<script>
    function openmenu() {


        if($("#barsmenu").hasClass("opencloseicon")){
            closemenu();
        }
        else{
            $('.barrs').addClass('opencloseicon');
            $('.closemenu').addClass('openmenu');
            $('.closecloseicon').addClass('opencloseicon');
            $('.opacityhomer').addClass('opacityhomeropen');
            $('.opacityhomer').removeClass('opacityhomer');
            $('.closecloseicon').removeClass('closecloseicon');
            $('.closemenu').removeClass('closemenu');
        }
    }
    function closemenu() {

        $('.opacityhomeropen').addClass('opacityhomer');
        $('.opacityhomeropen').removeClass('opacityhomeropen');
        $('.openmenu').addClass('closemenu');
        $('.openmenu').removeClass('openmenu');
        $('.opencloseicon').addClass('closecloseicon');
        $('.opencloseicon').removeClass('opencloseicon');


    }

</script>
<style>
    .search {
        position: absolute;
        top: 60%;
        left: 33%;
        width: 35%;

    }

    .mobile-navbar{
        display: none;
    }
    .search input {
        resize: none;
        outline: none;
        width: 100%;
        padding: 2%;
        height: 40px;
        border-radius: 20px;
        border: none;
    }

    .search button {
        position: absolute;
        right: 0;
        top: 0;
        padding: 2.6%;
        height: 40px;
        border: 1px solid rgba(0, 0, 0, 0.09);
        border-radius: 0 20px 20px 0;
        background: #f8ff14;
        color: white;

    }

    @media screen and (max-width: 992px){


        .inputs-filtro{

            display:none;
        }
footer{
    display: none;
}
        .desktopdarkred{

            display: none;

        }
        .mobile-navbar{
            display: block;
        }

        .navbardesktop{
            display: none;
        }
        #menusubcate{
            display: none;
        }



        .search {

            display: none;

        }

        .cards{
            display: none;

        }
        .banner-top{

            display: none;

        }

        #iconsins{

            display: none;

        }
        #methods{

            margin: 0px 10px 0 -200px;

        }
    }


    #methods{

        margin: 0px 160px 0 -100px; width: 20%;
    }

    #iconsinsas {
        display: none;
    }


    .mobile-navbar{
        z-index: 1000!important;

        position: fixed;
        float: left;
        width: 100%;
    }
    .barrs{
        cursor: pointer;
        color: white;
        position: absolute;
    }

    .barrs:hover{
        text-decoration: none;
        color: #f8f8f8;
    }

.logomarca a{

    width: 150px;
    float: left;
    height: 50px;
    background-image: url(https://leilofarma.com.br/assets/1/img/site/logo/logo1.png) !important;
    background-repeat: no-repeat;

    top:0;
    z-index: 1 !important;
    padding: 1%;
    position: absolute;
    left: 35%;
    -webkit-background-size: 150px;
    background-size: 150px;;
}

    .mobilenav{
        transform:translateX(-100%);
        left: 0;
        background: #940f14;
        float: left;
        position: fixed;
        top:49px;
        border: none;
        margin: 0;
        padding: 0;
        width: 60%;
        z-index: 1000!important;
        height: 1000px;
    }


.openmenu{

    transform: translateX(0%);
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;

}

    .closemenu {

        transform: translateX(-100%);
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }



    .opencloseicon {

        text-decoration: none;
        color: white;
    }
    .closecloseicon {
        text-decoration: none;
        color: white;
    }

    .opencloseicon:hover {

        text-decoration: none;
        color: white;
    }
    .closecloseicon:hover {
        text-decoration: none;
        color: white;
    }
    .mobilenav .login{

        list-style: none;
        background: #802729;
        margin: 0;
        padding: 5% 5% 5% 0;
        width: 100%;
        float: left;
        text-align: center;
        font-size: 10pt;
    }


    .mobilenav .login li{



        margin: 0 10px 0 0;

    }
    .mobilenav .login li a{

        color: white;
        font-size: 100%;
        padding: 0 10px 0 10px;
    }

    .mobilenav .itens{
    list-style: none;
        padding: 0;
        height: 100%;
    }

    .mobilenav .itens li{
background: white;
        padding: 2%;
    }


</style>



<div class="content-loading"></div>
<nav class="navbar faixa-darkred mobile-navbar">
        <div class="container-fluid">
        <a id="barsmenu" style="text-decoration: none;color: white;" href="javascript:openmenu()" class="barrs fa fa-3x fa-bars"></a>

        <div class="logomarca">
            <a href="<?php echo base_url('');?>"></a>
        </div>
    </div>
    <div class="mobilenav closemenu">
        <ul class="login">
            <?php
            if ($status == false):
            ?>

                <li style="text-align: center;"><a href="<?php echo base_url('entrar'); ?>" style="text-decoration: none;"> <i class="fa fa-user"></i> Entrar/Cadastrar sua conta</a></li>

                <?php else:?>
                
                <li style="text-align: center;"><a href="<?php echo base_url('minha-conta'); ?>" style="text-decoration: none;"> <i class="fa fa-user"></i> Minha Conta</a></li>

            <?php endif;?>
            <?php if(isset($_SESSION['card']) and !empty($_SESSION['card'])):?>
                <br>
                <li style="text-align: center;"><a href="<?php echo base_url('carrinho'); ?>" style="text-decoration: none;"><i class="glyphicon glyphicon-shopping-cart"></i> Meu Carrinho de Produtos</a></li>

            <?php else:?>
                <br>
                <li style="text-align: center;"><a style="text-decoration: none;"><i class="glyphicon glyphicon-list"></i> Criar minha lista de produtos </a></li>

            <?php endif;?>

            <?php
            if ($status == true):
            ?>

                <br>
                <li style="text-align: center;"><a href="<?php echo base_url('UserController/logout'); ?>" style="text-decoration: none;"><i class="fa fa-sign-out"></i> Finalizar Sessão </a></li>
            <?php

            endif;?>





        </ul>
<br>
<br>
        <ul class="itens" style="text-align: center;">

            <li><a href="<?php echo base_url('medicamentos');?>">Medicamentos</a></li>
            <li><a href="<?php echo base_url('generico');?>">Genéricos</a></li>
            <li><a href="<?php echo base_url('dermocosmeticos');?>">Dercosmeticos</a></li>
              <li><a href="<?php echo base_url('higiene');?>">Higiene</a></li>
                <li><a href="<?php echo base_url('perfumaria');?>">Perfumaria</a></li>
                  <li><a href="<?php echo base_url('nutricao');?>">Nutrição</a></li>
                    <li><a href="<?php echo base_url('infantis');?>">Infantis</a></li>
                      <li><a href="<?php echo base_url('saude');?>">Saúde Bucal</a></li>

        </ul>

    </div>

    <form style="position: absolute;margin-top: 65px;padding: 0 2% 0 2%;width: 100%;"  method="get" action="http://127.0.0.1:8080/projects/leilofarma/busca">

                <input style="width:100%;padding:1%;" type="text" name="q" placeholder="Pesquisar pelo nome, fatmacêutica,substancia" value="">
            </form>

</nav>

<nav  style="background: #b01b1f; border: none;border-radius: 0;" class="navbar navbar-default navfarm navbardesktop">

    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(''); ?>">
                <img style="margin: -25px 0 0 0;"
                     src="<?php echo base_url('assets/' . $version . '/img/site/logo/logo1.png'); ?>">
            </a>

            <div style="position:absolute;right: 10%;" class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right" id="linksheader">
                    <li><a href="<?php echo base_url('');?>" class="active">Home</a></li>
                    <li><a href="<?php echo base_url('termos-de-uso');?>">Quem Somos</a></li>
                    <li><a href="mailto:joaovictordada2@gmail.com">Fale conosco</a></li>

                    <div id="iconsinsas" style="position:absolute;right: 10%;top:35%;" class="nav navbar-nav navbar-right">

                        <?php
                        if ($status == false):
                            ?>

                            <li class="dropdown open" style="text-decoration: none;list-style: none; ">
                                <ul  class="dropdown-menu dropdown-menu-top"
                                     style="text-align:center;background:rgba(0, 0, 0, 0.19);z-index: 0; position:relative; border: none;">

                                    <li><a href="<?php echo base_url('entrar'); ?>"
                                           style="text-align:center;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                class="glyphicon glyphicon-user"></i> Olá Visitante,<br> já e cadastrado?</a></li>
                                    <li role="separator" class="divider"></li>
                                    <?php if(isset($_SESSION['card']) and !empty($_SESSION['card'])):?>

                                        <li><a href="<?php echo base_url('carrinho'); ?>"
                                               style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                    style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                    class="glyphicon glyphicon-shopping-cart"></i> Meu Carrinho<br>De Produtos</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo base_url('busca'); ?>"
                                               style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                    style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                    class="glyphicon glyphicon-list"></i> Criar minha lista<br> de produtos</a></li>
                                    <?php endif;?>
                                </ul>
                            </li>

                        <?php else: ?>
                            <li class="dropdown open" style="text-decoration: none;list-style: none; ">
                                <ul  class="dropdown-menu dropdown-menu-top"
                                     style="text-align:center;background:rgba(0, 0, 0, 0.19);z-index: 0; position:relative; width: 20%; border: none;">

                                    <li><a href="<?php echo base_url('minha-conta'); ?>"
                                           style="padding-bottom:5%;text-align:center;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                class="glyphicon glyphicon-user"></i> <span style=" margin: 8% 0 0 8%;float:left ">Minha Conta</span></a>
                                    </li>
                                    <br>

                                    <?php if(isset($_SESSION['card']) and !empty($_SESSION['card'])):?>

                                        <li><a href="<?php echo base_url('carrinho'); ?>"
                                               style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                    style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                    class="glyphicon glyphicon-shopping-cart"></i> Meu Carrinho<br>De Produtos</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo base_url('busca'); ?>"
                                               style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                    style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                                    class="glyphicon glyphicon-list"></i> Criar minha lista<br> de produtos</a></li>
                                    <?php endif;?>

                                    <li><a href="<?php echo base_url('UserController/logout'); ?>"
                                           style="padding-bottom:5%;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                                style="font-size: 15pt;float: left;margin: 0px 0 0 -2px;"
                                                class="fa fa-sign-out"></i> <span style=" margin: 4% 0 0 8%;float:left ">Finalizar Sessão</span></a>
                                    </li>
                                    <br>
                                </ul>
                            </li>

                        <?php endif; ?>

                    </div>

                </ul>

            </div><!-- /.navbar-collapse -->
            <div id="iconsins" style="position:absolute;right: 10%;top:35%;" class="nav navbar-nav navbar-right">

                <?php
                if ($status == false):
                    ?>

                    <li class="dropdown open" style="text-decoration: none;list-style: none; ">
                        <ul  class="dropdown-menu dropdown-menu-top"
                             style="text-align:center;background:rgba(0, 0, 0, 0.19);z-index: 0; position:relative; border: none;">

                            <li><a href="<?php echo base_url('entrar'); ?>"
                                   style="text-align:center;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                        style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                        class="glyphicon glyphicon-user"></i> Olá Visitante,<br> já e cadastrado?</a></li>
                            <li role="separator" class="divider"></li>


                            <?php if(isset($_SESSION['card']) and !empty($_SESSION['card'])):?>

                                <li><a href="<?php echo base_url('carrinho'); ?>"
                                       style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                            style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                            class="glyphicon glyphicon-shopping-cart"></i> Meu Carrinho<br>De Produtos</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url('busca'); ?>"
                                       style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                            style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                            class="glyphicon glyphicon-list"></i> Criar minha lista<br> de produtos</a></li>
                            <?php endif;?>

                        </ul>
                    </li>

                <?php else: ?>
                    <li class="dropdown open" style="text-decoration: none;list-style: none; ">
                        <ul  class="dropdown-menu dropdown-menu-top"
                             style="text-align:center;background:rgba(0, 0, 0, 0.19);z-index: 0; position:relative; width: 20%; border: none;">

                            <li><a href="<?php echo base_url('minha-conta'); ?>"
                                   style="padding-bottom:5%;text-align:center;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                        style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                        class="glyphicon glyphicon-user"></i> <span style=" margin: 8% 0 0 8%;float:left ">Minha Conta</span></a>
                            </li>
                            <br>
                            <li role="separator" class="divider"></li>
                            <!-- <li><a href="<?php echo base_url('carrinho'); ?>"
                               style="padding-bottom:5%;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                    style="font-size: 15pt;float: left;margin: 0px 0 0 -2px;"
                                    class="fa fa-shopping-cart"></i> <span style=" margin: 4% 0 0 8%;float:left ">Meu Carrinho</span></a>
                        </li>-->

                            <?php if(isset($_SESSION['card']) and !empty($_SESSION['card'])):?>

                                <li><a href="<?php echo base_url('carrinho'); ?>"
                                       style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                            style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                            class="glyphicon glyphicon-shopping-cart"></i> Meu Carrinho<br>De Produtos</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url('busca'); ?>"
                                       style="font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                            style="font-size: 15pt;float: left;margin: 6px 0 0 -2px;"
                                            class="glyphicon glyphicon-list"></i> Criar minha lista<br> de produtos</a></li>
                            <?php endif;?>
                            <li><a href="<?php echo base_url('UserController/logout'); ?>"
                                   style="padding-bottom:5%;font-size:9pt;color: white;background: none;text-decoration: none;"><i
                                        style="font-size: 15pt;float: left;margin: 0px 0 0 -2px;"
                                        class="glyphicon glyphicon-log-out"></i> <span style=" margin: 4% 0 0 8%;float:left ">Finalizar Sessão</span></a>
                            </li>
                            <br>
                        </ul>
                    </li>

                <?php endif; ?>

            </div>
            <br>
            <br>
            <br>
            <form class="search"  method="get" action="<?php echo base_url('busca'); ?>">

                <input type="text" name="q" placeholder="Pesquisar pelo nome, fatmacêutica,substancia" value="<?php if (isset($_GET['q'])): echo $_GET['q']; endif; ?>">
                <button type="submit" class="glyphicon glyphicon-search"></button>
            </form>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->




    </div>

</nav>

<nav  id="menusubcate" class="navbar navbar-default"
     style="margin: -20px 0;padding: 0; background: #b01b1f; border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 0px;">
    <div class="">


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=" menufixed" id="bs-example-navbar-collapse-1" style="
       position: absolute;
        z-index: 10000;
         background: #b01b1f;
         float: left;
         width: 100%;
         left: 0;
         padding: 0 0 0 15%;
      ">
            <ul class="nav navbar-nav" style="float: left;">
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;"
                                                                            href="<?php echo base_url('busca/medicamentos')?>">MEDICAMENTOS</a></li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/generico')?>">GENÉRICOS</a>
                </li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/dermocosmeticos')?>">DERMOCOSMÉTICOS</a>
                </li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/higiene')?>">HIGIENE</a>
                </li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;"  href="<?php echo base_url('busca/perfumaria')?>">PERFUMARIA</a></li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/nutricao')?>">NUTRIÇÃO</a>
                </li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/infantis')?>">INFANTIS</a>
                </li>
                <li style="border-right: 1px solid rgba(0, 0, 0, 0.10);"><a style="color: white;" href="<?php echo base_url('busca/saude')?>">SAÚDE
                        BUCAL</a></li>

            </ul>

        </div>
    </div>
</nav>
<?php
if ($page == 'profile' or $page == 'meus-lances' or $page == 'lojaa' or $page == 'itens-salvos' or $page == 'farmacias-salvas' or $page == 'historico' or $page == 'configuracao'):
?>

<div class="container content profile">
    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">

            <?php
            $this->db->from('users');
            $this->db->where('id',$_SESSION['ID']);
            $query = $this->db->get();
            if(empty($query->result_array()[0]['profile_image'])):
                ?>
                <img id="profileimg" class="img-responsive profile-img margin-bottom-20"
                     src="<?php echo base_url('assets/'.$version.'/img/user.png'); ?>"
                     style="height: 250px; object-fit: cover; object-position: center;" alt="">

            <?php else: ?>
                <img id="profileimg" class="img-responsive profile-img margin-bottom-20"
                     src="<?php echo base_url('imagem?tp=2&&im=22&&image=' . $_SESSION['ID']); ?>"
                     style="height: 250px; object-fit: cover; object-position: center;" alt="<?php echo $_SESSION['NAME']?>">
            <?php endif;?>



            <b id="errorData"></b>
            <form enctype="multipart/form-data" method="post">
                <label class="btn-u btn-u-sm" style="cursor: pointer; margin: 0;">Alterar imagem
                    <input style="display: none;" id="fileUpload" name="fileUpload" type="file"/>
                </label>
            </form>

            <br>
            <br>

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item <?php if ($page == 'profile'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('minha-conta'); ?>"><i class="fa fa-bar-chart-o"></i> Resumo</a>
                </li>
                <li class="list-group-item <?php if ($page == 'meus-lances'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('meus-lances'); ?>"><i class="fa fa-gavel"></i> Meus Lances</a>
                </li>
                <!-- <li class="list-group-item <?php if ($page == 'itens-salvos'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('itens-salvos'); ?>"><i class="fa fa-bookmark"></i> Itens Salvos</a>
                </li>
                <li class="list-group-item <?php if ($page == 'farmacias-salvas'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('farmacias-salvas'); ?>"><i class="fa fa-medkit"></i> Farmacias Salvas</a>
                </li>-->

                <li class="list-group-item <?php if ($page == 'historico'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('historico'); ?>"><i class="fa fa-history"></i> Historico</a>
                </li>
                <li class="list-group-item <?php if ($page == 'configuracao'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('configuracoes'); ?>"><i class="fa fa-cog"></i> Configurações</a>
                </li>

                <li class="list-group-item <?php if ($page == 'lojaa'): echo 'active'; endif; ?>">
                    <a href="<?php echo base_url('minha-loja'); ?>"><i class="fa fa-archive"></i> Minha Loja</a>
                </li>
            </ul>


            <!--Notification-->
            <div class="panel-heading-v2 overflow-h">
                <h2 class="heading-xs pull-left"><i class="fa fa-bell-o"></i> Notificações</h2>
            </div>
            <ul class="list-unstyled mCustomScrollbar margin-bottom-20 _mCS_1 mCS-autoHide"
                data-mcs-theme="minimal-dark" style="position: relative; overflow: visible;">
                <div id="mCSB_1" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0">
                    <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                         dir="ltr">

                        <?php

                        $this->db->from('notificacoes');
                        $this->db->where('id_user',$_SESSION['ID']);
                        $this->db->limit(4,0);
                        $this->db->order_by('id_notificacao','desc');
                        $get = $this->db->get();
                        $num = $get->num_rows();
                        if($num > 0):

                            $result = $get->result_array();

                            foreach ($result as $dds)
                            {
                                $this->db->from('lojas');
                                $this->db->where('id_loja',$dds['id_loja']);
                                $get = $this->db->get();
                                $num = $get->num_rows();
                                if($num > 0):
                                    $result = $get->result_array();

                                    if($dds['tpnotific'] == 0 or $dds['tpnotific'] == 1):

                                        $tps = '<span class="text-success">Pedido Aceito.</span>';

                                    elseif($dds['tpnotific'] == 2):

                                        $tps = '<span class="text-danger">Pedido Negado.</span>';

                                    else:
                                        $tps = '<span class="text-success"></span>';


                                    endif;

                                    ?>
                                    <li class="notification">
                                        <a href="<?php echo $dds['url_notificacao']; ?>" target="_blank" style="text-decoration: none;"> <i class="icon-custom icon-sm rounded-x icon-bg-yellow icon-line fa fa-bolt"></i>
                                            <div class="overflow-h">
                                                <span><strong><?php echo $result[0]['nome_loja'];?></strong> <?php echo $tps;?></span>
                                                <small><?php echo $dds['title'];?></small><br>
                                                <small><?php

                                                    $data = $dds['data'];

                                                    $dia = substr($dds['data'],6,2);
                                                    $mes = substr($dds['data'],4,2);
                                                    $ano = substr($dds['data'],0,4);
                                                    $hora = substr($dds['data'],8,2);
                                                    $minuto = substr($dds['data'],10,2);
                                                    $second = substr($dds['data'],12,2);

                                                    echo $dia.'/'.$mes.'/'.$ano.' '.$hora.':'.$minuto.':'.$second;?></small>
                                            </div></a>
                                    </li>
                                <?php  endif; } else: echo '<h5 style="text-align:center;">Nenhuma Notificação</h5>'; endif; ?>
                    </div>
                </div>

            </ul>
            <!--End Notification  <a href="<?php echo base_url('notificacoes'); ?>" type="button"
               class="btn-u btn-u-default btn-u-sm btn-block">Ver Tudo</a>
        -->

            <div class="margin-bottom-50"></div>

        </div>
        <!--End Left Sidebar-->
        <?php

        endif;
        ?>
        <div style="display: none;" id="fellinfo" class="alert alert-danger" role="alert">Erro</div>

