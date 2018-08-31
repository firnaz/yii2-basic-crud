<?php 
  $this->title = Yii::$app->name.' | Site';
  $title = "Add Site";
  $action = \yii\helpers\Url::to(['/site/save/']);
  $breadcrumb = "Add Site";
  $hidden = "";
  $message = [];
  if(!empty($data['messages'])){
    $message = $data['messages'];
  }

  $category = $data['category'];

  if(isset($edit)){
    $breadcrumb = "Edit Site";
    $title = "Edit Site";
    $action = \yii\helpers\Url::to(['/site/update/']);
    if($data){
      $hidden = '<input type="hidden" name="id" value="'.$data['data']['id'].'" />';
    }
  }
?>
<section class="content-header">
  <h1>
    Site
    <small>Manage Site</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/site/index"><i class="fa fa-home"></i>Home</a></li>
    <li><a href="<?= \yii\helpers\Url::to(['/site/']) ?>">Site</a></li>
    <li class="active"><?= $breadcrumb?></li>
  </ol>
</section>
<section class="content">
  <div class="box box-warning">
    <div class="box-header with-border">
      <div class="row" style="margin-right: 0px;margin-left: 0px;">
          <div class="pull-left">
            <i class="fa fa-indent"></i>
            <label> <?= $title?> </label>  
          </div>
      </div>
    </div>

    <!-- /.box-header -->
    <?= $this->render(
        '../layouts/message.php',
        ['messages' => $message]
    )
    ?>
    <div class="box-body page-create-site">
      <form class="form-site" action="<?= $action ?>" method="POST">
        <?= $hidden?>
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
        <div class="form-group">
          <label for="site_name">Site Name</label>
          <input type="text" class="form-control input-lg" id="site_name" value="<?= isset($data['data']['site_name']) ? $data['data']['site_name'] : '' ?>" name="site_name" placeholder="Site Name">
        </div>
        <div class="form-group">
          <label for="id_category">Category</label>
          <select class="form-control js-simple-dropdown" id="select-category" aria-hidden="true" name="id_category" style="width:100%">

            <?php
            
              $opt="<option value=''>- Select Category -</option>";

              foreach ($category as $cat) {
                $selected = ($data["data"]["id_category"]==$cat['id']) ? 'selected' : '';
                $opt.="<option value='".$cat['id']."' $selected>".$cat['category_name']."</option>";
              }
              echo $opt;
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control input-lg" rows="3" name="description" placeholder="Description"><?= !empty($data['data']['description']) ? $data['data']['description'] : '' ?></textarea>
        </div>
        <div class="form-group">
          <label for="url">URL</label>
          <input type="text" class="form-control input-lg" id="url" value="<?= isset($data['data']['url']) ? $data['data']['url'] : '' ?>" name="url" placeholder="http://www.example.com">
        </div>
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" class="form-control input-lg" id="author" value="<?= isset($data['data']['author']) ? $data['data']['author'] : '' ?>" name="author" placeholder="Author">
        </div>
        <div class="box-footer">
          <a href="<?= \yii\helpers\Url::to(['/site/']) ?>" type="submit" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
        </div>
      </form>
    </div>
  </div>
</section>

