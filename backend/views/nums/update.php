<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nums */

$this->title = '修改序列号: ' . $model->id.': '.$model->card;
$this->params['breadcrumbs'][] = ['label' => '序列号', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id.': '.$model->card, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="nums-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
