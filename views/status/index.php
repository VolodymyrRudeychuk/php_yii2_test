<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Files';
$this->params['breadcrumbs'][] = $this->title;

$searchModel = New \app\models\StatusSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize=5;


?>


<div class="status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?php if(Yii::$app->user->isGuest == false) {
        echo '<p>' . Html::a('Create Status', ['create'], ['class' => 'btn btn-success']) . '</p>';}
        ?>
    </p>
    <?=


    GridView::widget([

        'dataProvider' => $dataProvider,
//       'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Image',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->image_web_filename!='')
                        return '<a href="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'" download="" width="50px" height="auto"><img src="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'" width="50px" height="auto"> '.$model->image_src_filename.'</a>';
                    else return 'no image';
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->created_by!='')
                        return '<a href="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'" >'.$model->created_by.'</a>';
                    else return 'no user';
                },
            ],

            ['class' => 'yii\grid\ActionColumn',

                'template' => '{view} {delete}',

                'buttons' =>[
                    'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'index.php?r=status%2Fview&id='.$model->id, [
                                'title' => Yii::t('yii', 'View'),]);
                        },
                    'delete' =>   function($url, $model) {
                            if ($model->user_id === \Yii::$app->user->identity->id) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>','index.php?r=status%2Fdelete&id='.$model->id, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
            ],

        ],
    ]); ?>
</div>
