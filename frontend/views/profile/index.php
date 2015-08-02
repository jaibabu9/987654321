<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            '_id',
            'firstName',
            'lastName',
            'dob',
            'age',
            // 'gender',
            // 'country',
            // 'state',
            // 'addressLine1',
            // 'addressLine2',
            // 'city',
            // 'zipCode',
            // 'telNumber',
            // 'faxNumber',
            // 'mobileNumber',
            // 'profilePics',
            // 'drRegNo',
            // 'drSpecialist',
            // 'drHospital',
            // 'drDesignation',
            // 'workLocation',
            // 'qualification',
            // 'university',
            // 'totExp',
            // 'profileSummary',
            // 'paDisease',
            // 'paSubDisease',
            // 'repProdName',
            // 'repCompName',
            // 'repTot',
            // 'userId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
