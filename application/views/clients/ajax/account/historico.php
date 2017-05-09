<!--Timeline-->
<ul class="timeline-v2">
    <?php
    $this->db->from('visitados');
    $this->db->join('produtos_disponiveis', 'produtos_disponiveis.id_pdp = visitados.id_item', 'inner');
    $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_pdp', 'inner');
    $this->db->where('visitados.id_user', $_SESSION['ID']);
    $this->db->order_by('visitados.id', 'desc');
    $get = $this->db->get();
    $count1 = $get->num_rows();
    $max = 15;
    $total = ceil($count1 / $max);
    $pagepost = $_POST['page'];
    if (isset($pagepost)):
        if($pagepost <= 1):
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


    $this->db->from('visitados');
    $this->db->join('produtos_disponiveis', 'produtos_disponiveis.id_pdp = visitados.id_item', 'inner');
    $this->db->join('medicamentos', 'medicamentos.id = produtos_disponiveis.id_produto', 'inner');
    $this->db->where('visitados.id_user', $_SESSION['ID']);
    $this->db->order_by('visitados.id', 'desc');
    $this->db->limit($max, $atual);
    $get = $this->db->get();
    $count = $get->num_rows();
    if ($count > 0):
        $result = $get->result_array();
        $arrayreplace = array("(", ")", "-");

        foreach ($result as $dds) {

            $this->db->from('lojas');
            $this->db->where('id_loja',$dds['id_loja']);
            $get = $this->db->get();
            if($get->num_rows() <= 0):

                else:
                    $result = $get->result_array();
            $data = $dds['data_visita'];

            $ano = substr($data,0,4);
            $mes = substr($data,4,2);
            $dia = substr($data,6,2);
            $hora = substr($data,8,2);
            $minuto = substr($data,10,2);
            ?>
            <li>
                <a style="text-decoration: none;" href="<?php echo base_url('produto/' . str_replace(' ', '-', strtolower($result[0]['nome_loja'])) . '/' . str_replace(' ', '-', str_replace($arrayreplace, '', strtolower($dds['nome'])))) . '/' . $dds['id_pdp'];?>" target="_blank">
                <time class="cbp_tmtime" datetime=""><span><?php echo $dia;?>/<?php echo $mes;?>/<?php echo $ano;?></span> <span><?php echo $hora.':'.$minuto;?></span></time>
                <i class="cbp_tmicon rounded-x hidden-xs"></i>
                <div class="cbp_tmlabel">
                    <h2><?php echo $dds['nome_prod'];?></h2>
                    <p><?php echo str_replace('<br>','',$dds['fixa_cal']);?></p>
                </div>
                    </a>
            </li>

        <?php endif; } endif; ?>

</ul>
<?php

if($count1 > $max):

?>
<nav aria-label="Page navigation">
    <ul class="pager">
        <li>
            <a href="javascript:categoria('<?php echo base_url(''); ?>','<?php echo $_POST['tipo'] ?>', '<?php if($atualpg <= 1): echo $atualpg; else: echo $atualpg - 1; endif; ?>','1','historico','<?php echo $_POST['resutblock']; ?>');"
               aria-label="Previous">
                  Anterior
            </a>
        </li>

        <li>
            <a href="javascript:categoria('<?php echo base_url(''); ?>','<?php echo $_POST['tipo'] ?>', '<?php echo $atualpg + 1; ?>','1','historico','<?php echo $_POST['resutblock']; ?>');"
               aria-label="Next">
               Próximo
            </a>
        </li>
    </ul>
</nav>
<?php endif;?>
