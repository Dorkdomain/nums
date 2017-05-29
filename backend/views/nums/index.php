<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NumsSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '序列号';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nums-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建序列号', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'card',
            'dueTime',
            'remainingTime',
            [
                "attribute" => "remark",
                'contentOptions' => ['style' => 'white-space: normal;', 'width' => '40%'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
