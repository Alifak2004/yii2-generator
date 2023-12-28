
<?php

use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Html;

?>

<div>

    <table class="row my-4" id="Iam_heree12">

        <!-- if there are 15 columns it runs 3 times which means there will be three tables eacch table has 5 inputs max -->
        <?php $random_num_image_id = mt_rand(1, 100000000000); ?> <!-- 1 -->
        <tr>
            <td class="col-md-6">
                <div class="d-inline-block" style="margin-right:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                    <!-- <div class="" style="
    border: 1px solid #999;
    border-radius: 10px;
    
"> -->

                   
                    <table class="table">
                        <tbody class="row">
                            <tr>

                                <td class="col-md-4">
                                    <div class="form_group_updated" data-type="string data-type2=" strin>
                                        <label class="control-label " for="Products-name">name</label>
                                        <div>
                                            <input data-name="name" type="text" id="Products-name" class="form_updated form_input" name="Products[name]" aria-required="true" value="<?= $model->name ?>">
                                            <div class="help-block form_error"></div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td class="col-md-4">
                                    <?php
                                    $categoryItems = [
                                        'NEW' => 'NEW',
                                        'USED' => 'USED',
                                        'REFURBISHED' => 'REFURBISHED',
                                        'OPEN BOX' => 'OPEN BOX',
                                    ];
                                    ?>

                                    <div id='5045' style='position:relative;'>
                                        <label class="control-label " for="">State</label>

                                        <select name='Products[product_condition]' id='4163'>
                                            <option value='NEW'>NEW</option>
                                            <option value='USED'>USED</option>
                                            <option value='REFURBISHED'>REFURBISHED</option>
                                            <option value='OPEN BOX'>OPEN BOX</option>
                                        </select>
                                    </div>

                                    <script>
                                        FancySelect.getSelect2({
                                            multiple: false,
                                            parent: '#5045',
                                            select_id: '#4163',
                                            url: '\yii\helpers\Url::to(["/site/af-get-values"])'
                                        })
                                        if("<?= $model->product_condition ?> ") 
                                            $('#4163').val("<?= $model->product_condition ?>" ).trigger("change");
                                    </script>
                                </td>

                                <td class="col-md-4">
                                    <div class='form_group_updated' data-type='string data-type2='>
                                        <label class='control-label ' for='Products-brand'>Brand</label>
                                        <div>
                                            <input data-name="brand" type='text' id='Products-brand' class='form_updated form_input' name='Products[brand]' aria-required='true' value='<?= $model->brand ?>'>
                                            <div class='help-block form_error'><?= !empty($model->getErrors()['brand']) ? $model->getErrors()['brand'][0] : '' ?></div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4">
                                    <div class="form_group_updated" data-type="integer data-type2=">
                                        <label class="control-label" for="Products-qty">Quanitity</label>
                                        <div>
                                            <input data-name="qty"  type="text" id="Products-qty" class="form_updated form_input" name="Products[qty]" aria-required="true" value="<?= $model->qty ?>">
                                            <div class="help-block form_error"></div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="col-md-4">
                                    <div class='form_group_updated' data-type='integer data-type2='>
                                        <label class='control-label' for='Products-actual_qty'>Actual Quantity</label>
                                        <div>
                                            <input data-name="actual_qty"  type='text' id='Products-actual_qty' class='form_updated form_input' name='Products[actual_qty]' aria-required='true' value='<?= $model->actual_qty ?>'>
                                            <div class='help-block form_error'><?= !empty($model->getErrors()['actual_qty']) ? $model->getErrors()['actual_qty'][0] : '' ?></div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="col-md-4">
                                    <div id='2284' style='position:relative;'>
                                        <label class='control-label' for='Products-actual_qty'>Status</label>
                                        <select data-name="status" name='Products[status]' id='9666'>
                                            <option value='PENDING'>PENDING</option>
                                            <option value='REJECTED'>REJECTED</option>
                                            <option value='CONFIRMED'>CONFIRMED</option>
                                        </select>
                                    </div>

                                    <script>
                                        FancySelect.getSelect2({
                                            multiple: false,
                                            parent: '#2284',
                                            select_id: '#9666',
                                            url: '\yii\helpers\Url::to(["/site/af-get-values"])'
                                        })
                                        if("<?= $model->status ?> ") 
                                            $('#9666').val("<?= $model->status ?>" ).trigger("change");

                                    </script>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- </div> -->
            </td>
            <td class="d-inline-block w-100" style="margin-left:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                <div class="" style="">
                    <table class="table">


                        <tr class="">
                            <td>
                                <div class="form_group_updated" data-type="string" data-type2="text">
                                    <label class="control-label pb-2" for="Products-description_sm">Small description</label>
                                    <div>
                                        <textarea data-name="description_sm" type="text" id="Products-description_sm" class="form_updated form_input" name="Products[description_sm]" rows="5" cols="3"><?= $model->description_sm ?></textarea>
                                        <div class="help-block form_error"></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>


        <tr style="    margin: 1rem 0 !important;
    display: table;">
            <td class="col-md-6">

                <div class="d-inline-block" style="margin-right:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                    <table class="table">

                        <tr style="
    transform: translateX(16%);
">
                            <td class="col-md-4">
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-weight'>Weight</label>
                                    <div>
                                        <input data-name="weight" type='text' id='Products-weight' class='form_updated form_input' name='Products[weight]' aria-required='true' value='<?= $model->weight ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['weight']) ? $model->getErrors()['weight'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="col-md-4">
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-cost'>Cost</label>
                                    <div>
                                        <input data-name="cost" type='text' id='Products-cost' class='form_updated form_input' name='Products[cost]' aria-required='true' value='<?= $model->cost ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['cost']) ? $model->getErrors()['cost'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>


                        <tr>
                            <td class="col-md-4">
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-wholesale_price'>Wholesale Price</label>
                                    <div>
                                        <input data-name="wholesale_price" type='text' id='Products-wholesale_price' class='form_updated form_input' name='Products[wholesale_price]' aria-required='true' value='<?= $model->wholesale_price ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['wholesale_price']) ? $model->getErrors()['wholesale_price'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="col-md-4">
                                <div class='form_group_updated' data-type='string data-type2=' decimal'>
                                    <label class='control-label pb-2' for='Products-clearance_price'>clearance_price</label>
                                    <div>
                                        <input data-name="clearance_price" type='text' id='Products-clearance_price' class='form_updated form_input' name='Products[clearance_price]' aria-required='true' value='<?= $model->clearance_price ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['clearance_price']) ? $model->getErrors()['clearance_price'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="col-md-4">
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-retail_price'>retail_price</label>
                                    <div>
                                        <input data-name="retail_price"  type='text' id='Products-retail_price' class='form_updated form_input' name='Products[retail_price]' aria-required='true' value='<?= $model->retail_price ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['retail_price']) ? $model->getErrors()['retail_price'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>


                    </table>
                </div>
            </td>

            <td class="col-md-6">

                <div class="d-inline-block" style="margin-left:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                    <table class="table">


                        <tr>
                            <td>
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-shipping_cost'>shipping_cost</label>
                                    <div>
                                        <input data-name="shipping_cost"  type='text' id='Products-shipping_cost' class='form_updated form_input' name='Products[shipping_cost]' aria-required='true' value='<?= $model->shipping_cost ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['shipping_cost']) ? $model->getErrors()['shipping_cost'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-vat'>vat</label>
                                    <div>
                                        <input data-name="vat" type='text' id='Products-vat' class='form_updated form_input' name='Products[vat]' aria-required='true' value='<?= $model->vat ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['vat']) ? $model->getErrors()['vat'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>


                            <td>
                                <div class='form_group_updated' data-type='integer data-type2='>
                                    <label class='control-label pb-2' for='Products-low_qty_alert'>low_qty_alert</label>
                                    <div>
                                        <input data-name="low_qty_alert" type='text' id='Products-low_qty_alert' class='form_updated form_input' name='Products[low_qty_alert]' aria-required='true' value='<?= $model->low_qty_alert ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['low_qty_alert']) ? $model->getErrors()['low_qty_alert'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>





                        <tr>
                            <td>
                                <div class='form_group_updated' data-type='string data-type2='>
                                    <label class='control-label pb-2' for='Products-discount_rate'>discount_rate</label>
                                    <div>
                                        <input data-name="discount_rate"  type='text' id='Products-discount_rate' class='form_updated form_input' name='Products[discount_rate]' aria-required='true' value='<?= $model->discount_rate ?>'>
                                        <div class='help-block form_error'><?= !empty($model->getErrors()['discount_rate']) ? $model->getErrors()['discount_rate'][0] : '' ?></div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class='form-group field-Products-featured'>
                                    <label>
                                        <input  data-name="featured"  type='checkbox' name='Products[featured]' value='1'>
                                        Featured
                                    </label>
                                </div>
                            </td>

                            <td>
                                <div class='form-group field-Products-visible'>
                                    <label>
                                        <input  data-name="visible" type='checkbox' name='Products[visible]' value='1'>
                                        Visible
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div class='form-group field-Products-main_page'>
                                    <label>
                                        <input data-name="main_page" type='checkbox' name='Products[main_page]' value='1'>
                                        Main page
                                    </label>
                                </div>
                            </td>

                            <!-- <td>
                                <div class='form-group field-Products-main_page'>
                                    <input type='hidden' name='Products[main_page]' value='0'>
                                    <label>
                                        <input type='checkbox' name='Products[main_page]' value='1'>
                                        Main page
                                    </label>
                                </div>
                            </td> -->
                        </tr>

                    </table>
                </div>
            </td>
        </tr>



        <tr class="row">

            <td style="margin-left:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">

                <table class="table">
                    <tr>
                        <td>
                            <div class="form_group_updated" data-type="string" data-type2="text">
                                <label class="control-label pb-2" for="Products-description_lg">Description</label>
                                <div>
                                    <textarea data-name="description_lg" type="text" id="Products-description_lg" class="form_updated form_input" name="Products[description_lg]" rows="5" cols="3"><?= $model->description_lg ?></textarea>
                                    <div class="help-block form_error"></div>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                </table>

            </td>

        </tr>


        <tr class="row mt-3">
            <td style="margin-left:.5rem;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                <table class="table">
                    <tr>
                        <td class="form_td" id="images_input_form">
                        </td>
                    </tr>



                </table>
            </td>
        </tr>



    </table>

    <div class="form-group save_btn_parent" style="background-color:<?= $subMenu ? 'transparent !important' : '#f4f4f4' ?> ">

        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $subMenu ? " ms-auto d-block btn btn-success btn_save " : "btn btn-success btn_save "]) ?>
    </div>

</div>


<script>
    var oldImages = <?= json_encode($images) ?>;
    var updatedOldImages = JSON.parse(oldImages)
    $(document).ready(function() {
        var imagesInput = ImageInput.getImageInput({
            type: "multiple",
            oldImages: updatedOldImages
        })
        $("#images_input_form").html(imagesInput);
    })
    
</script>

<script>

    $(document).ready(function() {
        var errors = <?= json_encode($model->getErrors()) ?>;
        console.log(errors)

        let message = "";
        Object.keys(errors).forEach(key => {
        const val = errors[key];
        message+= `${val}\n`;
        
        });
        if(message.length > 0) {

            iziToast.error({
                title: 'Error',
                position : "topRight",
                message,
                maxWidth: 400
            });
        }
    
    })

    $(".form_input").on("input blur change", function() {
      var value = $(this).val();
      let name = $(this).data("name");
      let curr = $(this);
      var gen = {"id":{"name":"id","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":true,"autoIncrement":true,"unsigned":false,"comment":"","disableJsonSupport":false},"name":{"name":"name","allowNull":true,"type":"string","phpType":"string","dbType":"varchar(200)","defaultValue":null,"enumValues":null,"size":200,"precision":200,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"description_sm":{"name":"description_sm","allowNull":true,"type":"text","phpType":"string","dbType":"text","defaultValue":null,"enumValues":null,"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"description_lg":{"name":"description_lg","allowNull":true,"type":"text","phpType":"string","dbType":"longtext","defaultValue":null,"enumValues":null,"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"qty":{"name":"qty","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"actual_qty":{"name":"actual_qty","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"views":{"name":"views","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":0,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"weight":{"name":"weight","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"cost":{"name":"cost","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"wholesale_price":{"name":"wholesale_price","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"retail_price":{"name":"retail_price","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"clearance_price":{"name":"clearance_price","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"brand":{"name":"brand","allowNull":false,"type":"string","phpType":"string","dbType":"varchar(50)","defaultValue":null,"enumValues":null,"size":50,"precision":50,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"shipping_cost":{"name":"shipping_cost","allowNull":true,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"vat":{"name":"vat","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"low_qty_alert":{"name":"low_qty_alert","allowNull":false,"type":"integer","phpType":"integer","dbType":"int(11)","defaultValue":null,"enumValues":null,"size":11,"precision":11,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"discount_rate":{"name":"discount_rate","allowNull":false,"type":"decimal","phpType":"string","dbType":"decimal(10,0)","defaultValue":null,"enumValues":null,"size":10,"precision":10,"scale":0,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"product_condition":{"name":"product_condition","allowNull":false,"type":"string","phpType":"string","dbType":"enum('NEW','USED','REFURBISHED','OPEN BOX')","defaultValue":null,"enumValues":["NEW","USED","REFURBISHED","OPEN BOX"],"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"status":{"name":"status","allowNull":false,"type":"string","phpType":"string","dbType":"enum('PENDING','REJECTED','CONFIRMED')","defaultValue":null,"enumValues":["PENDING","REJECTED","CONFIRMED"],"size":null,"precision":null,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"featured":{"name":"featured","allowNull":false,"type":"tinyint","phpType":"integer","dbType":"tinyint(1)","defaultValue":0,"enumValues":null,"size":1,"precision":1,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"visible":{"name":"visible","allowNull":false,"type":"tinyint","phpType":"integer","dbType":"tinyint(1)","defaultValue":1,"enumValues":null,"size":1,"precision":1,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"recommended":{"name":"recommended","allowNull":false,"type":"tinyint","phpType":"integer","dbType":"tinyint(1)","defaultValue":0,"enumValues":null,"size":1,"precision":1,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false},"main_page":{"name":"main_page","allowNull":false,"type":"tinyint","phpType":"integer","dbType":"tinyint(1)","defaultValue":0,"enumValues":null,"size":1,"precision":1,"scale":null,"isPrimaryKey":false,"autoIncrement":false,"unsigned":false,"comment":"","disableJsonSupport":false}};

      
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