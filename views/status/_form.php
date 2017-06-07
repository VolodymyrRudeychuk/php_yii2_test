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


        <?php

        // Usage with ActiveForm and model
//        //change here: need to add image_path attribute from another table and add square bracket after image_path[] for multiple file upload.
//        echo $form->field($productImages, 'image_path[]')->widget(FileInput::classname(), [
//            'options' => ['multiple' => true, 'accept' => 'image/*'],
//            'pluginOptions' => [
//                'previewFileType' => 'image',
//                //change here: below line is added just to hide upload button. Its up to you to add this code or not.
//                'showUpload' => false
//            ],
//        ]);
//        ?>

        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['enctype' => 'multipart/form-data'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => true,
            'uploadAsync' => true,
            'overwriteInitial' => false,
            'layoutTemplates'=>
                ['footer'=> '<div class="file-thumbnail-footer"><br style="margin:10px 0">'. $form->field($model,  'image_src_filename',   [
                        'inputOptions' => [
                            'placeholder' => "{caption}",
                            'value' =>  $image_web_filename = '{caption}' ,
                            'class'=>"kv-input kv-new form-control input-sm text-center"
                        ]
                    ]).
         '<br/></div><br/>{size}</div>'],
            'previewThumbTags' => [
                '{TAG_VALUE}' => '',
                '{TAG_CSS_NEW}' => '',
                '{TAG_CSS_INIT}' => 'hide',
            ],
            'initialPreviewAsData' => true,

            'initialPreview' => [],
            'initialPreviewConfig' => [],
            'initialPreviewThumbTags' => [],
        ],

    ]);

        Html::submitButton($model->isNewRecord ? 'Create' : ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>


        <?php ActiveForm::end(); ?>



    </div>
</div>

