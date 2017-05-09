<div class="tab-v1">

    <ul class="nav nav-justified nav-tabs">
        <li class="active"><a data-toggle="tab" href="#meusprodutostab" onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','meusprodutos','meusprodutostab','<?php echo $_POST['keyword'];?>','','');">Estoque Disponível</a></li>
        <li><a data-toggle="tab" href="#esgotadotab"  onclick="categoria('<?php echo base_url(''); ?>','33', '1','0','meusprodutos','esgotadotab','<?php echo $_POST['keyword'];?>','','');">Estoque Esgotado</a></li>
        <li><a data-toggle="tab" href="#adicionartab" onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','adicionar','adicionartab','<?php echo $_POST['keyword'];?>','','');">Adicionar Produtos</a></li>
    </ul>
    <div class="tab-content">


        <div id="meusprodutostab" class="profile-edit tab-pane fade in active">

        </div>

        <div id="esgotadotab" class="profile-edit tab-pane fade">

        </div>

        <div id="adicionartab" class="profile-edit tab-pane fade">

        </div>
    </div>
</div>

<script>
    categoria('<?php echo base_url(''); ?>','32', '1','0','meusprodutos','meusprodutostab','<?php echo $_POST['keyword'];?>','','');
</script>