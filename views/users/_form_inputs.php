<?php

use app\models\Products;
use kartik\widgets\Select2;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2Asset;
use yii\web\JqueryAsset;

$url = Url::to(["/site/af-select-data"]);
Select2Asset::register($this);
JqueryAsset::register($this);



$fr_products = Products::find()->all();
?>

<div class="row my-4">
    <div class="col-md-4">
        <table class="table">
            <tr>
                <td class=" form_td" id="dwadwadsadwdfw">
                    <select  name="Users[user_name]" id="here_select2">
                    <?php foreach ($fr_products as $product): ?>
                            <option value="<?= $product->id ?>"><?= $product->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <!-- <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-user_name">User Name</label>
                        <div>
                            <input type="text" id="users-user_name" class="form_updated form_input" name="Users[user_name]" maxlength="100" aria-required="true" value="< ?= $model->user_name ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["user_name"]) ? $model->getErrors()["user_name"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td> -->
            </tr>
            <tr>

                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-first_name">First Name</label>
                        <div>
                            <input type="text" id="users-first_name" class="form_updated form_input" name="Users[first_name]" maxlength="100" aria-required="true" value="<?= $model->first_name ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["first_name"]) ? $model->getErrors()["first_name"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-last_name">Last Name</label>
                        <div>
                            <input type="text" id="users-last_name" class="form_updated form_input" name="Users[last_name]" maxlength="100" aria-required="true" value="<?= $model->last_name ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["last_name"]) ? $model->getErrors()["last_name"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-birth_date">Birth Date</label>
                        <div>
                            <?= Yii::warning($model->birth_date) ?>
                            <input type="date" id="users-birth_date" class="form_updated form_input" name="Users[birth_date]" maxlength="100" aria-required="true" value="<?= $model->birth_date ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["birth_date"]) ? $model->getErrors()["birth_date"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table class="table">

            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-email">Email</label>
                        <div>
                            <input type="text" id="users-email" class="form_updated form_input" name="Users[email]" maxlength="100" aria-required="true" value="<?= $model->email ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["email"]) ? $model->getErrors()["email"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-password">Password</label>
                        <div>
                            <input type="text" id="users-password" class="form_updated form_input" name="Users[password]" maxlength="100" aria-required="true" value="<?= $model->password ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["password"]) ? $model->getErrors()["password"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-address">Address</label>
                        <div>
                            <input type="text" id="users-address" class="form_updated form_input" name="Users[address]" maxlength="100" aria-required="true" value="<?= $model->address ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["address"]) ? $model->getErrors()["address"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-phone">Phone</label>
                        <div>
                            <input type="text" id="users-phone" class="form_updated form_input" name="Users[phone]" maxlength="100" aria-required="true" value="<?= $model->phone ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["phone"]) ? $model->getErrors()["phone"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        </table>

    </div>
    <div class="col-md-4">
        <table class="table">
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-zip_code">Zip Code</label>
                        <div>
                            <input type="text" id="users-zip_code" class="form_updated form_input" name="Users[zip_code]" maxlength="100" aria-required="true" value="<?= $model->zip_code ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["zip_code"]) ? $model->getErrors()["zip_code"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_td">
                    <div class="form_group_updated">
                        <label class="control-label pb-2" for="users-role">Role</label>
                        <div>
                            <input type="text" id="users-role" class="form_updated form_input" name="Users[role]" maxlength="100" aria-required="true" value="<?= $model->role ?>">
                            <div class="help-block form_error"><?= !empty($model->getErrors()["role"]) ? $model->getErrors()["role"][0] : "" ?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="form_td" id="images_input_form">
                </td>
            </tr>
        </table>

    </div>
</div>


<div class="form-group save_btn_parent" style="">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn_save']) ?>
</div>





<script>
    $("#thumbnailContainer").empty();
    var oldImages = <?= $images ?>;
    $(document).ready(function() {
        var imagesInput = ImageInput.getImageInput({type:"single", oldImages})
        $("#images_input_form").html(imagesInput);
    })
    
    $(document).ajaxComplete(function() {

        let data = <?= json_encode($model->user_name )?>;        
        // Initialize the Select2 widget here
        FancySelect.getSelect2({multiple:false, data, parent:"#dwadwadsadwdfw", select_id:"#here_select2",url:"<?= Url::to(["/site/af-get-values"]) ?>"});

    })
</script>