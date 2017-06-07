<?php

namespace app\controllers;

use Codeception\PHPUnit\ResultPrinter\HTML;
use Yii;
use app\models\Status;
use app\models\StatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\User;
use app\components\AccessRule;
use yii\filters\AccessControl;



/**
 * StatusController implements the CRUD actions for Status model.
 */
class StatusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Status models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Status models.
     * @return mixed
     */
    public function actionMyFiles()
    {
        $searchModel = new StatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('myFiles', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Status model.
     * @param  $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Status model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



    public function actionCreate()
    {
        $model = new Status();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');

            $mysqlNow = \Yii::$app->db->createCommand("SELECT now();")->queryOne();
            $phpMysqlDate = (new \DateTime(end($mysqlNow)));
            if (!is_null($image)) {
                $model->image_src_filename =  $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                $model->created_at = Yii::$app->formatter->asTimestamp($phpMysqlDate->format('Y-m-d H:i:s'), 'php:H:i');
                $model->updated_at = Yii::$app->formatter->asTimestamp($phpMysqlDate->format('Y-m-d H:i:s'), 'php:H:i');
                $model->user_id = \Yii::$app->user->identity->id;
                $model->created_by = \Yii::$app->user->identity->username;
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
                $image->saveAs($path);

            }
            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }  else {
                var_dump ($model->getErrors()); die();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Status model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $mysqlNow = \Yii::$app->db->createCommand("SELECT now();")->queryOne();
        $phpMysqlDate = (new \DateTime(end($mysqlNow)));
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->image_src_filename = $image->name;
            $ext = end((explode(".", $image->name)));
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
            $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
            $model->updated_at = Yii::$app->formatter->asTimestamp($phpMysqlDate->format('Y-m-d H:i:s'), 'php:H:i');


            // generate a unique file name to prevent duplicate filenames
            $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Status model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['status/index']);
    }

    /**
     * Finds the Status model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  $id
     * @return Status the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Status::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
