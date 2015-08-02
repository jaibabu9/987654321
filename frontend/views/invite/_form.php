<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Invite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
