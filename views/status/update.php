<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->title = 'Update Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-update">

    <?php
    if ($model->image_web_filename!='') {
        echo '<br /><p><img height="150" src="'.Yii::$app->homeUrl. '/uploads/'.$model->image_web_filename.'"></p>';
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
