<?php
$this->db->from('produtos_disponiveis');
$this->db->where('id_loja', $_POST['keyword']);
if ($_POST['tipo'] == '33'):
    $this->db->where('unidades', '0');
endif;
$get = $this->db->get();
$count1 = $get->num_rows();
$max = 10;
$total = ceil($count1 / $max);
$pagepost = $_POST['page'];
if (isset($pagepost)):
    if ($pagepost <= 1):
        $atual = 0;
        $atualpg = 1;
    else:
        $atual = $max * $pagepost - $max;
        $atualpg = $pagepost;

    endif;
else:
    $atual = 0;
    $atualpg = 1;

endif;

$this->db->from('produtos_disponiveis');

$this->db->where('id_loja', $_POST['keyword']);
if ($_POST['tipo'] == '33'):
    $this->db->where('unidades', '0');
endif;
if(!empty($_POST['details'])):
    $this->db->like('keywords', $_POST['details']);
endif;

$this->db->order_by('id_pdp', 'desc');
$this->db->limit($max, $atual);

$get = $this->db->get();
$count = $get->num_rows();
if ($count > 0):

    $result = $get->result_array();
    ?>

    <section>
        <label for="emailcog" class="input">
            <input type="email" id="buscaestoque" size="85" style="padding: 1%;" placeholder="Buscar no Estoque" name="email" value="<?php if(isset($_POST['details'])): echo $_POST['details']; endif;?>">

        </label>            <a style="margin: 0 0 0 3%; " href="javascript:categoria('<?php echo base_url(''); ?>','32', '1','0','meusprodutos','meusprodutostab','<?php echo $_POST['keyword'];?>','',$('#buscaestoque').val());"><i class="icon-append fa fa-search"></i></a>

    </section>
    <div class="table-search-v2">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th class="hidden-sm">Descrição</th>
                    <th>Estoque</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $characteres = array(
                    'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
                    'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
                    'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
                    'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
                    'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
                    'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
                    'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f', ' ' => '_'
                );
                $arrayreplace = array("(", ")", "-");

                foreach ($result as $dds) {

                    $this->db->from('lojas');
                    $this->db->where('id_loja', $dds['id_loja']);
                    $get = $this->db->get();
                    $count = $get->num_rows();

                    if ($count > 0):
                        $result = $get->result_array();

                        $lojaname = $result[0]['nome_loja'];

                        $url = base_url('produto/' . str_replace(' ', '-', strtolower($lojaname) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower(urlencode(strtr($dds['nome_prod'], $characteres))))))) . '/' . $dds['id_pdp'];

                    else:
                        $url = '#';

                    endif;

                    ?>
                    <div>
                        <tr id="itemall<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>">


                            <td>

                                <?php
                                $this->db->from('medicamentos');
                                $this->db->where('id', $dds['id_produto']);
                                $query = $this->db->get();
                                $rest = $query->result_array();
                                if (empty($rest[0]['image_1'])):
                                    ?>
                                    <img class="rounded-x"
                                         src="<?php echo base_url('assets/1/img/empty_prod_pannel.ico'); ?>"
                                         alt="">

                                <?php else: ?>
                                    <img class="rounded-x"
                                         src="<?php echo base_url('imagem?tp=1&&im=1&&image=' . $dds['id_produto'] . '') ?>"
                                         alt="">
                                <?php endif; ?>


                            </td>
                            <td class="td-width">
                                <h3>
                                    <a href="<?php echo $url; ?>"><?php echo $dds['nome_prod']; ?></a>
                                </h3>
                                <p><?php

                                    $this->db->from('medicamentos');
                                    $this->db->where('id', $dds['id_produto']);
                                    $get = $this->db->get();
                                    $count = $get->num_rows();

                                    if ($count > 0):
                                        $result = $get->result_array();
                                        $texto = $result[0]['fixa_cal'];
                                    else:
                                        $texto = 'Descrição Indisponivel';
                                    endif;
                                    echo $texto;

                                    $data = $dds['data_adicionado'];
                                    $dia = substr($data, 8, 2);
                                    $mes = substr($data, 4, 2);
                                    $ano = substr($data, 0, 4);
                                    ?></p>
                                <small class="hex">Adicionado em <?php echo $dia; ?>/<?php echo $mes; ?>
                                    /<?php echo $ano; ?></small>
                            </td>
                            <td>

                                <?php

                                if ($dds['unidades'] == '--' or empty($dds['unidades'])):

                                    echo 'Unidades Ilimitadas';
                                else:

                                    echo '<b>' . $dds['unidades'] . '</b> unidades restantes';

                                endif;

                                ?>

                            </td>

                            <td>

                                <?php

                                if ($dds['visible'] == 1):

                                    echo '<b class="text-success"><i class="fa fa-eye" aria-hidden="true"></i> Disponível </b>
';
                                else:

                                    echo '<b class="text-danger"><i class="fa fa-eye-slash" aria-hidden="true"></i> Invisível </b>
';
                                endif;
                                ?>

                            </td>
                            <td>
                                <ul class="list-inline s-icons" style="text-align: center;">
                                    <li title="Editar">
                                        <a data-toggle="modal"
                                           data-target="#editar<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                           class="tooltips"
                                           data-original-title="Facebook" href="#">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </li>
                                    <li title="Remover">
                                        <a data-toggle="modal"
                                           data-target="#deletar<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                           class="tooltips"
                                           data-original-title="Twitter" href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </li>

                                </ul>

                            </td>
                        </tr>


                        <div class="modal fade bs-example-modal-lg"
                             id="editar<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                             tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="margin-top: 10%;border-radius: 0px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <b><?php echo $dds['nome_prod']; ?></b> - Editar</h4>
                                    </div>
                                    <div class="modal-body" style="padding: 3%;">
                                        <form class="sky-form">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome do Produto</label>
                                                <input type="text" class="form-control"
                                                       id="nomeprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                       placeholder="<?php echo 'Nome do Produto'; ?>"
                                                       value="<?php echo $dds['nome_prod']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Palavras Chaves</label>
                                                <input type="text" maxlength="150" class="form-control"
                                                       id="keywordprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                       placeholder="<?php echo 'Palavras Chaves do Produto'; ?>"
                                                       value="<?php echo $dds['keywords']; ?>"
                                                       onkeyup="mostrarResultado(<?php echo $dds['id_pdp']; ?>,<?php echo $_POST['tipo']; ?>,this.value,150,'spcontando<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>');contarCaracteres(<?php echo $dds['id_pdp']; ?>,this.value,150,'sprestante<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>')">


                                                <span
                                                    id="spcontando<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>">O Maximo de Caracteres e 150 Caracteres</span><br/>
                                                <span
                                                    id="sprestante<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Preço do Produto</label>
                                                <input type="text" class="form-control"
                                                       id="prizeprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                       placeholder="<?php echo 'Preço do Produto'; ?>"
                                                       value="<?php echo $dds['preco']; ?>">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Desconto do Produto
                                                    <small class="text-danger">(Desconto Opcional em
                                                        Porcercentagem)
                                                    </small>
                                                </label>
                                                <input type="number" class="form-control"
                                                       id="descontoprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                       placeholder="<?php echo 'Desconto Opcional em Porcercentagem'; ?>"
                                                       value="<?php echo $dds['desconto']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quantidade no Estoque</label>
                                                <input type="number" class="form-control"
                                                       id="unidadeprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                       placeholder="<?php echo 'Quantidades do Produto'; ?>"
                                                       value="<?php echo $dds['unidades']; ?>">
                                                <b>Obs:
                                                    <small class="text-danger">Se Você que Deixar seu Estoque como
                                                        Unidades
                                                        Ilimitadas, Basta Deixar esse Campo em Branco
                                                    </small>
                                                    .</b>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Categorias</label>
                                                <select
                                                    id="categoriaprodutoAlt<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>">

                                                    <?php

                                                    $this->db->from('categorias');
                                                    $this->db->where('tipo', 1);
                                                    $get = $this->db->get();
                                                    if ($get->num_rows() > 0):

                                                        foreach ($get->result_array() as $dda) {
                                                            ?>
                                                            <option <?php if ($dds['categorias'] == $dda['id']): echo 'selected'; endif; ?>
                                                                value="<?php echo $dda['id']; ?>"><?php echo $dda['nome']; ?></option>

                                                            <?php
                                                        }

                                                    endif; ?>
                                                </select><br>

                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Código do Produto</label>
                                                <b style="font-size: 12pt;">#MD0<?php echo $dds['id_pdp']; ?></b>

                                            </div>
                                            <div class="form-group">


                                                <label for="image1" style="cursor: pointer;">Imagem
                                                    Personalizada
                                                    <br>
                                                    <img style="width:100px; height:100px; "
                                                         src="
                                                                 <?php if (empty($dds['image_1'])):

                                                             if (empty($rest[0]['image_1'])):

                                                                 echo '' . base_url('assets/1/img/empty_prod_pannel.ico') . '';
                                                             else:

                                                                 echo '' . base_url('') . 'imagem?tp=1&&im=1&&image=' . $dds['id_produto'];
                                                             endif;
                                                         else:

                                                             echo '' . base_url('') . 'imagem?tp=5&&im=1&&image=' . $dds['id_pdp'];

                                                         endif;
                                                         ?>


                                                                ">
                                                    <br>
                                                    <input type="file"
                                                           id="image1<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                           name="image1"
                                                           style="display:none;"/>

                                                    <small class="text-danger">(Alterar Imagem 1)</small>
                                                </label>

                                                <label for="image1" style="cursor: pointer;">
                                                    <br>
                                                    <img style="width:100px; height:100px; "
                                                         src="   <?php if (empty($dds['image_2'])):

                                                             if (empty($rest[0]['image_2'])):

                                                                 echo '' . base_url('assets/1/img/empty_prod_pannel.ico') . '';
                                                             else:

                                                                 echo '' . base_url('') . 'imagem?tp=1&&im=2&&image=' . $dds['id_produto'];
                                                             endif;

                                                         else:

                                                             echo '' . base_url('') . 'imagem?tp=5&&im=2&&image=' . $dds['id_pdp'];

                                                         endif;
                                                         ?>">
                                                    <br>
                                                    <input type="file"
                                                           id="image1<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                           name="image1"
                                                           style="display:none;"/>

                                                    <small class="text-danger">(Alterar Imagem 2)</small>
                                                </label>


                                            </div>

                                            <label class="toggle toggle-change"><input
                                                    id="activeitem<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                                                    type="checkbox"
                                                    checked=""
                                                    name="checkbox-toggle-1"><i
                                                    class="no-rounded"></i> Deixar Item Ativo</label>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                                onclick="alterdataitem('<?php echo base_url(''); ?>','<?php echo $dds['id_pdp']; ?>','<?php echo $_POST['tipo']; ?>');">
                                            Salvar
                                            Alterações
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="deletar<?php echo $dds['id_pdp']; ?><?php echo $_POST['tipo']; ?>"
                             tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-top: 10%;border-radius: 0px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Remover Produto do meu Estoque</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Tem certeza que você deseja remover esse produto do seu estoque?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                                        </button>
                                        <button
                                            onclick="removeItemLoja('<?php echo base_url(''); ?>',<?php echo $dds['id_pdp']; ?>,<?php echo $_POST['tipo']; ?>)"
                                            type="button"
                                            class="btn btn-danger">Remover
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
else:

    ?>
    <section>
        <label for="emailcog" class="input">
            <input type="email" id="buscaestoque" size="85" style="padding: 1%;" placeholder="Buscar no Estoque" name="email" value="<?php echo $_POST['details']; ?>">

        </label>            <a style="margin: 0 0 0 3%; " href="javascript:categoria('<?php echo base_url(''); ?>','32', '1','0','meusprodutos','meusprodutostab','<?php echo $_POST['keyword'];?>','',$('#buscaestoque').val());"><i class="icon-append fa fa-search"></i></a>

    </section>
    <h2 style="text-align: center;">Nenhum Resultado</h2>
    <?php

endif; ?>

<?php if ($count1 > $max):

    if ($_POST['tipo'] == '32'):

        $divapper = 'meusprodutostab';

    else:

        $divapper = 'esgotadotab';


    endif;

    ?>
    <nav aria-label="Page navigation">
        <ul class="pager">
            <li>
                <a href="javascript:categoria('<?php echo base_url(''); ?>','<?php echo $_POST['tipo']; ?>', '<?php if ($atualpg <= 1): echo $atualpg;
                else: echo $atualpg - 1; endif; ?>','0','meusprodutos','<?php echo $divapper; ?>','<?php echo $_POST['keyword']; ?>','');"
                   aria-label="Previous">
                    Anterior
                </a>
            </li>


            <li>
                <a href="javascript:categoria('<?php echo base_url(''); ?>','<?php echo $_POST['tipo']; ?>', '<?php echo $atualpg + 1; ?>','0','meusprodutos','<?php echo $divapper; ?>','<?php echo $_POST['keyword']; ?>','');"
                   aria-label="Next">

                    Proximo
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>
