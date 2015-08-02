<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'firstName',
            'lastName',
            'dob',
            'age',
            'gender',
            'country',
            'state',
            'addressLine1',
            'addressLine2',
            'city',
            'zipCode',
            'telNumber',
            'faxNumber',
            'mobileNumber',
            'profilePics',
            'drRegNo',
            'drSpecialist',
            'drHospital',
            'drDesignation',
            'workLocation',
            'qualification',
            'university',
            'totExp',
            'profileSummary',
            'paDisease',
            'paSubDisease',
            'repProdName',
            'repCompName',
            'repTot',
            'userId',
        ],
    ]) ?>

</div>
