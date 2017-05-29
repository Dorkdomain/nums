<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Nums */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nums-form">

    <?php
    $form = ActiveForm::begin([
        'fieldConfig'=>[
            'template' => '<div class="col-lg-12">
        <div class="col-lg-2">{label}</div>
        <div class="col-lg-4">{input}<br></div>
        <div class="col-lg-4">{error}</div></div>',
        ]]);
    ?>

    <?= $form->field($model, 'card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dueTime')->widget(
        DatePicker::className(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ]
    ]);?>


    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <div class="form-group" style="margin-left: 30%">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
