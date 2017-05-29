<?php

namespace backend\controllers;

use backend\models\Personage;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\User;

/**
 * BtResourceController implements the CRUD actions for BtResource model.
 */
class PersonageController extends BaseController
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

    public function actionView()
    {
        return $this->render('view');
    }

    public function actionUpdateSelf()
    {
        $user_model = \common\models\User::findOne(yii::$app->User->identity->id);

        $model = new Personage();
        $model->username = $user_model->username;

        if ($model->load(Yii::$app->request->post())) {

            $user_model->password_hash =  Yii::$app->getSecurity()->generatePasswordHash($model->new_password);

            if ($user_model->save())
            {
                Yii::$app->User->logout();
                $this->redirect(['@web/site/login']);
            }
            else  {
                return $this->render('update-self', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update-self', [
                'model' => $model,
            ]);
        }
    }

    public function actionValidateForm ()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Personage();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }


    /*public function addImage($model)
    {
        $model->image_file = UploadedFile::getInstance($model, 'image_file'); //获得图片

        if (!empty($model->image_file)) {
            $admin_user_model = AdminUsers::findOne(['uid' => yii::$app->adminUser->identity->uid]);
            if ($admin_user_model) {
                $admin_user_model->ima = $model->upload();
            }
            $admin_user_model->save();
        }
    }*/
}
