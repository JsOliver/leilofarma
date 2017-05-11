<?php

$this->db->select('nome');
$this->db->from('adm_itens');
$this->db->where('id',$action);
$get = $this->db->get();
$result = $get->result_array();

?>
<div class="container-fluid">
<div class="row">
                    <div class="col-lg-12">
                        <h2><?php echo ucwords($result[0]['nome']);?></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Visits</th>
                                        <th>% New Visits</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor: pointer;">
                                        <td>/index.html</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>
                    </div>