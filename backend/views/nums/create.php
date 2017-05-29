<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nums */

$this->title = '新建序列号';
$this->params['breadcrumbs'][] = ['label' => '序列号', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nums-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
