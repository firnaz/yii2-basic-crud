<?php
    $p = $paging;
    $controller = $controller;
    $num = $p->page+1;
    $query = [];
    $url = "";

    if(!empty($_GET['q'])){
      $query['q'] = $_GET['q'];
    }

    if(!empty($_GET['status'])){
      $query['status'] = $_GET['status'];
    }

    if($controller){
      $controller=$controller;
    }else{
        $controller =  \yii\helpers\Url::to(['index']);
    }

    if(!empty($_GET['kode_provinsi'])){
      $query['kode_provinsi'] = $_GET['kode_provinsi'];
    }
    if($query){
      $url = '&' . http_build_query($query);
    }else{
        $url = "";
    }
    if($p->pageCount < 2) {
      return "";
    }
?>
<div class="pull-right page-pagination">
    <span class="list-paging"> </span>
    <input type="hidden" name="num" value=<?= $num ?> />
    <input type="hidden" name="page" value= <?= $p->page ?> />
    <input type="hidden" name="controller" value=<?=$controller ?> />
    <input type="hidden" name="pagecount" value=<?= $p->pageCount ?> />
    <input type="hidden" name="query" value="<?= $url ?>" />
</div>
