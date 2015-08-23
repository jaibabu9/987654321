<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="displayNone">Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="forgot-password">
                    If you forgot your password you can <?= Html::a('reset it',['site/request-password-reset'], $option=['class' => 'resetPassword']) ?>.
                </div>
                <div class="form-group fRight margTop15px">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-white', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
