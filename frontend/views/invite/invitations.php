<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider; 
/* // Sameple array DataProvider
$resultData = [
    array("id"=>1,"name"=>"Cyrus","email"=>"risus@consequatdolorvitae.org"),
    array("id"=>2,"name"=>"Justin","email"=>"ac.facilisis.facilisis@at.ca"),
    array("id"=>3,"name"=>"Mason","email"=>"in.cursus.et@arcuacorci.ca"),
    array("id"=>4,"name"=>"Fulton","email"=>"a@faucibusorciluctus.edu"),
    array("id"=>5,"name"=>"Neville","email"=>"eleifend@consequatlectus.com"),
    array("id"=>6,"name"=>"Jasper","email"=>"lectus.justo@miAliquam.com"),
    array("id"=>7,"name"=>"Neville","email"=>"Morbi.non.sapien@dapibusquam.org"),
    array("id"=>8,"name"=>"Neville","email"=>"condimentum.eget@egestas.edu"),
    array("id"=>9,"name"=>"Ronan","email"=>"orci.adipiscing@interdumligulaeu.com"),
    array("id"=>10,"name"=>"Raphael","email"=>"nec.tempus@commodohendrerit.co.uk"),     
    ];*/

function filter($item) {
    $patientfilter = Yii::$app->request->getQueryParam('filterpatientname', '');
    $docfilter = Yii::$app->request->getQueryParam('filterdocname', '');

    if (strlen($patientfilter) > 0)
     {
    	
    	$pos = strpos($item['patientname'], $patientfilter);

    	if ($pos === false) {
    		return false;
    	}
    	else
    	{
    		return true;
    	}

    } else {
        return true;
    }	
}

$filteredresultData = array_filter($datas, 'filter');


$patientfilter = Yii::$app->request->getQueryParam('filterpatientname', '');
$docnamefilter = Yii::$app->request->getQueryParam('filterdocname', '');

$searchModel = ['_id' => null, 'docname' => $docnamefilter, 'patientname' => $patientfilter];

$dataProvider = new ArrayDataProvider([
        'key'=>'_id',
        'allModels' => $filteredresultData,
        'sort' => [
            'attributes' => ['docname', 'patientname'],
        ],
]);

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
            'attribute' => 'docname', 
            'filter' => '<input class="form-control" name="filterdocname" value="'. $searchModel['docname'] .'" type="text">',
            'value' => 'docname',
            ],
            [
            "attribute" => "patientname",
            'filter' => '<input class="form-control" name="filterpatientname" value="'. $searchModel['patientname'] .'" type="text">',
            'value' => 'patientname',
            ],
            [
            "attribute" => "description"
            ],
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {  
                    
                    $accept=Html::a('Accept', ['decide','id' => (string)$model['_id'],'status'=>'1'], ['class' => 'btn btn-success']);                  
                    $reject=Html::a('Raject', ['decide','id' => (string)$model['_id'],'status'=>'2'], ['class' => 'btn btn-danger']);
                    $abc='<div>'.$accept. ' '. $reject.'</div>';
                        return $abc;
                },
            ],
            

    ]
]);

?>