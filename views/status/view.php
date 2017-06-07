<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-view">

    <?php
    if ($model->image_web_filename!='') {
        echo '<br /><p><img height="150" src="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'"></p>';
    }
    ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'image_web_filename',
            'image_src_filename',
            'updated_at:datetime',
            'created_at:datetime',
            [
                'attribute' => 'created_by',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->created_by!='')
                        return '<a href="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'" >'.$model->created_by.'</a>';
                    else return 'no user';
                },
            ],

        ],
    ]) ?>

    <p>

        <?php
            if($model->user_id == \Yii::$app->user->identity->id)
                echo Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            else return 'you have not permission';
        ?>
    </p>



</div>
