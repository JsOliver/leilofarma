<?php

$this->db->select('nome,database');
$this->db->from('adm_itens');
$this->db->where('id',$action);
$get = $this->db->get();
$result = $get->result_array();

$limit = 30;

?>

<script>

function buscar(database){

var keyword = document.getElementById('buscarCampo').value;

$.ajax({
              url: '<?php echo base_url('AjaxControler/requestadm');?>',
              data: {keyword:keyword,method:<?php echo $method;?>,action:<?php echo $action;?>},
              type: 'POST',
              error: function(data){
              alert(data);
               },
              success: function (data) {

               $("#page-wrapper").html(data);
              }

          });



}





</script>

<div class="container-fluid">
<div class="row">



                    <div class="col-lg-12">

                        <h2><?php echo ucwords($result[0]['nome']);?></h2>
                        <div class="table-responsive">
                        <form id="buscar" method="post" action="javascript:buscar('<?php echo $result[0]['database'];?>');">
    
                            <div class="form-group">
                                <label>Buscar <?php echo ucwords($result[0]['nome']);?></label>
                                <input class="form-control" placeholder="Buscar <?php echo ($result[0]['nome']);?>" name="buscar" id="buscarCampo">
                         
<?php if(isset($keyword) and !empty($keyword)):?>
                          <small>Resultado da busca de <?php echo $keyword?></small>
                      <?php endif;?>
                            </div>

</form>
                            <table class="table table-bordered table-hover">
                                <thead>

                                <?php

                                    //Dados de Usuarios
                                    if($result[0]['database'] == 'users'):
                                        $this->db->select('id,firstname,telefone,email,email_contato,endereco');
                                     endif;   
                                     //Dados de Medicamentos

                                        if($result[0]['database'] == 'medicamentos'):
                          $this->db->select('id,nome,marca,fixa_cal,pesquisas,cliques');
                                     endif; 

                                    //Dados de Produtos disponiveis    
                        if($result[0]['database'] == 'produtos_disponiveis'):
            $this->db->select('id_produto,nome_prod,link_produto,preco,id_loja,pesquisas_farma');
                                     endif; 


                                //Dados de Produtos disponiveis    
                        if($result[0]['database'] == 'lojas'):
            $this->db->select('id_loja,nome_loja,email,telefone,rua,cidade,estado,cep');
                                     endif; 

                                    $this->db->from($result[0]['database']);
                                   
                                    $get = $this->db->get();
                                        $counthd = $get->num_rows();

                                     if($counthd > 0):
                                    $resultkeys = $get->result_array();



                                ?>
                                    <tr>
                                    <?php

                                        foreach ($resultkeys[0] as $key => $value) {

                                                echo ' <th>'.ucwords(str_replace('_', ' ', $key)).'</th>';

                                        }
                                         echo '<th>Ações</th>';
                                    ?>
                                       
                                        
                                    </tr>
                                <?php endif;?>
                                </thead>
                                <tbody>
                                  

                                    <?php
                                     if($counthd > 0):

                                        //Selecionar campos de usuarios
                                    if($result[0]['database'] == 'users'):
                                        $this->db->select('id,firstname,telefone,email,email_contato,endereco');
                                     endif;  

                                        //Selecionar campos de medicamentos

                                      if($result[0]['database'] == 'medicamentos'):
                          $this->db->select('id,nome,marca,fixa_cal,pesquisas,cliques');
                                     endif; 

                                     //Selecionar campos Produtos Disponiveis

                                     if($result[0]['database'] == 'produtos_disponiveis'):
            $this->db->select('id_produto,nome_prod,link_produto,preco,id_loja,pesquisas_farma');
                                     endif; 

                                    //Selecionar campos lojas   
                        if($result[0]['database'] == 'lojas'):
            $this->db->select('id_loja,nome_loja,email,telefone,rua,cidade,estado,cep');
                                     endif; 
                                     $this->db->from($result[0]['database']);

                                      if(isset($keyword)):
                                   
                                    //Buscar por usuarios
                                    if($result[0]['database'] == 'users'):
                                    $this->db->like('email',trim($keyword));
                                    $this->db->or_like('email_contato',trim($keyword));
                                    $this->db->or_like('firstname',trim($keyword));
                                    $this->db->or_like('telefone',trim($keyword));
                                    endif;


                                    //Buscar por medicamentos
                                    if($result[0]['database'] == 'medicamentos'):
                                    $this->db->like('nome',trim($keyword));
                                    $this->db->or_like('marca',trim($keyword));
                                    $this->db->or_like('fixa_cal',trim($keyword));
                                    $this->db->or_like('id',trim($keyword));
                                    endif;

                                    //Buscar por Produtos Disponiveis
                                       if($result[0]['database'] == 'produtos_disponiveis'):
                                    $this->db->like('nome_prod',trim($keyword));
                                    $this->db->or_like('link_produto',trim($keyword));
                                    endif;


                                    //Buscar por Produtos Disponiveis
                                       if($result[0]['database'] == 'lojas'):
                                    $this->db->like('nome_loja',trim($keyword));
                                    $this->db->or_like('email',trim($keyword));
                                    $this->db->or_like('cep',trim($keyword));
                                    endif; 

                                    endif;
                                    $this->db->limit($limit,$atual);
                                    $get = $this->db->get();

                                    if($get->num_rows() > 0):
                                    $resultactions = $get->result_array();

                                    ?>
                                       <?php

$i=0;
                                        foreach ($resultactions as $key => $value) {


                                   
                                                echo '<tr id="item'.$i.'" style="cursor: pointer;">';
                                              

                                              //Dados de Usuarios

                                        if($result[0]['database'] == 'users'):
                                            $idmodal = $value['id'];
                                                echo '<td>'.$value['id'].'</td>';
                                                 echo '<td>'.$value['firstname'].'</td>';
                                                 echo '<td>'.$value['telefone'].'</td>';
                                                 echo '<td>'.$value['email'].'</td>';
                                                 echo '<td>'.$value['email_contato'].'</td>';
                                                 echo '<td>'.$value['endereco'].'</td>';
                                        endif;      

                                       //Dados de Medicamentos
                                      if($result[0]['database'] == 'medicamentos'):

                                            $idmodal = $value['id'];


                                                echo '<td>'.$value['id'].'</td>';
                                                 echo '<td>'.$value['nome'].'</td>';
                                                 echo '<td>'.$value['marca'].'</td>';
                                                 echo '<td>'.$value['fixa_cal'].'</td>';
                                                 echo '<td>'.$value['pesquisas'].'</td>';
                                                 echo '<td>'.$value['cliques'].'</td>';
                                        endif;

                                        //Dados Produtos Disponiveis
                                    if($result[0]['database'] == 'produtos_disponiveis'):

                                            $idmodal = $value['id_produto'];

                                                echo '<td>'.$value['id_produto'].'</td>';
                                                 echo '<td>'.$value['nome_prod'].'</td>';
                                                 echo '<td><a href="'.$value['link_produto'].'" target="_blank">'.$value['link_produto'].'</a></td>';
                                                 echo '<td>'.$value['preco'].'</td>';
                                                 echo '<td>'.$value['id_loja'].'</td>';
                                                 echo '<td>'.$value['pesquisas_farma'].'</td>';
                                        endif;






                                        //Dados Produtos lojas
                                    if($result[0]['database'] == 'lojas'):

                                            $idmodal = $value['id_loja'];

                                                echo '<td>'.$value['id_loja'].'</td>';
                                                 echo '<td>'.$value['nome_loja'].'</td>';
                                                 echo '<td><a href="mailto:'.$value['email'].'">'.$value['email'].'</a></td>';
                                                 echo '<td><a href="tel:'.$value['telefone'].'">'.$value['telefone'].'</a></td>';
                                                 echo '<td>'.$value['rua'].'</td>';
                                                 echo '<td>'.$value['cidade'].'</td>';
                                                 echo '<td>'.$value['estado'].'</td>';
                                                 echo '<td>'.$value['cep'].'</td>';
                                        endif;

                                                 echo '<td style="text-align: center;">

                                <a onclick="editar(<?php echo $idmodal;?>);" data-toggle="modal" data-target="#modalabrir'.$i.'" style="text-decoration:none;" title="Editar" class="fa fa-edit"></a>
                                &nbsp;
                                <a data-toggle="modal" data-target="#modalexcluir'.$i.'" style="text-decoration:none;" title="Excluir" class="fa fa-times"></a>

                                                 </td>';
                                                 
                                                echo '</tr>';
                                             

?>


<!-- Modal Editar -->
<div class="modal fade" id="modalabrir<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="textotitle">Editar <?php echo ucwords($result[0]['nome']);?> - <b><?php echo $idmodal;?></b></h4>
      </div>
      <div class="modal-body">
        



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>


<script>
function excluir(bancodedados,id,item){

            $("#modalexcluir"+item+"").modal('hide');


 $.ajax({
              url: '<?php echo base_url('AjaxControler/deleteadmitem');?>',
              data: {bancodedados:bancodedados,id:id},
              type: 'POST',
                    error: function(data){
                    alert(data);
                },
              success: function (data) {

            if(data == 11){


            $("#item"+item+"").remove();


            }else{

            $("#respostaerror"+item+"").html(data);

                }

              }

          });

}
</script>
<!-- Modal Excluir -->
<div class="modal fade" id="modalexcluir<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="textotitle">Excluir <?php echo ucwords($result[0]['nome']);?> - <b><?php echo $idmodal;?></b></h4>
      </div>
      <div class="modal-body">
        <h4>Tem certeza que deseja excluir isso?</h4>
        <h5 id="respostaerror<?php echo $i;?>"></h5>
              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button onclick="excluir('<?php echo $result[0]['database']; ?>',<?php echo $idmodal;?>,<?php echo $i;?>)" type="button" class="btn btn-danger">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<?php

$i++;

                                        }



                                        endif;

                                        endif;
                                    ?>
                                  
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>
                    </div>