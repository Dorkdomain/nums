<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdminUsers */

$this->title = Yii::t('app', '修改密码');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '个人中心'), 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-update">

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
