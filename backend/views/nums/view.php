<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nums */

$this->title = $model->id.': '.$model->card;
$this->params['breadcrumbs'][] = ['label' => '序列号', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nums-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此条数据吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr style="width: 80%">
                        <th style="width:7%">{label}</th>
                        <td style="width:35%">{value}</td></tr>',
        'attributes' => [
            'id',
            'card',
            'dueTime',
            'remainingTime',
            'remark:ntext',
        ],
    ]) ?>

</div>
