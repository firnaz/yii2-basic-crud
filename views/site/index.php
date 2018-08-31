<?php
    $this->title = Yii::$app->name.' | Site';
    $paging = ""; 
    $toPage = "";
    $subtitle = "";
    $list  = $data['list'];
    $message = "";
    $infoPage = "Site data is empty"; 
    if($list){
        $paging = $data['pages'];
        $toPage = (($paging->page + 1) * $paging->limit);
        if( $toPage > $paging->totalCount ) {
          $toPage = $paging->totalCount;
        }
        if(!empty($data['messages'])){
            $message = $data['messages'];
        }
        $infoPage = 'Shows '.($paging->getOffset()+1).' from '.$toPage.' to '.$paging->totalCount;
    }
?>
<section class="content-header">
    <h1>
        Site
        <small>manage site</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= \Yii::$app->request->baseUrl?>"><i class="fa fa-home"></i>home</a></li>
        <li class="active"> Site</li>
    </ol>
</section>
<section class="content">
    <?= $this->render(
        '../layouts/message.php',
        ['messages' => $message]
    )
    ?>
    <div class="box box-warning">
        <div class="box-header with-border form-page-site__action">
            <div class="row no-margin">
                <div class="pull-left">
                    <a href="<?= \yii\helpers\Url::to(['/site/create']) ?>" class="btn btn-block btn-primary">
                      <i class="fa fa-plus"></i>
                      <span class="hidden-480"> Add Site </span>
                    </a>
                </div>
                <form action="<?= \yii\helpers\Url::to(['/site/']) ?>" method="get">
                    <div class="box-tools pull-right">
                        <div class="input-group input-group-sm" style="width: 250px;">
                          <input type="text" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : ''?>" class="form-control js-form-site-search pull-right" placeholder="Search..." />

                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="pull-left">
                <h4 class="no-margin">
                    <small>
                        <?= $infoPage ?>
                    </small>
                </h4>
            </div>
            <table class="table table-hover table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Site Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Author</th>
                    <th class="col-md-3"><span class="action-table__toggler"><i class="fa fa-bars" /></span></th>
                </tr>
                <?php
                    if($list){
                        $paging = $paging;
                        $n = $paging->getOffset() + 1;
                        $active_btn = "";
                        foreach ($data['list'] as $key => $site) {
                            echo "
                                <tr>
                                    <td>$n</td>
                                    <td class='col-md-2'>".$site['site_name']."</td>
                                    <td>".($site['category'] ? $site['category']["category_name"] : "")."</td>
                                    <td>".\yii\helpers\Html::encode($site['description'])."</td>
                                    <td>".\yii\helpers\Html::encode($site['url'])."</td>
                                    <td>".\yii\helpers\Html::encode($site['author'])."</td>
                                    <td>
                                        <a href=".\yii\helpers\Url::to(['/site/edit?id='.$site['id']])."
                                            class='btn btn-sm btn-success'
                                            title='Edit'>
                                              <i class='fa fa-edit'></i>
                                              <span class='action-text'>Edit</span>
                                        </a>
                                        $active_btn
                                        <a href=".\yii\helpers\Url::to(['/site/delete?id='.$site['id']])."
                                            class='btn btn-sm btn-danger'
                                            onclick=\"return confirm('Are you sure want to delete this data ?');\"
                                            title='Delete' >
                                              <i class='fa fa-trash'></i>
                                              <span class='action-text'>Delete</span>
                                        </a>
                                    </td>
                                </tr>";
                            $n++;
                        }
                    }
                ?>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php
                if($list){
                    echo $this->render(
                        '../layouts/pagination.php',
                        [
                            'paging' => $paging,
                            'controller' => 'provinsi',
                            'search' => isset($_GET['q']) ? $_GET['q'] : "",
                        ]
                    );
                }
            ?>
        </div>
    </div>
</section>

