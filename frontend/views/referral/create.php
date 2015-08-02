<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Referral */

$this->title = 'Create Referral';
$this->params['breadcrumbs'][] = ['label' => 'Referrals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referral-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
