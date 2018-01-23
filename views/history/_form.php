<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Devices;
use common\models\Departments;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\History */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-4">
    <?= $form->field($model, 'devices_device_id')->dropDownList(
        ArrayHelper::map(devices::find()->all(),'device_id','device_serial'),
        ['prompt'=>'กรุณาเลือกเลขครุภัณฑ์']
        ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'departments_dep_id')->dropDownList(
        ArrayHelper::map(departments::find()->all(),'dep_id','dep_name'),
        ['prompt'=>'กรุณาเลือกแผนกเดิม']
        ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'departments_dep_id')->dropDownList(
        ArrayHelper::map(departments::find()->all(),'dep_id','dep_name'),
        ['prompt'=>'กรุณาเลือกแผนกใหม่']
        ) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
