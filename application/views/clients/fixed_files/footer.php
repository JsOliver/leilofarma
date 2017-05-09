<br>
<br>
<br>
<br>
<br>
<link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

<script>
function carregando() {

        var dado = '<div style="background:#f7f7f7;position: fixed;z-index: 10000000000000000;border:2px solid #5d5d5d;top: 50%;left: 42%;padding: 1%;float: left;"><h2 style="padding:0;margin:0;float: left; ">&nbsp; Carregando...</span></h2></div>';

        return dado;

    }
</script>
<!--footer start from here-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 footerleft ">
                <div class="logofooter"><img style="width: 250px;"
                                             src="<?php echo base_url('assets/' . $version . '/img/site/logo/logo1.png'); ?>">
                </div>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                <!--
                   <p><i class="fa fa-map-pin"></i> 210, Aggarwal Tower, Rohini sec 9, New Delhi -        110085, INDIA</p>
                   <p><i class="fa fa-phone"></i> Phone (India) : +91 9999 878 398</p>
                   <p><i class="fa fa-envelope"></i> E-mail : info@webenlance.com</p> -->

            </div>
            <div class="col-md-2 col-sm-6 paddingtop-bottom">
                <h6 class="heading7">Informações</h6>
                <ul class="footer-ul">
                    <li><a href="#"> Career</a></li>
                    <li><a href="#"> Privacy Policy</a></li>
                    <li><a href="#"> Terms & Conditions</a></li>

                </ul>
            </div>
            <div class="col-md-2 col-sm-6 paddingtop-bottom">
                <h6 class="heading7">Categorias</h6>
                <ul class="footer-ul">
                    <li><a href="#"> Career</a></li>
                    <li><a href="#"> Privacy Policy</a></li>
                    <li><a href="#"> Terms & Conditions</a></li>

                </ul>
            </div>

            <div class="col-md-3 col-sm-6 paddingtop-bottom">
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline"
                     data-height="300" data-small-header="false" style="margin-bottom:15px;"
                     data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/facebook"><a
                                href="https://www.facebook.com/facebook">Facebook</a></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer start from here-->

<div class="copyright">
    <div class="container">
        <div class="col-md-6">
            <p>© 2016 - All Rights with Webenlance</p>
        </div>
        <div class="col-md-6">
            <ul class="bottom_ul">
                <li><a href="#">webenlance.com</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Faq's</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Site Map</a></li>
            </ul>
        </div>
    </div>
</div>
<?php
echo $this->head->js(0, $version, $page);
?>
<?php
if ($page == 'profile' or $page == 'meus-lances' or $page == 'lojaa' or $page == 'itens-salvos' or $page == 'farmacias-salvas' or $page == 'historico' or $page == 'configuracao'):
    ?>
    <script>
        var file = 'fileUpload';
        var url = '<?php echo base_url('AjaxControler/uploadimage');?>';
        var preview = 'profileimg';
    </script>
    <script type="text/javascript" id="ajax-upload">

        $(function () {
            var form;
            $('#' + file + '').change(function (event) {
                form = new FormData();
                form.append(file, event.target.files[0]);
                $("#errorData").html('Carregando...');

                $.ajax({
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {

                        if (data > 0) {
                            $("#" + preview + "").attr("src", "<?php echo base_url('imagem?tp=2&&im=22&&image=' . $_SESSION['ID'] . '');?>");
                            $("#errorData").html('');

                        } else {
                            $("#errorData").html(data);
                        }

                    }
                });
            });


        });
    </script>

<?php endif; ?>


<?php
if ($page == 'lojaa'):
    ?>


    <script type="text/javascript" id="ajax-upload5">

      function uploadXml() {
          var form;
          var file = 'xmlFileUpload';
          form = new FormData();
          form.append(file, event.target.files[0]);
          $("#errorDataXml").html('Carregando...');

          $.ajax({
              url: '<?php echo base_url('AjaxControler/uploadXML');?>',
              data: form,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function (data) {
                  alert(data);

                  if (data > 0) {
                      $("#errorDataXml").html('Produtos Adicionados Com Sucesso.');
                      document.getElementById("xmlFileUpload").value = "";


                  } else {
                      document.getElementById("xmlFileUpload").value = "";
                      $("#errorDataXml").html('Erro Ao Enviar o Arquivo XML, Tente Novamente');
                  }
              }

          });
      }

    </script>



    <script>
        var filel = 'fileUploadLoja';
        var urll = '<?php echo base_url('AjaxControler/uploadimageLoja');?>';
        var previewl = 'profileimgLoja';
    </script>
    <script type="text/javascript" id="ajax-upload">

        $(function () {
            var form;
            $('#' + filel + '').change(function (event) {
                form = new FormData();
                form.append(filel, event.target.files[0]);
                $("#errorDataLoja").html('Carregando...');

                $.ajax({
                    url: urll,
                    data: form,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {

                        if (data > 0) {
                            $("#" + previewl + "").attr("src", "<?php echo base_url('imagem?tp=4&&im=44&&image=' . $_SESSION['ID'] . '');?>");
                            $("#errorDataLoja").html('');

                        } else {
                            $("#errorDataLoja").html(data);
                        }

                    }
                });
            });

        });
    </script>
<?php endif; ?>

<?php
if($page == 'meus-lances'):
?>
<script>
    function cancelpedido(pedido,tipo,action) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('actionpedido');?>",
            data: {pedido: pedido, action: action},
            success: function (result) {
                
                if(result == 11){
                    $("#pedidoslnt"+pedido+""+tipo+"").remove();
                }
            },
            error: function (result) {

                alert("Ocorreu um erro, tente mais tarde");
            }
        });

    }
</script>
<?php
endif;
?>

<?php if ($page == 'logcad'): ?>
    <script>
        var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#telofone').mask(SPMaskBehavior, spOptions);
    </script>

<?php endif; ?>

<?php if ($page == 'busca'):

    if (isset($_GET['c'])):
        $categoria = $_GET['c'];

    else:


        $categoria = '0';

    endif;
    ?>
    <script>

        window.onload = function () {

            categoria('<?php echo base_url('');?>',<?php echo $categ;?>, '1', '1', 'produtoshome', 'produtos', '<?php echo $key;?>', '11');

        }

    </script>
<?php endif; ?>

<?php if ($page == 'produtos'): ?>
    <script>
        $('#moneys').mask('000.000.000.000.000,00', {reverse: true});
        $('#moneyscard').mask('000.000.000.000.000,00', {reverse: true});


        var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '00000-0000' : '0000-00009';
            },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#telefonenl').mask(SPMaskBehavior, spOptions);
        $('#dddnl').mask('(00)');

    </script>
<?php endif; ?>
<script>
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll > 200) {
            $('.menufixed').css('position', 'fixed');
            $('.menufixed').css('top', '0');

        } else {
            $('.menufixed').css('position', 'absolute');
            $('.menufixed').css('margin-top', '0');

        }
    });
</script>
<script>
    jQuery(document).ready(function () {
        App.init();
        App.initScrollBar();
        OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
        MasterSliderShowcase2.initMasterSliderShowcase2();
    });
</script>
<?php if ($page == 'produtos'): ?>
    <script>
        function lance(loja, codigo, produto) {

            <?php
            if($status == true):
            ?>
            $("#btns").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> AGUARDE</a>');

            var value = $("#moneys").val();
            var quantidade = $("#quantidade").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ajaxlance');?>",
                data: {valor: value, quantidade: quantidade, loja: loja, codigo: codigo, produto: produto},
                success: function (result) {
                    if (result == 11) {
                        $("#lanceresult").html('Proposta Enviada');
                        $("#btns").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> PROPOSTA ENVIADA</a>');
                        $("#LoadingLance").html('');
                    } else {

                        loja = ' \'\ ' + loja + ' \'\ ';
                        codigo = ' \'\ ' + codigo + ' \'\ ';
                        produto = ' \'\ ' + produto + ' \'\ ';
                        $("#lanceresult").html(result);
                        $("#btns").html('<a href="javascript:lance(' + loja + ', ' + codigo + ' , ' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>');
                    }
                },
                error: function (result) {
                    alert('erro');
                    loja = ' \'\ ' + loja + ' \'\ ';
                    codigo = ' \'\ ' + codigo + ' \'\ ';
                    produto = ' \'\ ' + produto + ' \'\ ';
                    $("#lanceresult").html(result);
                    $("#btns").html('<a href="javascript:lance(' + loja + ', ' + codigo + ' , ' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>');
                }
            });

            <?php
            else:
            ?>

            $("#btns").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> AGUARDE</a>');

            var value = $("#moneys").val();
            var quantidade = $("#quantidade").val();
            var email = $("#emailnl").val();
            var nome = $("#nomenl").val();
            var telefone = $("#dddnl").val() + $("#telefonenl").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ajaxlance');?>",
                data: {
                    nome: nome,
                    email: email,
                    telefone: telefone,
                    valor: value,
                    quantidade: quantidade,
                    loja: loja,
                    codigo: codigo,
                    produto: produto
                },
                success: function (result) {
                    if (result == 11) {
                        $("#lanceresult").html('Proposta Enviada');
                        $("#btns").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> PROPOSTA ENVIADA</a>');
                        $("#LoadingLance").html('');
                    } else {
                        $("#lanceresult").html(result);
                        $("#btns").html('<a href="javascript:lance(' + loja + ',' + codigo + ',' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>');
                        $("#LoadingLance").html('');
                    }

                },
                error: function (result) {
                    alert(result);

                    loja = ' \'\ ' + loja + ' \'\ ';
                    codigo = ' \'\ ' + codigo + ' \'\ ';
                    produto = ' \'\ ' + produto + ' \'\ ';
                    $("#lanceresult").html(result);
                    $("#btns").html('<a href="javascript:lance(' + loja + ', ' + codigo + ' , ' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> DAR LANCE</a>');
                }
            });

            <?php endif;?>


        }
    </script>
<?php endif; ?>




<?php if ($page == 'produtos'): ?>
    <script>
        function addcard(loja, codigo, produto) {

            $("#btnscr").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> AGUARDE</a>');

            var value = $("#moneyscard").val();
            var quantidade = $("#quantidadecard").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ajaxcard');?>",
                data: {valor: value, quantidade: quantidade, loja: loja, codigo: codigo, produto: produto},
                success: function (result) {
                    loja = ' \'\ ' + loja + ' \'\ ';
                    codigo = ' \'\ ' + codigo + ' \'\ ';
                    produto = ' \'\ ' + produto + ' \'\ ';
                    if (result == 11) {
                        $("#lanceresultcr").html('Proposta Enviada');
                        $("#btnscr").html('<a class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> Adicionado</a>');
                        $("#LoadingLance").html('');
                    } else {

                        $("#lanceresultcr").html(result);
                        $("#btnscr").html('<a href="javascript:addcard(' + loja + ', ' + codigo + ' , ' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> Adicionar ao Carrinho</a>');
                        $("#LoadingLance").html('');
                    }
                },
                error: function (result) {
                    alert('erro');
                    loja = ' \'\ ' + loja + ' \'\ ';
                    codigo = ' \'\ ' + codigo + ' \'\ ';
                    produto = ' \'\ ' + produto + ' \'\ ';

                    $("#lanceresultcr").html(result);
                    $("#btnscr").html('<a href="javascript:addcard(' + loja + ', ' + codigo + ' , ' + produto + ');" class="btn" style="background:#ae1b21;color: white; width:40%; margin: 0 0 0 2%;border-radius: 5px;padding: 2.1% 1% 2.1% 1%;font-weight: 600;"><i class="fa fa-gavel" aria-hidden="true"></i> Adicionar ao Carrinho</a>');
                }
            });


        }
    </script>
<?php endif; ?>

<?php
if ($page == 'carrinho'):
    ?>
    <script>


    </script>

<?php endif; ?>



<?php
if ($page == 'configuracao'):
    ?>
    <script>


        $('#telalter').mask('000.000.000.000.000,00', {reverse: true});

    </script>
    <script>

        function alterardados(base) {

            $("#resultcogs").html('<i style="text-align: center;" class="fa fa-spinner fa fa-spin fa fa-large"></i>');
            var email = $("#emailcog").val();
            var senhaat = $("#senhaatlcog").val();
            var senhan = $("#senhancog").val();
            var senhanr = $("#senhanrcog").val();


            $.ajax({
                type: "POST",
                url: base + 'ajaxalterdata',
                data: {email: email, senha: senhaat, nsenha: senhan, rnsenha: senhanr},
                success: function (result) {
                    $("#resultcogs").html(result);
                    $("#Loading").html('');

                },
                error: function (result) {
                    alert('erro');

                }
            });

        }

    </script>


    <script>

        function newftn(valor, id) {
            if (id == 0) {

                var idcomun = 'nomest';
                var idcomunresp = 'firstnameresp';
            }

            if (id == 1) {

                var idcomun = 'lastname';
                var idcomunresp = 'lastnameesp';
            }

            if (id == 2) {

                var idcomun = 'telefone';
                var idcomunresp = 'telefoneresp';
            }
            if (id == 3) {

                var idcomun = 'endereco';
                var idcomunresp = 'enderecoresp';
            }

            $("#" + idcomun + "").text(valor);
            $.post("<?php echo base_url('ajaxalterdataus');?>", {
                type: id,
                valor: valor
            }, function (res) {
                if (res) {
                    if (res == 1) {
                        $("#" + idcomunresp + "").html('<span class="text-success">Dados alterados com sucesso.</span>');
                    } else {

                        $("#" + idcomunresp + "").html('<span class="text-danger">Erro ao salvar os dados.</span>');

                    }
                } else {
                    $("#" + idcomunresp + "").html('<span class="text-danger">Ocorreu um erro, tente mais tarde.</span>');
                }
            });
        }

        function altername() {
            $("#nomest").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,0);return false;}" />')
        }

        function alterlastname() {
            $("#lastname").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,1);return false;}" />')
        }

        function altertelefone() {
            $("#telefone").html('<input id="telalter" type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,2);return false;}" />')
        }

        function alterendereco() {
            $("#endereco").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,3);return false;}" />')
        }

        function alterenderecoce() {
            $("#cidade").html('<input placeholder="Cidade" type="text"  onkeypress="alert(this.value);" />')
        }

        function reloadPull() {

            $.post("<?php echo base_url('pages/updateServer');?>", {id: 0}, function (res) {
                if (res) {
                    $("#idCupon").text(res);

                }

            });
        }
    </script>


<?php endif; ?>

<?php

if ($status == true):
    $this->db->from('users');
    $this->db->where('id', $_SESSION['ID']);
    $get = $this->db->get();
    if ($get->num_rows() > 0):

        $result = $get->result_array();
        $address = $result[0]['address'];
        $pais = $result[0]['pais'];
        $cidade = $result[0]['cidade'];
        $estado = $result[0]['estado'];
        $lat = $result[0]['lat'];
        $long = $result[0]['long'];

        if (empty($address) or empty($address) or empty($address) or empty($address) or empty($address) or empty($address)):

            ?>
            <script type="text/javascript">
                navigator.geolocation.getCurrentPosition(success, error);

                function success(position) {

                    var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';

                    $.getJSON(GEOCODING).done(function (location) {


                        var country = location.results[0].address_components[5].long_name;
                        var state = location.results[0].address_components[4].long_name;
                        var city = location.results[0].address_components[2].long_name;
                        var address = location.results[0].formatted_address;
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url('ajaxmapsapi');?>',
                            data: {
                                country: country,
                                state: state,
                                city: city,
                                address: address,
                                latitude: latitude,
                                longitude: longitude
                            },
                            success: function (result) {

                            },
                            error: function (result) {

                            }
                        });
                    })

                }

                function error(err) {
                    console.log(err)
                }
            </script>

            <?php

        endif;
    endif;
endif;
?>


<?php
if ($page == 'lojaa'):
    ?>

    <script>

        function removelista(id,tipo){
            $("#infolance"+id+""+tipo+"").modal('hide');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('removelistaped');?>",
                data: {pedido: id},
                success: function (result) {

                    $("#itemlist"+id+""+tipo+"").remove();
                },
                error: function (result) {

                    alert("Ocorreu um erro, tente mais tarde");
                }
            });
        }

    </script>
    <script>


        $('#teleph').mask('(00) 0000-00000');
        $('#nlcep').mask('00000-000');

    </script>
<?php endif; ?>
<?php
if ($page == 'lojaa'):
    ?>
    <script type="text/javascript">
        navigator.geolocation.getCurrentPosition(success, error);

        function success(position) {

            var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';

            $.getJSON(GEOCODING).done(function (location) {


                var cep = location.results[0].address_components[6].long_name;
                var country = location.results[0].address_components[5].long_name;
                var state = location.results[0].address_components[4].long_name;
                var city = location.results[0].address_components[2].long_name;
                var address = location.results[0].formatted_address;


                $("#nlcep").val(cep);
                $("#nlpais").val(country);
                $("#nestado").val(state);
                $("#necidade").val(city);
                $("#neendereco").val(address);
            })

        }

        function error(err) {
            console.log(err)
        }


    </script>

    <script>

        function newFarma() {
            $("#resposta").html('<i style="text-align: center;" class="fa fa-spinner fa fa-spin fa fa-large"></i>');

            var pais = $("#nlpais").val();
            var estado = $("#nestado").val();
            var cidade = $("#necidade").val();
            var endereco = $("#neendereco").val();
            var emailcn = $("#emailcon").val();
            var telefone = $("#teleph").val();
            var nome = $("#nomefarma").val();
            var cep = $("#nlcep").val();


            $.ajax({
                type: "POST",
                url: '<?php echo base_url('ajaxnewfarma');?>',
                data: {
                    cep: cep,
                    pais: pais,
                    estado: estado,
                    cidade: cidade,
                    endereco: endereco,
                    emailcn: emailcn,
                    telefone: telefone,
                    nome: nome
                },
                success: function (result) {
                    alert(result);
                    if (result == 11) {
                        window.location.reload();
                    } else {
                        $("#resposta").html(result);

                    }

                },
                error: function (result) {
                    window.location.reload();


                }
            });

            return false;
        }
        function removeItemLoja(base,item,tipo) {
            $.ajax({
                type: "POST",
                url: "" + base + "ajaxremoveItem",
                data: {item: item},
                success: function (result) {

                    if(result == 11){

                        $('#deletar'+item+''+tipo+'').modal('hide');
                        $('#itemall'+item+''+tipo+'').remove();

                    }else{

                        alert(result);
                    }
                },
                error: function (result) {
                    alert('erro');

                }
            });

        }
    </script>
<?php endif; ?>

<?php
if ($page == 'lojaa'):
    ?>
<script>
    function deleteStore() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('');?>ajaxdeletestore",
            data: {bas:'a'},
            success: function (result) {

                if(result == 11){

                    $('#deleteloja').modal('hide');

                    window.location.reload();


                }else{

                    alert(result);

                }

            },
            error: function (result) {
                alert('Erro');

            }
        });
    }
    function addProds() {
        
    }
    
    </script>
    <script>

        function lanceResposta(base,resposta,id,tipo,button) {

            $("#"+button+""+id+""+tipo+"").html('<i class="fa fa-spinner fa fa-spin fa fa-large"></i>');
            $.ajax({
                type: "POST",
                url: "" + base + "ajaxrespostaitem",
                data: {resposta: resposta,produto:id},
                success: function (result) {

                   if(result == 11){

                       $('#infolance'+id+''+tipo+'').modal('hide');
                       $('#respfooter'+id+''+tipo+'').remove();
                       $("#"+button+""+id+""+tipo+"").html('Concluido');


                   }else{

                       alert(result);

                   }

                },
                error: function (result) {
                    alert('Erro');

                }
            });

        }


        </script>


    <script>

        function FunctionreadFtn(base,id) {

            $.post("" + base + "ajaxalteritemread",{identidade:id},function (res) { });

        }


        </script>
    <script>
        $('#prizeproduto').mask('000.000.000.000.000,00', {reverse: true});
    </script>

    <script>
        function alterdataitem(base, id,tipo) {



            var nome = $("#nomeprodutoAlt" + id + ""+tipo+"").val();
            var keywords = $("#keywordprodutoAlt" + id + ""+tipo+"").val();
            var preco = $("#prizeprodutoAlt" + id + ""+tipo+"").val();
            var desconto = $("#descontoprodutoAlt" + id + ""+tipo+"").val();
            var unidade = $("#unidadeprodutoAlt" + id + ""+tipo+"").val();
            var categoria = $("#categoriaprodutoAlt" + id + ""+tipo+"").val();


            $.ajax({
                type: "POST",
                url: "" + base + "ajaxalteritem",
                data: {nome: nome, keywords: keywords,categoria:categoria, preco: preco, desconto: desconto, unidade: unidade,produtoid:id},
                success: function (result) {

                    if(result == 11){

                        $('#editar'+id+''+tipo+'').modal('hide');
                    }else{

                        alert(result);
                    }
                },
                error: function (result) {
                    alert('erro');

                }
            });
        }
    </script>

    <script type="text/javascript">

        function mostrarResultado(id,tipo, box, num_max, campospan) {
            var contagem_carac = box.length;

            if (contagem_carac != 0) {
                document.getElementById(campospan).innerHTML = contagem_carac + " caracteres digitados";
                if (contagem_carac == 1) {
                    document.getElementById(campospan).innerHTML = contagem_carac + " caracter digitado";
                }
                if (contagem_carac >= num_max) {
                    document.getElementById(campospan).innerHTML = "Limite de caracteres excedido!";
                }
            } else {
                document.getElementById(campospan).innerHTML = "Ainda não temos nada digitado..";
            }
        }
        function contarCaracteres(id,box, valor, campospan) {
            var conta = valor - box.length;
            document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + " caracteres";
            if (box.length >= valor) {
                document.getElementById(campospan).innerHTML = "Opss.. você não pode mais digitar..";
                document.getElementById("" + id+ "campo").value = document.getElementById("" + id+ "campo").value.substr(0, valor);
            }
        }
    </script>
<?php endif; ?>
</body>
</html>