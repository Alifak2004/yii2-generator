<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<link href="<?= Url::to(["/css/login1.min.css"]) ?>" rel="stylesheet">
<link href="<?= Url::to(["/css/login2.min.css"]) ?>" rel="stylesheet">
<link href="<?= Url::to(["/css/login3.min.css"]) ?>" rel="stylesheet">


<!-- <div class="row no-gutters min-h-fullscreen bg-white" style=" -->
<div class="row no-gutters bg-white" style="height:100vh;">
  <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url(../../web/images/beach2.jpg)" data-overlay="5">

    <div class="row h-100 pl-50">
      <div class="col-md-10 col-lg-8 align-self-end">
        <!-- <img src="../../web/images/beach.jpg" alt="..."> -->
        <br><br><br>
        <h4 class="text-white">The admin is the best admin framework available online.</h4>
        <p class="text-white">Credibly transition sticky users after backward-compatible web services. Compellingly strategize team building interfaces.</p>
        <br><br>
      </div>
    </div>

  </div>



  <div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
    <div class="px-80 py-30">
      <?= Html::csrfMetaTags() ?>
      <h4>Login</h4>
      <p><small>Sign into your account</small></p>
      <br>

      <form class="form-type-material">
        <div class="form-group">
          <input type="text" class="form-control" id="user_name" name="Users[user_name]">
          <label for="username">Username</label>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" id="password" name="Users[password]">
          <label for="password">Password</label>
        </div>

        <div class="form-group flexbox">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" checked="" id="remember_me" name="Users[remember_me]">
            <label class="custom-control-label">Remember me</label>
          </div>

          <a class="text-muted hover-primary fs-13" href="#">Forgot password?</a>
        </div>

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" id="submit_userLogin" type="submit">Login</button>
        </div>
      </form>

      <script>
        $("#submit_userLogin").on("submit click", function(e) {
          e.preventDefault();
          var csrfToken = $('meta[name="csrf-token"]').attr("content");
          var user_name = $("#user_name").val();
          var password = $("#password").val();
          var remember_me = $("#remember_me").val();

          $.ajax({
            "type": "POST",
            "url": `<?= Url::to(["site/login"]) ?>`,
            "headers": {
              "X-CSRF-Token": csrfToken, // Pass the CSRF token in the headers
            },
            "data": {
              user_name,
              password,
              remember_me: remember_me ? 1 : 0
            },
            "success": (data) => {
              // alert("success");
              if (data == 1) {
                window.location.reload();
                return;
              }

              iziToast.error({
                title: 'Error',
                position: "topRight",
                message: "Username or Password are wrong",
                maxWidth: 400
              });

              // $(".container_body").css("opacity", 1)
              // $(".spinner ").hide()
            },
            "error": () => {

            }
          })
        })
      </script>
      <!-- <div class="divider">Or Sign In With</div> -->
      <!-- <div class="text-center">
          <a class="btn btn-square btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
          <a class="btn btn-square btn-google" href="#"><i class="fa fa-google"></i></a>
          <a class="btn btn-square btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
        </div> -->

      <hr class="w-30px">

      <!-- <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a class="text-primary fw-500" href="#">Sign up</a></p> -->
    </div>
  </div>
</div>

<!-- <div class="site-login">
    <h1>< ?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    < ?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        < ?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        < ?= $form->field($model, 'password')->passwordInput() ?>

        < ?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                < ?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    < ?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div> -->
<script src="<?= Url::to(["/js/core.min.js"]) ?>">
</script>
<script src="<?= Url::to(["/js/app.min.js"]) ?>">
</script>
<script src="<?= Url::to(["/js/script.min.js"]) ?>">
</script>