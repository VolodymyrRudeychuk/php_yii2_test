<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\StatusAsset;
use kartik\file\FileInput;


StatusAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="status-form">
    <?php
    $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']]); // important
    ?>


    <div class="row">
        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','jpeg','gif','png'],'showUpload' => false,'showRemove' => true,'showCaption' => false, 'dropZoneEnabled' => true, 'actionUpload'
            => false,],
        ]);   ?>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
