<div id="payment" class="profile-edit tab-pane active">
    <h2 class="heading-md">Adicione seus Produtos Aqui</h2>
    <p>Você Pode Adicionar Enviando um Arquivo <a>XML</a> com os dados do Produto ou se Já Existir o Produto em nosso Estoque Você Pode Adicionar Pelo <a>Codigo do Produto</a>.</p>
    <p><a data-toggle="modal" data-target="#myModal">Clique Aqui</a> Para ver Como Funciona o Envio do Arquivo <a>XML</a>.</p>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Esquema XML</h4>
                </div>
                <div class="modal-body">

                    <h2>Exemplo XML</h2>
<pre>
<?php

$xm = '
<?xml version="1.0" encoding="UTF-8"?>
<info>

<produto>
<nome>Nome do Produto</nome> ""
<formula>Formula do Produto</formula>
<substancia>Substancia do Produto</substancia>
<unidades>Unidades do Produto</unidades>
<categoria>Categoria do Produto</categoria>
<preco>0.00</preco>
<desconto>0</desconto>
<imagem1>http://exemple.com/fotos/exemple1.jpg</imagem1>
<imagem2>http://exemple.com/fotos/exemple1.jpg</imagem2>
<laboratorio>Laboratorio Produto</laboratorio>
<fixacal>Dados de Informção do Produto</fixacal>

<opcional>
<miligramas>Miligramas do Produto</miligramas>
<indicacoes>Indicações do Produto</indicacoes>
<contraIndicacoes>Contra-indicações do Produto</contraIndicacoes>
<posologia>Posologia do Produto</posologia>
<CaracteristicasFarmacologicas>Caracteristicas do Produto</CaracteristicasFarmacologicas>
<armazenagem>Armazenagem do Produto</armazenagem>
</opcional>

</produto>
</info>

';
echo htmlspecialchars($xm);
?>
    </pre>

                    <h2>Informação sobre o XML</h2>
                    <pre>
<?php

$xm = '
<?xml version="1.0" encoding="UTF-8"?>
<info>

<produto>
<nome>Nome do Produto</nome> <b class="text-danger"> =>Nome Do Seu Produto (Obrigatorio)</b>
<formula>Formula do Produto</formula> <b class="text-danger"> =>A formula Do Seu Produto (Obrigatorio)</b>
<substancia>Substância do Produto</substancia> <b class="text-danger"> =>A substância Do Seu Produto (Obrigatorio)</b>
<unidades>Unidades do Produto</unidades> <b class="text-danger"> =>Quantidade do Produto (Se deixar em Branco Assume Quantidade Infinatas do Produto)</b>
<categoria>Categoria do Produto</categoria> <b class="text-danger"> =>A Categoria de Seu Produto de Acordo com o Disponivel no Site (Obrigatorio) EX: Genêrico</b>
<preco>0.00</preco> <b  class="text-danger"> =>O Preço do Seu Produto (Obrigatorio)</b>
<desconto>0</desconto> <b class="text-danger"> =>Desconto no seu Produto (Opcional)</b>
<imagem1>http://exemple.com/fotos/exemple1.jpg</imagem1> <b class="text-danger"> =>Imagem 1 do seu Produto (Obrigatorio)</b>
<imagem2>http://exemple.com/fotos/exemple1.jpg</imagem2> <b class="text-danger"> =>Imagem 1 do seu Produto (Obrigatorio)</b>
<laboratorio>Laboratorio Produto</laboratorio> <b class="text-danger"> =>O laboratorio/Fabricante Do Seu Produto (Obrigatorio)</b>
<fixacal>Dados de Informção do Produto</fixacal> <b class="text-danger"> =>Dados de Informação Sobre o Produto (Obrigatorio)</b>

<opcional>
<miligramas>Miligramas do Produto</miligramas> <b class="text-danger"> => (Opcional)</b>
<indicacoes>Indicações do Produto</indicacoes> <b class="text-danger"> =>Quem pode usar (Opcional)</b>
<contraIndicacoes>Contra-indicações do Produto</contraIndicacoes> <b class="text-danger"> =>Quem não pode usar(Opcional)</b>
<posologia>Posologia do Produto</posologia> <b class="text-danger"> =>Modo de Uso (Opcional)</b>
<CaracteristicasFarmacologicas>Caracteristicas do Produto</CaracteristicasFarmacologicas> <b class="text-danger"> =>Caracteristicas do Produto (Opcional)</b>
<armazenagem>Armazenagem do Produto</armazenagem> <b class="text-danger">=>Como devo guardar e armazenar o Produto.(Opcional)</b>
</opcional>

</produto>
</info>

';
echo $xm;
?>
    </pre>
                </div>

            </div>
        </div>
    </div>
    <br>
    <form class="sky-form" id="sky-form" action="#" novalidate="novalidate">

        <dt>Enviar Arquivo XML</dt>
        <dd>
            <section>
                <label class="input" for="xmlFile">
                    <i class="icon-append fa fa-file-text-o"></i>
                    <input type="file" id="xmlFileUpload" onchange="uploadXml();" placeholder="Enviar XML" name="xmlFileUpload">
                    <b class="tooltip tooltip-bottom-right">Arquivo XML</b>
                </label>
                <b id="errorDataXml"></b>
            </section>
        </dd>
        </form>
    <hr>
    <form class="sky-form" id="sky-form" action="#" novalidate="novalidate">

        <div class="inline-group">
            <label class="radio"><input onclick="categoria('<?php echo base_url(''); ?>','32', '1','0','additenscampo','addPiTENS','1','');" type="radio" name="radio-inline"><i class="rounded-x"></i>Digitar Informações</label>
            <label class="radio"><input onclick="categoria('<?php echo base_url(''); ?>','33', '1','0','additenscampo','addPiTENS','1','');" type="radio" name="radio-inline"><i class="rounded-x"></i>Codigo do Produto</label>
        </div>
<div id="addPiTENS">

    </div>


    </form>
</div>

