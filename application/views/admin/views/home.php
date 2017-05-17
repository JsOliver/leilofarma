<?php if ($statusAdmin == false): ?>

    <link href="<?php echo base_url('assets/admin/'); ?>css/bootstrap.min.css" rel="stylesheet">

    <style>
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading, .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .account-wall {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        .need-help {
            margin-top: 10px;
        }

        .new-account {
            display: block;
            margin-top: 10px;
        }
    </style>
    <br>
    <br>
    <br>
    <script>

        function admin() {

            //var form = $( "form" ).serialize();

            var user = $('#user').val();
            var pass = $('#pass').val();

            $.ajax({
                url: '<?php echo base_url('AjaxControler/adminLogin');?>',
                data: {user: user, pass: pass},
                type: 'POST',
                beforeSend: function () {

                    $("#resposta").html('carregando...');

                },
                error: function (data) {

                    $("#resposta").html('');
                    alert(data);
                },
                success: function (data) {


                    if (data == 11) {

                        $("#resposta").html('');
                        window.location.reload();

                    } else {

                        $("#resposta").html(data);

                    }


                }

            });


        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Entre no Painel de Administração</h1>
                <div class="account-wall">
                    <img class="profile-img"
                         src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                         alt="">
                    <form id="form" class="form-signin" action="javascript:admin();" method="POST">
                        <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required
                               autofocus>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Senha" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Entrar
                        </button>

                        <b id="resposta" style="text-align: center;"></b>
                        <!--
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                            Remember me
                        </label>
                        <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>-->
                    </form>
                </div>
                <!--  <a href="#" class="text-center new-account">Create an account </a> -->
            </div>
        </div>
    </div>


    <script src="<?php echo base_url('assets/admin/'); ?>js/jquery.js"></script>

    <script src="<?php echo base_url('assets/admin/'); ?>js/bootstrap.min.js"></script>
<?php else:

    $this->load->view('admin/views/fixed_files/header');

    ?>

    <script>
        window.onload = function () {
            action('1', '1');
        }
    </script>

    <h1>Carregando...</h1>


    <?php

    $this->load->view('admin/views/fixed_files/footer');

endif; ?>




