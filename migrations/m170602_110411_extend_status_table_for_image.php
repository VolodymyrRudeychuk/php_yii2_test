

<?php

use yii\db\Schema;
use yii\db\Migration;

class m170602_110411_extend_status_table_for_image extends Migration{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $statusTable = Yii::$app->db->schema->getTableSchema('status');


        if($statusTable === null) {
            $this->createTable('status', [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER,
                'created_at' => Schema::TYPE_INTEGER,
                'updated_at' => Schema::TYPE_INTEGER,
                'created_by' => Schema::TYPE_STRING,
                'image_src_filename' => Schema::TYPE_STRING.' NOT NULL',
                'image_web_filename' => Schema::TYPE_STRING.' NOT NULL'
            ]);
        } else {
            $this->addColumn('{{%status}}','image_src_filename',Schema::TYPE_STRING.' NOT NULL');
            $this->addColumn('{{%status}}','image_web_filename',Schema::TYPE_STRING.' NOT NULL');
        }

    }

    public function down()
    {
        $this->dropColumn('{{%status}}','image_src_filename');
        $this->dropColumn('{{%status}}','image_web_filename');
        return false;
    }

}