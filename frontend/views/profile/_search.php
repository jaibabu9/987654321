<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'firstName') ?>

    <?= $form->field($model, 'lastName') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'addressLine1') ?>

    <?php // echo $form->field($model, 'addressLine2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zipCode') ?>

    <?php // echo $form->field($model, 'telNumber') ?>

    <?php // echo $form->field($model, 'faxNumber') ?>

    <?php // echo $form->field($model, 'mobileNumber') ?>

    <?php // echo $form->field($model, 'profilePics') ?>

    <?php // echo $form->field($model, 'drRegNo') ?>

    <?php // echo $form->field($model, 'drSpecialist') ?>

    <?php // echo $form->field($model, 'drHospital') ?>

    <?php // echo $form->field($model, 'drDesignation') ?>

    <?php // echo $form->field($model, 'workLocation') ?>

    <?php // echo $form->field($model, 'qualification') ?>

    <?php // echo $form->field($model, 'university') ?>

    <?php // echo $form->field($model, 'totExp') ?>

    <?php // echo $form->field($model, 'profileSummary') ?>

    <?php // echo $form->field($model, 'paDisease') ?>

    <?php // echo $form->field($model, 'paSubDisease') ?>

    <?php // echo $form->field($model, 'repProdName') ?>

    <?php // echo $form->field($model, 'repCompName') ?>

    <?php // echo $form->field($model, 'repTot') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
