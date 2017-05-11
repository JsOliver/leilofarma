<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Painel de Administração">
    <meta name="author" content="CODEX">

    <title>Painel de Administração</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/admin/');?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/admin/');?>css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/admin/');?>css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/admin/');?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script>

function sair(){

     $.ajax({
              url: '<?php echo base_url('AjaxControler/adminLogout');?>',
              type: 'POST',
               
                    error: function(data){

                    alert(data);
                },
              success: function (data) {
                 

                 if(data == 11){

                 window.location.reload();

                 }else{

                        alert(data);

                 }



              }

          });

}


function action(action,method){


 $.ajax({
              url: '<?php echo base_url('AjaxControler/requestadm');?>',
              data: {action:action,method:method},
              type: 'POST',
               
                    error: function(data){

                    alert(data);
                },
              success: function (data) {

                    $("#page-wrapper").html(data);

              }

          });

}
</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('admin');?>">Painel de Administração</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrador <?php echo ucwords($_SESSION['NAME_ADMIN']);?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                     
                        <li>
                            <a href="javascript:action('1','0')"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                        </li>
                        <li>
                            <a href="javascript:action('2','0')"><i class="fa fa-fw fa-gear"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:sair();"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <?php

                $this->db->select('id,nome,tipo,icon');
                $this->db->from('adm_itens');
                $this->db->where('tipo','1');
                $this->db->where('acts','1');
                $this->db->order_by('id','desc');
                $this->db->limit(20,0);
                $get = $this->db->get();

                if($get->num_rows() > 0):

                    $result = $get->result_array();


                    foreach ($result as  $value) {
                     
                 
                ?>
                    <li>
                        <a href="javascript:action('<?php echo $value['id'];?>','<?php echo $value['tipo'];?>');"><i class="<?php echo $value['icon'];?>"></i> <?php echo ucwords($value['nome']);?></a>
                    </li>

                <?php } endif;?>
               
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
         <div id="page-wrapper">