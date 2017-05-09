<?php for ($i = 0; $i < 10; $i++): ?>
    <div class="col-sm-6" style="margin-bottom: 10px;">
        <div class="dropdown show pull-right">
            <a class="btn btn-secondary dropdown-toggle" href="#" id="cong" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog "></i>
            </a>

            <div class="dropdown-menu" style="float: left;text-align: left; padding: 30% 0 30% 30%; width: 10px;" aria-labelledby="cong">
                <a class="dropdown-item" href="#">Remover</a><br>
            </div>
        </div>
        <div class="profile-blog">

            <img class="rounded-x" src="http://guiamatasul.com/wp-content/uploads/2015/09/nova-farma1-628x397.jpg" alt="">
            <div class="name-location">
                <strong>Nova Farma</strong>
                <span><i class="fa fa-map-marker"></i><a href="#">São Paulo,</a> <a href="#">SP</a></span>
            </div>
            <div class="clearfix margin-bottom-20"></div>
            <p>Farmacia no Centro de São Paulo.</p>
            <hr>
            <ul class="list-inline share-list">
                <li><i class="fa fa-bell"></i><a href="#">37 Produtos</a></li>
                <li><i class="fa fa-group"></i><a href="#">46 Seguidores</a></li>
                <li><i class="fa fa-gavel"></i><a href="#">577 Lances</a></li>
            </ul>
        </div>
    </div>
<?php endfor; ?>
<nav aria-label="Page navigation">
    <ul class="pager">
        <li>
            <a href="javascript:categoria('<?php echo $_POST['tipo']?>', '1','1','itenssalvos','<?php echo $_POST['resutblock'];?>');" aria-label="Previous">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li><a href="javascript:categoria('<?php echo $_POST['tipo']?>', '1','1','itenssalvos','<?php echo $_POST['resutblock'];?>');">1</a></li>
        <li>
            <a href="javascript:categoria('<?php echo $_POST['tipo']?>', '1','1','itenssalvos','<?php echo $_POST['resutblock'];?>');" aria-label="Next">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</nav>

