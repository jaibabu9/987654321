<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Specialist;

$this->title = 'Find A Doctor';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-searchdoc">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-5">
           
            <?php $form = ActiveForm::begin(['id' => 'form-searchdoc']); ?>
                <?= $form->field($model, 'location') ?>
            
            <?= $form->field($model, 'drSpecialist')->dropDownList(ArrayHelper::map(Specialist::find()->all(), function ($model) {
                return $model->_id->{'$id'};
            }, 'name'), ['prompt'=>'Select All']) ?>    
                
                

                <div class="form-group">
                    <?= Html::submitButton('searchdoc', ['class' => 'btn btn-primary', 'name' => 'searchdoc-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php if (count($doctors) > 0):?>

<div class="bs-example">
    <table class="table">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>        
        <tbody>
        <?php foreach($doctors as $doctor) :?>
            <tr>
                
                <td><?php echo $doctor->username;?></td>
                <td><?php echo $doctor->email;?></td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inviteModal" data-docid="<?php echo (string)$doctor->_id;?>" data-docusername="<?php echo $doctor->username;?>">Invite</button></td>
            </tr>
         <?php endforeach; ?>
            
            
        </tbody>
    </table>
</div>


<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form action="invite" method="post" role="form">
          <div class="form-group" style="display:none">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-id"  name='recipient-id'>
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

 $("#inviteModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data("docid") // Extract info from data-* attributes
  var recipientUsername = button.data("docusername") // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  
  var modal = $(this)
  modal.find(".modal-title").text("New message to " + recipientUsername)
  modal.find(".modal-body #recipient-id").val(recipient)
});

 });');
?>


<?php endif;?>