<?php $this->load->view('clients/fixed_files/header');

$this->db->from('users');
$this->db->where('id',$_SESSION['ID']);
$get = $this->db->get();
$result = $get->result_array();
?>
<link rel="stylesheet" href="https://htmlstream.com/preview/unify-v1.9.8/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="https://htmlstream.com/preview/unify-v1.9.8/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<div class="col-md-9">
    <div class="profile-body margin-bottom-20" id="fsvas">


        <div class="tab-v1">
            <ul class="nav nav-justified nav-tabs">
                <li class="active"><a data-toggle="tab" href="#profile" aria-expanded="true">Editar Perfil</a></li>
                <li class=""><a data-toggle="tab" href="#passwordTab" aria-expanded="false">Mudar Senha</a></li>
            </ul>
            <div class="tab-content">
                <div id="profile" class="profile-edit tab-pane fade active in">
                    <h2 class="heading-md">Altere seu nome, email de contato, telefone e endereço.</h2>
                    <p>
                        Abaixo estão os nomes e endereços de e-mail em arquivo para sua conta.</p>
                    <br>
                    <dl class="dl-horizontal">
                        <dt><strong>Nome </strong></dt>
                        <dd>
                           <span id="nomest"> <?php echo $result[0]['firstname'];?></span>
                            <span>
												<a style="text-decoration: none;" class="pull-right" href="javascript:altername();">
												&nbsp;&nbsp;&nbsp;&nbsp;	<i class="fa fa-pencil"></i>
												</a>
                                <b class="pull-right" id="firstnameresp"></b>
											</span>
                        </dd>
                        <hr>

                        <dt><strong>Email</strong></dt>
                        <dd>
                            <span ><?php echo $result[0]['email'];?></span>

                        </dd>
                        <hr>
                        <dt><strong>Telefone </strong></dt>
                        <dd>
                            <span id="telefone"><?php echo $result[0]['telefone'];?></span>
                            <span>
												<a style="text-decoration: none;" class="pull-right" href="javascript:altertelefone();">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</a>
                                                                <b class="pull-right" id="telefoneresp"></b>

											</span>
                        </dd>
                        <hr>
                        <dt><strong>Email de Contato </strong></dt>
                        <dd>

                            <?php
                            if(empty($result[0]['email_contato'])):

                                echo '<b id="lastname" class="text-info">'.$result[0]['email'].'</b>';
                            else:
                                echo '<b id="lastname" class="text-info">'.$result[0]['email_contato'].'</b>';
                            endif;
                            ?>
                            <span>
												<a style="text-decoration: none;" class="pull-right" href="javascript:alterlastname();">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</a>
                                <b class="pull-right" id="lastnameesp"></b>

											</span>
                        </dd>
                        <hr>
                        <dt><strong>Endereço </strong></dt>
                        <dd>
                            <?php
                            if(empty($result[0]['endereco'])):

                                echo '<b id="endereco" class="text-danger">Informe seu Endereço</b>';
                            else:
                                echo '<b id="endereco">'.$result[0]['endereco'].'</b>';
                            endif;
                            ?>
                            <span>
												<a  style="text-decoration: none;" class="pull-right" href="javascript:alterendereco();">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</a>
                                <b class="pull-right" id="enderecoresp"></b>

											</span>
                        </dd>
                        <hr>
                    </dl>

                </div>

                <div id="passwordTab" class="profile-edit tab-pane fade">
                    <h2 class="heading-md">
                        Gerencie suas configurações de segurança</h2>
                    <p>Mude sua Senha.</p>
                    <br>
                    <form class="sky-form" id="sky-form4" action="#" novalidate="novalidate">
                        <dl class="dl-horizontal">

                            <dt>Email de Acesso</dt>
                            <dd>
                                <section>
                                    <label for="emailcog" class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input id="emailcog" type="email" placeholder="<?php echo $result[0]['email'];?>" name="email">
                                        <b class="tooltip tooltip-bottom-right">É necessário verificar sua conta</b>
                                    </label>
                                </section>
                            </dd>
                            <dt>Entre com sua senha Atual </dt>
                            <dd>
                                <section>
                                    <label for="senhaatlcog" class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" id="senhaatlcog" name="password" placeholder="**********">
                                        <b class="tooltip tooltip-bottom-right">Não Esqueça da Sua Senha</b>
                                    </label>
                                </section>
                            </dd>
                            <dt>Sua Nova Senha</dt>
                            <dd>
                                <section>
                                    <label for="senhancog" class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input id="senhancog" type="password" name="passwordConfirm" placeholder="Nova Senha">
                                        <b class="tooltip tooltip-bottom-right">Informe a Nova Senha</b>
                                    </label>
                                </section>
                            </dd>

                            <dt>Repita sua Nova Senha</dt>
                            <dd>
                                <section>
                                    <label for="senhanrcog" class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input id="senhanrcog" type="password" name="passwordConfirm" placeholder="Repita a Nova Senha">
                                        <b class="tooltip tooltip-bottom-right">Confirme sua Nova Senha</b>
                                    </label>
                                </section>
                            </dd>
                        </dl>

                        <br>
                        <b id="resultcogs"></b>
                        <br>

                        <a href="javascript:alterardados('<?php echo base_url('');?>');" class="btn-u">Salvar Alterações</a>
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>
</div>
</div>
</div>

<?php $this->load->view('clients/fixed_files/footer'); ?>
