<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">
<div class="col-md-12">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'firstName') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'lastName') ?>
        </div>
        <div class="col-md-4">
            <?php echo '<label class="control-label">Birth Date</label>'; ?>
            <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'dob',
                    'name' => 'dob',
                    'size' => 'md',
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'mm/dd/yyyy'
                    ]
                ]);
             ?>
        </div>
    </div>
    <div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'age') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'gender')->radioList(['1'=>'Male',2=>'Female']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'country') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'state') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'city') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'addressLine1') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'addressLine2') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'zipCode') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'telNumber') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'faxNumber') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'mobileNumber') ?>
    </div>
    <!--div class="col-md-4">
        <?= $form->field($model, 'profilePics') ?>
    </div-->
    </div>
    <div class="row">
    <?php if (Yii::$app->user->identity->user_role == 1) { ?>
    <div class="col-md-4">
        <?= $form->field($model, 'drRegNo') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'drSpecialist') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'drHospital') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'drDesignation') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'workLocation') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'qualification') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'university') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'totExp') ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'profileSummary')->textarea(array('rows'=>2,'cols'=>5)); ?>
    </div>
    <?php }elseif (Yii::$app->user->identity->user_role == 2) { ?>
    <div class="col-md-4">
        <?= $form->field($model, 'paDisease') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'paSubDisease') ?>
    </div>
    <?php } elseif(Yii::$app->user->identity->user_role == 3) { ?>
    <div class="col-md-4">
        <?= $form->field($model, 'repProdName') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'repCompName') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'repTot') ?>
    </div>
    <?php } ?>
    </div>
    <div class="col-md-4">
        <?=
        //$form->field($model, 'userId')
        $model->userId = Yii::$app->user->identity->_id;
         $form->field($model, 'userId')->hiddenInput()->label(false);
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
    <div class="col-md-4 form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
