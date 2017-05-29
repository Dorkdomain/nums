<?php

namespace backend\controllers;


use yii;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\Controller;

class BaseController extends Controller
{

    /**
     * 动作执行前判定授权
     */
    public function beforeAction($action)
    {
       /* if (Yii::$app->request->userIP == "127.0.0.1" && $this->id == 'time-task')
            return true;*/

        if (Yii::$app->User->isGuest)
        {
            Yii::$app->getResponse()->redirect('@web/site/login')->send();
            return;
        }
        return true;
    }

}
