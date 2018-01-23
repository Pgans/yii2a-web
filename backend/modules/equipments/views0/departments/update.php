<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Departments */

$this->title = 'Update Departments: ' . ' ' . $model->dep_id;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dep_id, 'url' => ['view', 'id' => $model->dep_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
