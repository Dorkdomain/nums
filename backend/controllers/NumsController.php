<?php

namespace backend\controllers;

use advanved\models\Personage;
use backend\models\Tool;
use Yii;
use app\models\Nums;
use app\models\NumsSeacrh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NumsController implements the CRUD actions for Nums model.
 */
class NumsController extends BaseController
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
     * Lists all Nums models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NumsSeacrh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nums model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Nums model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nums();

        if ($model->load(Yii::$app->request->post())) {
            $model->remainingTime = intval((strtotime($model->dueTime) - time() ) / 86400);
            if ($model->save())
                return $this->redirect(['index']);
            else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Nums model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Nums model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nums model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nums the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $username = 'xxx@qq.com';
        $password = '123456';
        $email = 'xxxy@qq.c';
        $type = '迁移waiply';
        $status = '成功';
        $url = "http://local.www_waiplay/api/cn-bbs";
        $post_data = "username=$username&password=$password&email=$email&type=$type&status=$status";
        $post_data = array('log' => Tool::encrypt($post_data, 'other'));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = strip_tags(curl_exec($ch));

        if (curl_errno($ch))
        {
            var_dump(curl_error($ch));
        }

        curl_close($ch);
        echo '<br>';

        $res = json_decode($output, true);

        var_dump($res);
      //  echo(Tool::decrypt(json_encode($output), 'other'));
        //$result = json_decode($output, true);
     //   var_dump($result);
    }

    public function actionTes()
    {
        try {

            $username = '1456987@qq.com';
            $password = '123456789';
            $email = '1456987@qq.com';
            $type = 'update';

            $url = "http://local.l3admin.com//api/waiplay/register";

            $post_data = "username=$username&password=$password&email=$email&type=$type";
            $post_data = Tool::encrypt($post_data, 'other');

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

            $output = curl_exec($ch);
            curl_close($ch);

            var_dump($output); die;
            $result = json_decode($output);

            var_dump($result);die;

            if (isset($result->code)) {
                $status = $result->code ? (isset($result->result) ? ($result->result) : "失败") : "成功";
            } else {
                $status = "cn无返回值";
            }

            $password = Tool::encrypt($password,'other');
            $_type = 'waiplay迁移cn '.($type == 'update' ? '修改密码' : '注册');
            $this->sendInfoToWaiplay($username, $password, $email, $_type, $status);
            return $status == '成功';
        }
        catch (\Exception $e) {
            var_dump($e->getMessage());
         //   file_put_contents("/tmp/user_to_cn_log.log", $e->getMessage().PHP_EOL, FILE_APPEND);
            return false;
        }
    }

    function sendInfoToWaiplay($username, $password, $email, $type, $status)
    {
        try {
            $url = "http://local.waiplay.com/api/cn-bbs";

            $post_data = "username=$username&password=$password&email=$email&type=$type&status=$status";
            $post_data = Tool::encrypt($post_data, 'other');

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

            $output =strip_tags(curl_exec($ch));
            curl_close($ch);
            $result = json_decode($output, true);
            $_status = $result['res'] == 'yes' ? "成功" : '失败';
            $log_info = $type ." email : $email , time :.". date('Y-m-d H:i:s').', 记录日志信息'. $_status;
         //   file_put_contents("/tmp/user_to_cn_log.log", $log_info.PHP_EOL, FILE_APPEND);
        }
        catch (\Exception $e) {
            $log_info = $type ." email : $email , time :.". date('Y-m-d H:i:s').', 发送日志信息失败';
            var_dump($e->getMessage());
        //    file_put_contents("/tmp/user_to_cn_log.log", $log_info.$e->getMessage().PHP_EOL, FILE_APPEND);
            return false;
        }
    }

}
