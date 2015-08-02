<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
     //use yii\bootstrap\Modal;

     Modal::begin(['id' => 'modal',
        'header' => '<h2>Share Article</h2>']);

         //echo "Say Hello...";
        echo $this->render('_form', [
            'model' => $model,
        ]);

     Modal::end();
    ?>

</div>
