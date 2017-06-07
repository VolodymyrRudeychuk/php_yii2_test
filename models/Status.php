<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "status".
 *
 * @property string $image_src_filename
 * @property string $image_web_filename
 */
class Status extends \yii\db\ActiveRecord
{


    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['created_by'], 'string'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, jpeg, gif, png'],
            [['image'], 'file', 'maxSize'=>'500000'],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image_src_filename' => Yii::t('app', 'Filename'),
            'image_web_filename' => Yii::t('app', 'Pathname'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),        ];
    }

    public static function primaryKey()
    {
        return ['id'];
    }
}
