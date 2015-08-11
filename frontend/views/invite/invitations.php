<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider; 
use yii\web\JsExpression;
use yii\jui\Autocomplete;
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
                    $reject=Html::a('Reject', ['decide','id' => (string)$model['_id'],'status'=>'2'], ['class' => 'btn btn-danger']);
                    $refer_to_other_doc='<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#referModal" data-inviteid="'.(string)$model['_id'].'">Refer</button>';
                    $actionContent='<div>'.$accept. ' '. $reject.' '.$refer_to_other_doc.'</div>';
                        return $actionContent;
                },
            ],
            

    ]
]);
//ExAMPLE COMMENT FOR CHECKING


?>

<style>
.ui-autocomplete {
    z-index: 1060; //more than z-index for modal = 1050
}
</style>

<div class="modal fade" id="referModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-body">
        <form action="referdoc" method="post" role="form">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="hidden" class="form-control" id="recipient-id"  name='recipient-id'>
             <input type="hidden" class="form-control" id="invite-id"  name='invite-id'>

           <?php
            echo AutoComplete::widget([
    'name' => 'company',
    'id' => 'ddd',
    'clientOptions' => [
      'source' => $doctors,
      'autoFill'=>true,
      'minLength'=>'0',
      'select' => new JsExpression("function( event, ui ) {
        console.log(ui);
        $('#recipient-id').val(ui.item.id);
      }")


    ],
    'options' => [
     'class' => 'form-control',
    ],

  ]);
           ?>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message-text"></textarea>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php
$this->registerJs('$("document").ready(function(){ 

 $("#referModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data("inviteid") // Extract info from data-* attributes
  var recipientUsername = button.data("docusername") // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  
  var modal = $(this)
  
  modal.find(".modal-body #invite-id").val(recipient)
});

 });');
?>