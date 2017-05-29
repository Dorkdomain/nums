<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\AdminUsers;
use app\modules\admin\models\Auth;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdminUsers */

$this->title = "个人中心";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="admin-users-view">

    <?php
    $model = \common\models\User::findOne(yii::$app->User->identity->id);

    ?>
    <p>
        <?= Html::a(Yii::t('app', '修改密码'), ['update-self'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div style="width:50%;">
        <table class='table table-hover'>
            <tr><th>账户名</th><td><?=$model->username?><td></tr>
        </table>
     <div>
</div>
