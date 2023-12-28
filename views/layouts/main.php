<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
// use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);


$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);




?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <title><?= Html::encode($this->title) ?></title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- sweet alert cdn-->
  <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <!-- sweet alert2 cdn -->


  <!-- <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <script src="main.js"></script> -->
  <!-- contextmenu -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.js" integrity="sha512-2ABKLSEpFs5+UK1Ol+CgAVuqwBCHBA0Im0w4oRCflK/n8PUVbSv5IY7WrKIxMynss9EKLVOn1HZ8U/H2ckimWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.css" integrity="sha512-EF5k2tHv4ShZB7zESroCVlbLaZq2n8t1i8mr32tgX0cyoHc3GfxuP7IoT8w/pD+vyoq7ye//qkFEqQao7Ofrag==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
  <!-- end contextmenu -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script> -->
  <?php $this->head() ?>
  <!-- javascript sweetalert -->
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
  <!-- animate sweetalert -->
  <!-- <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    /> -->

  <!-- <script src="  "></script> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-grid.css" /> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-theme-alpine.css" />

</head>

<body class="h-100">
  <?php $this->beginBody() ?>

  <?php if (!Yii::$app->user->isGuest) { ?>
    <div class="layout has-sidebar fixed-sidebar fixed-header">
      <aside id="sidebar" class="sidebar break-point-sm has-bg-image collapsed">
        <a id="btn-collapse" class="sidebar-collapser"><i style="font-size: .9rem;" class="fa-solid fa-arrow-left"></i></a>
        <div class="image-wrapper">
          <!-- add a bg image to the sidebar -->
          <!-- <img src="assets/images/sidebar-bg.jpg" alt="sidebar background" /> -->
        </div>
        <div class="sidebar-layout">
          <div class="sidebar-header">
            <div class="pro-sidebar-logo">
              <div>P</div>
              <h5>Pro Sidebar</h5>
            </div>
          </div>
          <div class="sidebar-content">
            <nav class="menu open-current-submenu">
              <!-- change here -->
              <ul>

                <li class="menu-navbar-item" role="presentation">
                  <a href="<?= Url::to(["/site"]) ?>" class="active" data-bs-toggle="tab" role="tab">
                    <span title="dashboard" class="menu-icon">
                      <i class="fa-solid fa-house-chimney"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                    <span class="menu-suffix">
                      <span class="badge primary"></span>
                    </span>
                  </a>
                </li>
                <li class="menu-navbar-item">
                  <a href="<?= Url::to(["/users"]) ?>">
                    <span title="users" class="menu-icon">
                      <i class="fa-solid fa-user"></i>
                    </span>
                    <span class="menu-title">Users</span>
                    <span class="menu-suffix">
                      <span class="badge primary">Admin</span>
                    </span>
                  </a>
                </li>
                <!-- <li class="menu-navbar-item">
                <a >
                  <span title="products" class="menu-icon">
                    <i class="fa-solid fa-shop"></i>
                  </span>
                  <span class="menu-title">Products</span>
                  <span class="menu-suffix">
                    <span class="badge primary">Admin</span>
                  </span>
                </a>
              </li> -->
                <!-- start products -->
                <li class="menu-navbar-item sub-menu">
                  <a href="#">
                    <span title="products" class="menu-icon">
                      <i class="fa-solid fa-grip-vertical"></i>
                    </span>
                    <span class="menu-title">Products</span>
                  </a>
                  <div class="sub-menu-list">
                    <ul>
                      <li class="menu-navbar-item">
                        <a href="<?= Url::to(["/products"]) ?>">
                          <span class="menu-title">All Products</span>
                        </a>
                      </li>
                      <li class="menu-navbar-item">
                        <a href="<?= Url::to(["/products/create?subMenu=true"]) ?>">
                          <span class="menu-title">Add New Product</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <!-- END PRODUCTS  -->
                <li class="menu-navbar-item sub-menu">
                  <a href="#">
                    <span title="categories" class="menu-icon">
                      <i class="fa-solid fa-grip-vertical"></i>
                    </span>
                    <span class="menu-title">Categories</span>
                  </a>
                  <div class="sub-menu-list">
                    <ul>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">Manage Categories</span>
                        </a>
                      </li>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">Manage SubCategories</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-navbar-item sub-menu">
                  <a href="#">
                    <span title="theme" class="menu-icon">
                      <i class="fa-regular fa-sun"></i>
                    </span>
                    <span class="menu-title">Theme</span>
                  </a>
                  <div class="sub-menu-list">
                    <ul>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">Dark</span>
                        </a>
                      </li>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">Light</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-navbar-item sub-menu">
                  <a href="#">
                    <span title="change language" class="menu-icon">
                      <i class="fa-solid fa-language"></i>
                    </span>
                    <span class="menu-title">Language</span>
                  </a>
                  <div class="sub-menu-list">
                    <ul>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">English</span>
                        </a>
                      </li>
                      <li class="menu-navbar-item">
                        <a href="#">
                          <span class="menu-title">Arabic</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-header" style="padding-top: 20px"><span> EXTRA </span></li>
                <li class="menu-navbar-item">
                  <a href="#">
                    <span class="menu-icon">
                      <i class="ri-book-2-fill"></i>
                    </span>
                    <span class="menu-title">Documentation</span>
                    <span class="menu-suffix">
                      <span class="badge secondary">Beta</span>
                    </span>
                  </a>
                </li>
                <li class="menu-navbar-item">
                  <a href="#">
                    <span class="menu-icon">
                      <i class="ri-calendar-fill"></i>
                    </span>
                    <span class="menu-title">Calendar</span>
                  </a>
                </li>
                <li class="menu-navbar-item">
                  <a href="#">
                    <span class="menu-icon">
                      <i class="ri-service-fill"></i>
                    </span>
                    <span class="menu-title">Examples</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </aside>
      <div id="overlay" class="overlay"></div>
      <div class="layout" id="main_body">
        <!-- bootstrap -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: aliceblue;border-bottom: 1px solid #ccc;">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse ms-4  justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <?php if (Yii::$app->user->isGuest) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= Url::to(["/site/login"]) ?>">Login</a>
                </li>
              <?php } else { ?>
                <li class="nav-item">
                  <?= Html::csrfMetaTags() ?>
                  <a class="nav-link" href="<?= Url::to(["/site/logout"]) ?>" id="logout_user">Logout</a>
                </li>
              <?php } ?>
              <li class="nav-item active">
                <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#web_documentation">Need help</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" style="display: flex;align-items: center;">
              <input class="form-control mr-sm-2 m-0" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary ms-2 my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>
        <!-- end bootstrao here -->
        <main class="content">
          <a id="btn-toggle" href="#" class="sidebar-toggler break-point-sm ">
            <i class="ri-menu-line ri-xl"></i>
          </a>
          <!-- Loader -->
          <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
          </div>
          <!-- Loader end -->
          <div class="container_body" style="width: -webkit-fill-available;margin:0 auto;">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
              <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
          </div>

          <footer id="footer" class="mt-auto py-3 bg-light">

          </footer>


        </main>
        <div class="overlay"></div>
      </div>
    </div>
  <?php } else { ?>
    <div class="">
      <?= $content ?>

    </div>
  <?php } ?>


  <!-- <header id="header">
    < ?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar fixed-top']
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav '],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header> -->


  <script>
    $(document).on("click", "#logout_user", function(e) {
      e.preventDefault();
      var csrfToken = $('meta[name="csrf-token"]').attr("content");

      $.ajax({
        "type": "POST",
        "url": `<?= Url::to(["site/logout"]) ?>`,
        "headers": {
          "X-CSRF-Token": csrfToken, // Pass the CSRF token in the headers
        },
        "success": (html) => {
          window.location.reload();
        },
        "error": () => {
          alert("something went wrong with logging out");
        }
      })
    })

    //   $(".open-current-submenu ul li:not(.sub-menu) a").on("click", function(e) {
    //     e.preventDefault();
    //     if ($(this).attr("id") == "logout_user") {
    //       return;
    //     }

    //     let href = $(this).attr("href");
    //     isLoading = true;
    //     $(".spinner").show()
    //     $(".container_body").css("transition", "all .2s")
    //     $(".container_body").css("opacity", 0)

    //     $.ajax({
    //       "type": "GET",
    //       "url": `${href}`,
    //       "success": (html) => {
    //         $(".container_body").html("")
    //         $(".container_body").html(html)
    //         $(".container_body").css("opacity", 1)
    //         $(".spinner ").hide()
    //       }
    //     })
    //   })

    //   $(".open-current-submenu ul li div ul li a").on("click", function(e) {
    //     e.preventDefault();
    //     let href = $(this).attr("href");
    //     if ($(this).attr("id") == "logout_user") {
    //       return;
    //     }
    //     isLoading = true;
    //     $(".spinner").show()
    //     $(".container_body").css("transition", "all .2s")
    //     $(".container_body").css("opacity", 0)

    //     $.ajax({
    //       "type": "GET",
    //       "url": `${href}`,
    //       "success": (html) => {
    //         $(".container_body").html("")
    //         $(".container_body").html(html)
    //         $(".container_body").css("opacity", 1)
    //         $(".spinner ").hide()
    //       }
    //     })
    //   })
    // 
  </script>

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>