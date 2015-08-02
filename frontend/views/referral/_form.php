<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Referral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referral-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'refer_to') ?>

    <?= $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
