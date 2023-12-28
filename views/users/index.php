<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\gridView;
use kartik\growl\Growl;
// use yii\grid\GridView;
use kartik\cmenu\ContextMenu;
use yii\bootstrap5\ButtonDropdown;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
// $this->params['breadcrumbs'][] = $this->title;

// init contextmenu

// Display a context menu on right-click


?>

<style>
    #crud-datatable-force-reloaded-container {
        max-height: 80vh;
        overflow: auto;
    }

    thead.crud-datatable-force-reloaded {
        position: sticky;
        top: 0;
    }

    .users-index {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        border-radius: 8px;
    }

    .context-menu-column {
        position: relative;
        display: inline-block;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #fff;
        cursor: pointer;
    }

    .context-menu-column:before {
        content: '';
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        border-right: 5px solid #ccc;
    }
</style>
<div class="users-index">

    <!-- <h1>< ?= Html::encode($this->title) ?></h1> -->

    <p>
        <!-- < ?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'id' => 'crud-datatable-force-reloaded',
        "striped" => true,
        "bordered" => false,
        // "class" => "my-context-menu",
        "persistResize" => true,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'crud-datatable-pjax-users', // ID of the container to refresh
            ],
        ],

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fas fa-user"></i> Users</h3>',
            'type' => 'light',
            // 'before'=>Html::a('<i class="fas fa-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
            'after' => '{pager}',
            'footer' => false
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // HERE
        'rowOptions' => function ($model, $key, $index, $grid) {
            // Customize the row class based on the model data
            $class = 'custom-row-class';

            // Set data attributes for each row
            $dataAttributes = [
                'data-id' => $model->user_id,
            ];

            return ['class' => $class] + $dataAttributes;
        },

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'user_id',
            'user_name',
            'first_name',
            'last_name',
            'birth_date',
            //'email:email',
            //'last_url:url',
            //'password',
            //'created_at',
            //'created_by',
            //'address',
            //'phone',
            //'zip_code',
            //'role',

            // ['class' => 'yii\grid\ActionColumn'],

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header' => 'Actions',
            //     'template' => '{view}{update}{delete}',
            //     'buttons' => [
            //         'view' => function ($url, $model) {
            //             return Html::a('<i class="fa fa-eye"></i>', ['users/view', 'user_id' => $model->user_id], ['title' => 'View', 'data-toggle' => 'tooltip', 'data-pjax' => 0]);
            //         },
            //         'update' => function ($url, $model) {
            //             return Html::button('<span class="fas fa-pencil"></span>', [
            //                 "data" => [
            //                     "pjax" => 1,
            //                     "id" => $model->user_id
            //                 ],
            //                 'data-toggle' => 'tooltip',
            //                 "class" => "edit_row"
            //             ]);
            //         },
            //         'delete' => function ($url, $model) {
            //             return Html::button('<span class="fas fa-trash"></span>', [
            //                 'data' => [
            //                     'pjax' => 1,
            //                     'id' => $model->user_id,
            //                 ],
            //                 'data-toggle' => 'tooltip',
            //                 "class" => "btn_conv_link user_delete_btn"
            //             ]);
            //         },
            //     ],
            // ]
        ],
        'responsiveWrap' => true,
        'responsive' => true,
        "pjax" => true,
        'hover' => true,
        'resizableColumns' => true,
        // 'toolbarOptions' => [
        //     'skip-export-json' => true,
        // ],

        'toolbar' => [
            [
                'content' =>
                ButtonDropdown::widget([
                    'label' => "Max Cols",
                    'dropdown' => [
                        'items' => [
                            ['label' => '5', 'url' => Url::to(["/users/index"]) . '?limit=5'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '10', 'url' => Url::to(["/users/index"]) . '?limit=10'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '15', 'url' =>  Url::to(["/users/index"]) . '?limit=15'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '20', 'url' =>  Url::to(["/users/index"]) . '?limit=20'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '25', 'url' =>  Url::to(["/users/index"]) . '?limit=25'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '30', 'url' =>  Url::to(["/users/index"]) . '?limit=30'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '35', 'url' =>  Url::to(["/users/index"]) . '?limit=35'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '40', 'url' =>  Url::to(["/users/index"]) . '?limit=40'],
                            '<div class="dropdown-divider"></div>',
                            ['label' => '50', 'url' =>  Url::to(["/users/index"]) . '?limit=50'],
                        ],
                    ],
                    'options' => ['class' => 'btn-outline-primary btn_change_list'],
                    'buttonOptions' => ['class' => 'toolbar_btn btn_change_list', "id" => "btn_change_limit"]
                ]) . ' ' .
                    Html::button('<i class="fas fa-plus"></i>', [
                        'type' => 'button',
                        'title' => Yii::t('app', 'Create User'),
                        'class' => 'toolbar_btn btn_create',
                        "id" => "btn_create_user"
                    ]) . ' ' .
                    Html::a('<i class="fas fa-redo"></i>', ['users/index'], [
                        'data-pjax' => 1,
                        'class' => 'toolbar_btn btn_redo',
                        'title' => Yii::t('app', 'Reset Grid')
                    ]),
            ],
            '{export}',
            '{toggleData}',
        ],

        // 'pager' => [
        //     // 'options' => ['class' => 'pagination'], // CSS class for the pager container
        //     // 'prevPageLabel' => 'Previous', // Label for the previous page link
        //     // 'nextPageLabel' => 'Next', // Label for the next page link
        //     'maxButtonCount' => 5, // Maximum number of page buttons to display
        // ],
        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'], // CSS class for the pager container
            'prevPageCssClass' => 'page-item ',
            'nextPageCssClass' => 'page-item ',
            'prevPageLabel' => '<span aria-hidden="true">&laquo;</span>',
            'nextPageLabel' => '<span aria-hidden="true">&raquo;</span>',
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
            'activePageCssClass' => 'active2', // CSS class for the current page number
        ],
        'toggleDataContainer' => ['class' => 'btn_create_toggle '],
        'exportContainer' => ['class' => 'btn_create_export ']

    ]);

    ?>

    <!-- < ?php     ContextMenu::end();?> -->

    <div class="card " class="contextMenu" id="contextMenu" hidden>
        <div class="overlay"></div>
        <ul>
            <li class="context_item">
                <a href="#copy" class="context_link">
                    Copy
                </a>
            </li>
            <li class="context_item">
                <a class="context_link view_row">
                    view
                </a>
            </li>
            <li class="context_item">
                <a class="context_link edit_row">
                    Update
                </a>
            </li>
            <li class="context_item">
                <a class="context_link user_delete_btn">
                    Delete
                </a>
            </li>
        </ul>
    </div>

    <!-- <div class="context_item">
        <div class="inner_item">Copy</div>
    </div>
    <div class="context_item">
        <div class="inner_item">Cut</div>
    </div>
    <div class="context_item">
        <div class="inner_item">Paste</div>
    </div>
    <div class="context_hr"></div>
    <div class="context_item">
        <div class="inner_item">Share</div>
    </div>
    <div class="context_item">
        <div class="inner_item">Delete</div>
    </div>
    </div> -->




    <script>
        var ROW_CLICKEDBYCONTEXT_ID = -1;
        // copy text to clipboard
        function copyTextToClipboard(text) {
            // Create a temporary input element
            const input = document.createElement("input");
            input.value = text;
            document.body.appendChild(input);

            // Select the text
            input.select();
            input.setSelectionRange(0, input.value.length);

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Remove the temporary input element
            document.body.removeChild(input);
        }

        $(document).on("click", "#crud-datatable-force-reloaded", function(e) {
            if ($(this).attr("id") !== "contextMenu")
                $("#contextMenu").attr("hidden", true).removeAttr("data-id")
        })

        $(".view_row").on("click", function(e) {
            var url = "<?= Url::to(["/users/view"]) ?>?user_id=" + ROW_CLICKEDBYCONTEXT_ID;
            let util = new Utils();
            $("#contextMenu").attr("hidden", true)
            utils.getAjaxData("GET", url, "rtl")
        })


        $(document).on("contextmenu", ".custom-row-class", function(e) {
            e.preventDefault();
            var row_id = $(this).data("id");
            var posX = e.pageX;
            var posY = e.pageY;

            ROW_CLICKEDBYCONTEXT_ID = $(this).data("id");
            var elem = $("#contextMenu").css({
                position: 'absolute',
                top: posY + 'px',
                left: posX + 'px'
            }).removeAttr("hidden").attr("data-id", row_id).addClass("contextMenu");

            // $("body").append(elem);
            // $('body').append(elem);
        })




        // var create_id = ".users-create"
        // var update_id = ".users-update"

        var active_form_id = "#active_form_id";

        $(document).on("click", ".edit_row", function(e) {
            var utils = new Utils();

            iseditmode = true;
            if (ROW_CLICKEDBYCONTEXT_ID === -1) {
                return;
            }


            $("#contextMenu").attr("hidden", true)
            user_id_in_edit = ROW_CLICKEDBYCONTEXT_ID;

            let url = "<?= Url::to(['users/update']) ?>" + "?user_id=" + ROW_CLICKEDBYCONTEXT_ID;
            let method = "GET";

            utils.getAjaxData(method, url);
        })



        $(document).on("click", "#cancel_btn", function() {
            swal.close();
        })

        $(document).on("click", "#btn_create_user", () => {
            var utils = new Utils();

            var url = "<?= Url::to(['/users/create']) ?>";
            var method = "GET";
            utils.getAjaxData(method, url);

            // $.ajax({
            //     url: "< ?= Url::to(['/users/create']) ?>",
            //     method: 'GET',
            //     data: {
            //         param1: 'value1',
            //         param2: 'value2'
            //     },
            //     success: function(html) {

            //         Swal.fire({
            //             showClass: {
            //                 popup: 'animate__animated animate__fadeInUpBig animate__faster'
            //             },
            //             hideClass: {
            //                 popup: 'animate__animated animate__fadeOutDownBig animate__faster'
            //             },
            //             customClass: {
            //                 container: 'full-width-alert'
            //             },
            //             // title: 'Create New',
            //             // text: "Once deleted, you will not be able to recover it! #",
            //             html: html,
            //             // icon: 'info',
            //             showCancelButton: false,
            //             showConfirmButton: false,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'Yes, delete it!'
            //         })

            //     },
            //     error: function(xhr, status, error) {
            //         // Handle the error
            //         console.error(error);
            //     }
            // });


        })


        // on submit create or update forms
        $(document).on("submit", "#active_form_id", function(e) {
            e.preventDefault();
            var user_id = user_id_in_edit != -1 ? user_id_in_edit : -1;
            if (user_id == -1 && iseditmode) return;

            var utils = new Utils(`row ${iseditmode ? "updated" : "added"} successfuly`);
            // check if update or create is happening
            var url = iseditmode ? ("<?= Url::to(['users/update']) ?>?user_id=" + user_id) : "<?= Url::to(['users/create']) ?>"
            // serialise the form data

            // Create an empty object to store the form data including checkboxes
            var formData = {};

            // Iterate over the form elements
            $(this).find(":input").each(function() {
                var name = $(this).attr("name");
                var value = $(this).val();

                // For checkboxes, add the checked ones to the formData object
                if ($(this).is(":checkbox") && $(this).is(":checked")) {
                    formData[name] = value;
                } else {
                    formData[name] = value;
                }
            });
            var data = $.param(formData);

            // var data = $(this).serialize();

            // set the method
            var method = "POST";
            // table reload id to reload using pjax
            var reload_id = "crud-datatable-pjax-users";
            // in utils folder
            utils.submitAjaxData(method, url, data, reload_id, active_form_id);
        })

        // $(".user_delete_btn").on("click", function(e) {
        $(document).on("click", ".user_delete_btn", function(e) {
            e.preventDefault();


            $("#contextMenu").attr("hidden", true)
            var curr_item = $(this);
            var utils = new Utils("Row deleted successfuly");


            Swal.fire({
                    // showClass: {
                    //     popup: 'animate__animated animate__fadeInUpBig '
                    // },
                    // hideClass: {
                    //     popup: 'animate__animated animate__fadeOutDown animate__faster'
                    // },
                    title: 'Are you sure?',
                    text: "Once deleted, you will not be able to recover it! #" + ROW_CLICKEDBYCONTEXT_ID,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url = "<?= Url::to(['users/delete']) ?>?user_id=" + ROW_CLICKEDBYCONTEXT_ID;
                        var method = "DELETE"
                        utils.submitAjaxData(method, url, null, "crud-datatable-pjax-users");
                        return;
                        // $.ajax({
                        //     method: 'POST', // The HTTP method (e.g., GET, POST, PUT, DELETE)
                        //     url,

                        //     success: function(response) {
                        //         if (response == 1) {
                        //             curr_item.closest("tr").remove();
                        //             swal.fire("Poof! Your item has been deleted successfully!", {
                        //                 on: "success",
                        //             });
                        //             Swal.fire({
                        //                 icon: 'success',
                        //                 title: "Poof! Your item has been deleted successfully!",
                        //             })

                        //         } else {
                        //             Swal.fire({
                        //                 icon: 'error',
                        //                 title: 'Oops...',
                        //                 text: 'Something went wrong ! Refresh the page and try again :)',
                        //                 footer: '<a href="">Why do I have this issue?</a>'
                        //             })
                        //         }
                        //     },
                        //     error: function(xhr, status, error) {
                        //         console.log('Error:', error);
                        //     }
                        // });

                    }
                });
        })
    </script>