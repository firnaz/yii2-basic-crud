<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class SiteController extends Controller
{
    protected $session;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function init()
    {
        $this->session = Yii::$app->session;
        $this->session->open();
    }


    /**
     * Displays Site List.
     *
     * @return string
     */
    public function actionIndex($id=1)
    {
        $limit = 25;
        $offset = ($id>1)?($id-1)*$limit:0;
        $sort = isset($_GET["sort"])?$_GET["sort"]:"id";
        $order = isset($_GET["order"])?$_GET["order"]:"DESC";
        $p = isset($_GET["p"])?$_GET["p"]:1;
        $d["list"] = [];

        $where = "1=1";

        if(isset($_GET["q"]) && $_GET["q"]){
            $d["q"] = $_GET["q"];
            $where .= " and site_name LIKE :q";
            $query= \app\models\Site::find()->with('category')->where($where)->addParams([':q'=>'%'.strtolower($d["q"]).'%']);
        }else{
            $query = \app\models\Site::find()->where($where);
        }

        $countQuery = clone $query;
        $d["pages"] = new Pagination(['page'=>($p-1), 'defaultPageSize'=>$limit, 'totalCount' => $countQuery->count()]);
        
        $d["list"]= $query->limit($d["pages"]->limit)->offset($d["pages"]->offset)->orderBy("$sort $order")->all();

        if($this->session["messages"]){
            $d["messages"] = $this->session["messages"];
        }
        $this->session->remove("messages");
        $this->session->remove("dataSite");
        return $this->render('index' , ['data' => $d]);
    }

    /**
     * Create action.
     *
     * @return string
     */
    public function actionCreate()
    {
        $d["data"]=null;

        $d["category"] = \app\models\Category::find()->orderBy('category_name asc')->asArray()->all();


        if($this->session["dataSite"]){
            $d["data"] = $this->session["dataSite"];
        }

        if($this->session["messages"]){
            $d["messages"] = $this->session["messages"];
        }
        $this->session->remove("messages");

        return $this->render('create', ['data' => $d]);
    }

    /**
     * Save action.
     *
     * @return string
     */
    public function actionSave()
    {
        $post = Yii::$app->request->post();
        $r = new \app\models\Site;
        $r->load($post, "");
        if($r->save()){
            $this->session["messages"] = ["type"=> "success", "message"=>["success"=>"Site successfully added."]];
            $this->session->remove("dataSite");
            return $this->redirect(['index']);
        }else{
            $this->session["messages"] = ["type"=> "danger", "message"=>$r->getErrors()];
            $this->session["dataSite"] = Yii::$app->request->post();
            return $this->redirect(['create']);
        }
    }

    /**
     * Edit action.
     *
     * @return string
     */
    public function actionEdit($id)
    {

        $d["category"] = \app\models\Category::find()->orderBy('category_name asc')->asArray()->all();

        if($this->session["dataSite"]){
            $d["data"] = $this->session["dataSite"];
        }else{
            $site = new \app\models\Site;
            $d["data"] = $site->findOne($id)->toArray();
        }
        
        if($this->session["messages"]){
            $d["messages"] = $this->session["messages"];
        }
        $this->session->remove("messages");
        return $this->render('create', [
            'data' => $d,
            'edit' => true,
        ]);
    }

     /**
     * Update action.
     *
     * @return string
     */
    public function actionUpdate($p=1)
    {
        $post = \Yii::$app->request->post();
        $id = $post["id"];
        $r = \app\models\Site::findOne($id);
        $r->load($post, "");
        if($r->save()){
            $this->session["messages"] = ["type"=> "success", "message"=>["success"=>"Site successfully updated!"]];
            return $this->redirect(['site/']);
        }else{
            $this->session["messages"] = ["type"=> "danger", "message"=>$r->getErrors()];
            $this->session["dataProvinsi"] = $post;
            return $this->redirect(['create']);
        }
    }

}
