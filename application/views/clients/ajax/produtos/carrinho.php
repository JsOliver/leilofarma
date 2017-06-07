<?php
$this->db->from('produtos_disponiveis');
$this->db->where('id_produto',3);
$get = $this->db->get();
$result = $get->result_array();
?>
<div class="modal-content" style="border-radius:0px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="float: left;color: black;">Adicionar ao Carrinho</h4>
    </div>
    <div class="modal-body">
        <div class="row" style="padding: 2%">
            <div class="col-md-8">
                <h4 style="font-weight: bold;color: black; font-size: 12pt;">Você quer dar
                    um lance para adiquirir este produto? <a style="color: #940f14;"><?php echo $result[0]['nome_prod'];?></a></h4>
                <hr>
                <h5 style="color: black;text-align: left;">Indique a quantidade desejada e o
                    valor de sua proposta</h5>


                <div id="div2" style="text-align: left;">
                    <form>
                        <label style="width: 50%;">
                            <b style="font-size: 15pt;">R$</b>

                            <input
                                style="outline: none;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                size="9" type="text" id="moneyscard"
                                placeholder="<?php if (empty($result[0]['desconto'])):

                                    echo number_format($result[0]['preco'], 2, ',', '.');

                                else:

                                    echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                                endif;

                                ?>

" value="<?php if (empty($result[0]['desconto'])):

                                echo number_format($result[0]['preco'], 2, ',', '.');

                            else:

                                echo number_format($result[0]['preco'] - $result[0]['preco'] / 100 * $result[0]['desconto'], 2, ',', '.');

                            endif;

                            ?>">
                        </label>
                        <label style="width:35%;">
                            <b style="font-size: 12pt;">Qntd.</b>

                            <input
                                style="outline: none;width:70px;border-radius: 5px;padding: 2%; font-size: 12pt; margin-top:-12px;box-shadow: none !important; border: 1px solid #cccccc;"
                                size="2" type="number" id="quantidadecard" placeholder="1" value="1">
                        </label>
                    </form>

                </div>
            </div>
            <div class="col-md-4" style="border: 1px solid #dfdfdf;">
                <a>

                    <?php


                        if(!empty($result[0]['image_1'])):
                            ?>


                            <img style="width: 100%;"
                                 src="<?php echo $result[0]['image_1']; ?>">
                        <?php else:?>


                    <?php endif;?>


                </a>
            </div>

            <span id="btnscr"> <a href="javascript:addcard('<?php echo $result[0]['id_loja'];?>' , '<?php echo '#MD0'.$result[0]['id_produto'].''; ?>' , '<?php echo $result[0]['id_pdp'];?>');" class="btn"
                                  style="background:#ae1b21;color: white; width:30%; float: right; margin: 10px 0 0 1%;border-radius: 5px;padding: 2.1% 0.5% 2.1% 0.5%;font-weight: 600;"><i
                        class="fa fa-card" aria-hidden="true"></i> Add ao Carrinho</a> </span>
            <br>
            <b id="lanceresult"></b>
        </div>

    </div>

</div>