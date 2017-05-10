<?php $this->load->view('clients/fixed_files/header'); ?>


<script>


logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        $.ajax({
                    url: DIR+"facebookloginapi",
                    data: {fbnewlogs:'true'},
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    beforeSend: function(){ $('.content-loading').html(carregando()); },
                    success: function (data) {

                        if (data > 0) {
                           
                           window.location.reload();

                        } else {

                            $("#errorData").html(data);


                        }

                    $('.content-loading').html(''); 
                    }
                });


        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    },{scope: 'email'});
    return false;
  };
  window.fbAsyncInit = function() {
    FB.init({
      appId: '1870186193247282',
      cookie: true, // This is important, it's not enabled by default
      version: 'v2.2'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));





</script>
<br>
<br>
<section class="log-reg container">
    <div class="container">
        <ul class="breadcrumb-v5">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
            <li class="active" style="color: #940f14;font-weight: 600;">Entrar / Cadastrar</li>
        </ul>
    </div>
    <div class="row">
        <!--Login-->
        <div class="col-lg-5 col-md-5 col-sm-5">
            <h4>Entrar na Minha Conta</h4>
<h4 id="errorData"></h4>



            

            <form method="post" class="login-form" novalidate id="login_form">
                       <a href="javascript:logInWithFacebook();" style="color:white;text-decoration: none;background: #3c60ad;padding: 2%;float:left;width: 100%;text-align: center;font-size: 15pt;"><i class="fa fa-facebook-square"></i> Entrar com o Facebook</a>

<br><br><br>

                <div class="form-group group">
                    <label for="log-email2">E-mail</label>
                    <input style="padding: 5%;" type="email" class="form-control" name="emaillog" id="log-email2"
                           placeholder="Digite seu E-mail" required="">
                    <a class="help-link" href="#">Esqueceu seu E-mail?</a>
                </div>
                <div class="form-group group">
                    <label for="log-password2">Senha</label>
                    <input style="padding: 5%;" type="password" class="form-control" name="passlog" id="log-password2"
                           placeholder="Digite sua Senha" required="">
                    <a class="help-link" href="#">Esqueceu sua Senha?</a>
                </div>

                <b id="errorlog" style="float: right;" class="text-danger"></b><br>
                <input class="btn btn-success" type="submit" value="Entrar">
            </form>
        </div>
        <!--Registration-->
        <div class="col-lg-7 col-md-7 col-sm-7">
            <h4 style="padding: 0 0 0 14.5%;">Cadastre-se</h4>
            <form method="post"  class="registr-form"
                  id="cadastro_form" novalidate="novalidate">
                    <a href="javascript:logInWithFacebook();" style="color:white;text-decoration: none;background: #3c60ad;padding: 2%;float:left;width: 100%;text-align: center;font-size: 15pt;"><i class="fa fa-facebook-square"></i> Cadastre-se com o Facebook</a>
<br><br><br>
                <div class="form-group group">
                    <label for="rf-email">Nome Completo</label>
                    <input style="padding: 4%;" type="text" class="form-control" name="nome" id="rf-nome"
                           placeholder="Informe seu Nome Completo"
                           required="">
                </div>
                <div class="form-group group">
                    <label for="rf-email">Email</label>
                    <input style="padding: 4%;" type="email" class="form-control" name="emailcad" id="rf-email"
                           placeholder="Informe seu E-mail"
                           required="">
                </div> 

        <div class="form-group group">
                    <label for="rf-cpf">CPF</label>
                    <input style="padding: 4%;" type="text" class="form-control" name="cpf" id="rf-cpf"
                           placeholder="Informe seu CPF"
                           required="">
                </div>

                <div class="form-group group">
                    <label for="rf-email">Telefone</label>
                    <input style="padding: 4%;" type="tel" class="form-control" name="telefone" id="telofone"
                           placeholder="(00) 0000-0000" required="">
                </div>
                <div class="form-group group">
                    <label for="rf-password">Senha</label>
                    <input style="padding: 4%;" type="password" class="form-control" name="passcad" id="rf-password"
                           placeholder="*********" required="">
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="termos"  id="terms">

                        Concordo com os <a href="#">Termos e condições</a>.</label><br>
                    <b></b>
                </div>
                <b id="errorcad" style="float: right;" class="text-danger"></b><br>

                <input class="btn btn-success" type="submit" value="Cadastrar">


            </form>
        </div>
    </div>
</section>

<?php $this->load->view('clients/fixed_files/footer'); ?>
