<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use frontend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);

     $model->user_id = Yii::$app->user->identity->_id;

     ?>
    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'title') ?>
        </div>

    <!--?= $form->field($model, 'file') ?-->
        <div class="col-md-6">
            <!--?= $form->field($model, 'share_to') ?-->

            <?php
            $usr=User::find()->all();

            $usrs=ArrayHelper::map($usr,function ($model) {
                return $model->_id->{'$id'};
            },'username');
                echo $form->field($model, 'share_to')->label('Share To')->widget(Select2::classname(), [
                                'data' => $usrs,  //$out,
                                'options' => ['placeholder' => 'Select User', 'id'=>'file_id'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

                    <!--?= $form->field($model, 'file')->fileInput() ?-->
                    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'file/*'],
                                 'pluginOptions' => [
                                    'previewFileType' => 'image',
                                    'showUpload' => false,
                                    ],
                                ]);
                    ?>
        </div>
        <?php $model->status = 1 ?>
    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
