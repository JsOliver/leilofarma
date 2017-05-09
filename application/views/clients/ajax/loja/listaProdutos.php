
<div class="row">
    <section class="col col-5">
        <label class="select">
            <select name="categos"
                    onchange="categoria('<?php echo base_url(''); ?>','<?php echo $_POST['tipo']?>', '1','0','additenscampo','addPiTENS',this.value,'');">

                <option value="0" disabled selected="" style="display: none;">Escolha a Quantidade</option>
                <option value="1">1 Produto</option>
                <option value="3">3 Produtos</option>
                <option value="5">5 Produtos</option>
                <option value="10">10 Produtos</option>
                <option value="20">20 Produtos</option>
                <option value="50">50 Produtos</option>
                <option value="100">100 Produtos</option>
                <option value="200">200 Produtos</option>
            </select>
            <i></i>
        </label>
    </section>

</div>
<?php
for ($i = 0; $i < $_POST['keyword']; $i++):

    if($_POST['tipo'] == '32'):
    ?>
    <div class="col-md-12" style="margin-bottom: 20px;border-bottom: 10px solid #727272;">
        <div class="row">
            <span style="font-size: 15pt;left: 50%;">Insira os Dados do Seu Produto</span>
<br>
<br>
            <b>Obs:
                <small class="text-info"> Somente os campos marcados com</small> <b class="text-danger">*</b> <small class="text-info">são obrigatorios</small>.</b>
            <br>
            <br>
            <section>

                <b class="text-danger">*</b> Nome do Produto
                <label class="input">

                    <input required type="text" name="nameProd<?php echo $i; ?>" placeholder="Nome Do Produto">
                </label>
            </section>

            <section>
                 Formula do Produto

                <label class="input">
                    <input type="text" name="formProd<?php echo $i; ?>" placeholder="Formula do Produto">
                </label>
            </section>

            <div class="row">
                <section class="col col-11">
                    <b class="text-danger">*</b> Categoria do Produto
                    <label class="select">
                        <select id="categoria<?php echo $i; ?>">
                            <option value="0" disabled selected="" style="display: none;">Categoria do Produto</option>
                            <?php

                            $this->db->from('categorias');
                            $this->db->order_by('id', 'desc');
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            if ($count > 0):

                                $result = $get->result_array();
                                foreach ($result as $dds) {
                                    ?>
                                    <option value="<?php $dds['id'];?>"><?php echo $dds['nome'];?></option>
                                    <?php
                                }

                                     else: ?>
                                         <option value="" disabled="">Nenhuma Categoria Disponivel</option>

                            <?php endif; ?>
                        </select>
                        <i></i>
                    </label>
                </section>

            </div>

            <section>
                <b class="text-danger">*</b> Marca Do Produto / Laboratorio

                <label class="input">
                    <input required type="text" name="marcaProd<?php echo $i; ?>" placeholder="Marca Do Produto">
                </label>
            </section>

            <section>
                 Substância

                <label class="input">
                    <input  type="text" name="substanciaProd<?php echo $i; ?>" placeholder="Substância">
                </label>
            </section>

            <section>
               Miligramas

                <label class="input">
                    <input type="text" name="miligramasProd<?php echo $i; ?>" placeholder="Miligramas">
                </label>
            </section>

            <section>


                <label class="input"> <b class="text-danger">*</b> FixaCal<br>
                    <textarea rows="8" cols="88" name="fixa_calProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>

            <section>


                <label class="input"> Indicações<br>
                    <textarea rows="8" cols="88" name="indicacoeslProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>

            <section>


                <label class="input"> Contra Indicações<br>
                    <textarea rows="8" cols="88" name="contra_indicacoesProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>

            <section>


                <label class="input"> Posologia<br>
                    <textarea rows="8" cols="88" name="posologiaProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>

            <section>


                <label class="input"> Caracteristicas Farmacológicas<br>
                    <textarea rows="8" cols="88" name="caracteristicas_farmacologicasProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>

            <section>


                <label class="input"> Armazenagem<br>
                    <textarea rows="8" cols="88" name="armazenagemProd<?php echo $i; ?>" style="padding: 1%;"></textarea>
                </label>
            </section>
            <b>Obs:
                <small class="text-info"> Somente os campos marcados com</small> <b class="text-danger">*</b> <small class="text-info">são obrigatorios</small>.</b>
            <br>
            <br>
        </div>
    </div>
<?php
else:

        ?>

    <div class="col-md-12" style="margin-bottom: 20px;border-bottom: 1px solid #727272;">
        <div class="row">
            <section>
                <label class="input">
                    <input type="text" name="codProd<?php echo $i; ?>" placeholder="Codigo Do Produto" value="#MD0">
                </label>
            </section>

            <section>
                <label class="input">
                    <input type="number" name="quanProd<?php echo $i; ?>" placeholder="Quantidade do Produto">
                </label>
                <b>Obs:
                    <small class="text-danger">Se Você que Deixar seu Estoque como Unidades
                        Ilimitadas, Basta Deixar esse Campo em Branco</small>.</b>
            </section>

        </div>
    </div>

<?php
endif;

 endfor; ?>
<button type="button" class="btn-u btn-u-default"
        onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','additenscampo','addPiTENS','1','');">Cancelar
</button>
<button class="btn-u" onclick="addProds(<?php echo $i;?>)">Salvar Produtos</button>