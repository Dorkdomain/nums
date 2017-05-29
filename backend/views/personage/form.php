<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
$cssString = "#man-secret_status label{
margin-right:5%;}
";
$this->registerCss($cssString);
?>

<div class="admin-users-form" style=" margin-top: 50px">

    <?php $form = ActiveForm::begin([
        'id' => 'form-id',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute(['validate-form']),
        'fieldConfig'=>[
                    'template' => '<div class="col-lg-12">
                            <div class="col-lg-2">{label}</div>
                             <div class="col-lg-4">{input}<br></div>
                            <div class="col-lg-4">{error}</div></div>',
    ]]); ?>

    <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'two_password')->passwordInput(['maxlength' => true]) ?>


    <div class="form-group" style = " margin-left: 35%;">
        <?= Html::submitButton( Yii::t('app', '提交'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
 *

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'real_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salt')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>


    <?= $form->field($model, 'secret')->textInput(['maxlength' => true]) ?>
 */
?>