

<?php 

use yii\helpers\Html;

?>

<div class="row my-4">

    <!-- if there are 15 columns it runs 3 times which means there will be three tables eacch table has 5 inputs max -->
                     <?php $random_num_image_id = mt_rand(1,100000000000); ?>        <!-- 1 -->
           
              <div class="col-md-4">
        <table class="table">
        
        
        
                      
             
           
      
        
           <tr> <td>
        <div class='form_group_updated' data-type='string data-type2='string'>
        <label class='control-label pb-2' for='Test-column1'>column1</label>
        <div>
            <input type='text' data-name='column1' id='Test-column1' class='form_updated form_input' name='Test[column1]' aria-required='true' value='<?= $model->column1 ?>'>
            <span class='help-block form_error'><?= !empty($model->getErrors()['column1']) ? $model->getErrors()['column1'][0] : '' ?></span>
            <div>
            </div>
        </div>
    </div> </td> </tr>
                      
             
           
      
        
           <tr> <td>
            <div class='form_group_updated' data-type='integer data-type2='integer'>
                        <label class='control-label pb-2' for='Test-column2'>column2</label>
                        <div>
                            <input type='text' data-name='column2' id='Test-column2' class='form_updated form_input' name='Test[column2]' aria-required='true' value='<?= $model->column2 ?>'>
                            <span class='help-block form_error'><?= !empty($model->getErrors()['column2']) ? $model->getErrors()['column2'][0] : '' ?></span>
                            <div>
                            </div>
                        </div>
                    </div>
             </td> </tr>
                      
             
           
      
        
           <tr> <td>
        <div class='form_group_updated' data-type='string data-type2='decimal'>
        <label class='control-label pb-2' for='Test-column3'>column3</label>
        <div>
            <input type='text' data-name='column3' id='Test-column3' class='form_updated form_input' name='Test[column3]' aria-required='true' value='<?= $model->column3 ?>'>
            <span class='help-block form_error'><?= !empty($model->getErrors()['column3']) ? $model->getErrors()['column3'][0] : '' ?></span>
            <div>
            </div>
        </div>
    </div> </td> </tr>
                      
             
           
      
        
           <tr> <td>
            <div class='form_group_updated' data-type='string data-type2='date'>
                        <label class='control-label pb-2' for='Test-column4'>column4</label>
                        <div>
                            <input type='text' data-name='column4' id='Test-column4' class='form_updated form_input' name='Test[column4]' aria-required='true' value='<?= $model->column4 ?>'>
                            <span class='help-block form_error'><?= !empty($model->getErrors()['column4']) ? $model->getErrors()['column4'][0] : '' ?></span>
                            <div>
                            </div>
                        </div>
                    </div>
             </td> </tr>
                      
                          </table>
        </div>
           
           
              <div class="col-md-4">
        <table class="table">
        
        
           <tr> <td>
            <div class='form_group_updated' data-type='string' data-type2='text'>
                        <label class='control-label pb-2' for='Test-column5'>column5</label>
                        <div>
                            <textarea data-name='column5' type='text' id='Test-column5' class='form_updated form_input' name='Test[column5]' rows='5' cols='3' ><?= $model->column5 ?></textarea>
                            <span class='help-block form_error'><?= !empty($model->getErrors()['column5']) ? $model->getErrors()['column5'][0] : '' ?></span>
                            <div>
                            </div>
                        </div>
                    </div>
             </td> </tr>
                      
             
           
      
        
           <tr> <td>
            <div id='5385' style='position:relative;'>
            <select data-name='column6' name='Test[column6]' class='form_input' id='4080'><option value='option1'>Option1</option><option value='option2'>Option2</option><option value='option3'>Option3</option></select>
            <span class='help-block form_error'><?= !empty($model->getErrors()['column6']) ? $model->getErrors()['column6'][0] : '' ?></span>
            </div>            

<script>FancySelect.getSelect2({multiple:false, parent:'#5385', select_id:'#4080', url:'\yii\helpers\Url::to(["/site/af-get-values"])'})</script> </td> </tr>
                      
             
           
      
        
           <tr> <td>
            <div class='form-group field-Test-column7'>
                    <label for='Test[column7]' >Column7</label>
                    <input type='checkbox' name='Test[column7]' value='<?= $model->column7 ?>'>
            </div> </td> </tr>
                      
             
           
      
        
           <tr> <td>
        <div class='form_group_updated' data-type='string data-type2='string'>
        <label class='control-label pb-2' for='Test-column8'>column8</label>
        <div>
            <input type='text' data-name='column8' id='Test-column8' class='form_updated form_input' name='Test[column8]' aria-required='true' value='<?= $model->column8 ?>'>
            <span class='help-block form_error'><?= !empty($model->getErrors()['column8']) ? $model->getErrors()['column8'][0] : '' ?></span>
            <div>
            </div>
        </div>
    </div> </td> </tr>
                                    
                          </table>
        </div>
           
    
    </table>
    </div>
</div>
<div class="form-group save_btn_parent">
  <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn_save']) ?>
</div>




<script>
  $(document).ready(function() {
    var errors = <?= json_encode($model->getErrors()) ?>;
    let message = "";
  Object.keys(errors).forEach(key => {
    const val = errors[key];
    message+= `${val}\n`;
    
});
if(message.length > 0) {

    iziToast.error({
        title: "Error",
        position : "topRight",
        message,
        maxWidth: 400
    });
}

})
  
  </script>
<script>




   
    $(".form_input").on("input blur change", function() {
      var value = $(this).val();
      let name = $(this).data("name")
      let curr = $(this);
      var gen = {"id":{"name":"id","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":true,"autoIncrement":true,"unsigned":false,"comment":"","disableJsonSupport":false},"column1":{"name":"column1","allowNull":true,"type":"string","phpType":"string","dbType":"varchar(255)","defaultValue":null,"enumValues":null,"size":255,"precision":255,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column2":{"name":"column2","allowNull":true,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column3":{"name":"column3","allowNull":true,"type":"decimal","phpType":"string","dbType":"decimal(10,2)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":2,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column4":{"name":"column4","allowNull":true,"type":"date","phpType":"string","dbType":"date","defaultValue":null,"enumValues":null,"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column5":{"name":"column5","allowNull":true,"type":"text","phpType":"string","dbType":"text","defaultValue":null,"enumValues":null,"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column6":{"name":"column6","allowNull":true,"type":"string","phpType":"string","dbType":"enum('option1','option2','option3')","defaultValue":null,"enumValues":["option1","option2","option3"],"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column7":{"name":"column7","allowNull":true,"type":"tinyint","phpType":"integer","dbType":"tinyint(1)","defaultValue":null,"enumValues":null,"size":1,"precision":1,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"column8":{"name":"column8","allowNull":true,"type":"string","phpType":"string","dbType":"varchar(50)","defaultValue":null,"enumValues":null,"size":50,"precision":50,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false}};

      
      Object.keys(gen).forEach(key => {
        const obj = gen[key];
        if(name == obj.name) {
            if(obj.allowNull || obj.isPrimaryKey) {
                curr.siblings(".form_error").text("")
                //   curr.nextElementSibling.textContent = ""
                return;
            }
            
            if(value == "") {
                name_cap = obj.name.charAt(0).toUpperCase() + obj.name.slice(1)
                curr.siblings(".form_error").text(name_cap + " cannot be blank")
            //   curr.nextElementSibling.textContent = obj.name + " cannot be empty";
            }else {
            //   curr.nextElementSibling.textContent = ""
              curr.siblings(".form_error").text("")

            }
            
            return;
        }
    });


    })
</script>