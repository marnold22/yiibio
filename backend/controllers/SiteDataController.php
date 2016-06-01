<?php

namespace backend\controllers;

use Yii;
use backend\models\SiteData;
use backend\models\SiteDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * SiteDataController implements the CRUD actions for SiteData model.
 */
class SiteDataController extends Controller
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
     * Lists all SiteData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteData model.
     * @param integer $DID
     * @param integer $PID
     * @return mixed
     */
    public function actionView($DID, $PID)
    {
        return $this->render('view', [
            'model' => $this->findModel($DID, $PID),
        ]);
    }

    /**
     * Creates a new SiteData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can('add-data') )
        {
            $model = new SiteData();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //get instance of uploaded file
                $model->file = UploadedFile::getInstance($model, 'file');

                $loc = 'uploads/' . $model->PID . "-" . $model->file->baseName . '-'. $model->DID . '.' . $model->file->extension;

                //$loc = 'uploads/'. $model->file->baseName . '.' . $model->file->extension;
                if($model->validate()) {
                    $model->file->saveAs($loc);
                }

                $model->Location = $loc;
                if($model->save()) {
                    echo "success";
                }
                else
                    echo "failed to write file name to db.";


                return $this->redirect(['view', 'DID' => $model->DID, 'PID' => $model->PID, 'Location' => $model->Location]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }


    /**
     * Updates an existing SiteData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $DID
     * @param integer $PID
     * @return mixed
     */
    public function actionUpdate($DID, $PID)
    {
        $model = $this->findModel($DID, $PID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'DID' => $model->DID, 'PID' => $model->PID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SiteData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $DID
     * @param integer $PID
     * @return mixed
     */
    public function actionDelete($DID, $PID)
    {
        $this->findModel($DID, $PID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SiteData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $DID
     * @param integer $PID
     * @return SiteData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($DID, $PID)
    {
        if (($model = SiteData::findOne(['DID' => $DID, 'PID' => $PID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
