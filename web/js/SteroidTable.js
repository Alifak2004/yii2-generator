class SteroidTable {
  
  constructor(options) {
    this.table_id = options.table_id;
    this.resizable = options.resizable;
    this.pjax_id = options.pjax_id;
    this.data_provider = options.data_provider;
    this.search_model = options.search_model;
    this.columns = options.columns;
    this.table_name = options.table_name.toLowerCase();
    this.context_id = options.context_id;
    this.active_form_id = options.active_form_id;
    this.primary_key = options.primary_key;
    this.create_id = options.create_id;
    this.style1 = options.style1;
    this.style2 = options.style2;
    this.container_class = options.container_class;
  }

  getgridviewOptions()  {

    return `
    'id' => ${this.table_id},
    "striped" => true,
    "bordered" => false,
    "persistResize" => true,
    'pjax' => true,
    'export' => [
        'label' => 'Export', // The export menu label
        'icon' => 'export', // The glyphicon suffix to be displayed before the label
        'target' => GridView::TARGET_BLANK, // The target for submitting the export form
        'showConfirmAlert' => true, // Whether to show a confirmation alert dialog before download
        'menuOptions' => ['class' => 'dropdown-menu-right'], // HTML attributes for the export dropdown menu
        'itemsBefore' => [
            // Any additional items to be prepended before the export dropdown list
        ],
        'itemsAfter' => [
            // Any additional items to be appended after the export dropdown list
        ],
        'options' => ['class' => 'btn btn-danger '], // HTML attributes for the export menu button
        'encoding' => 'utf-8', // The export output file encoding
        'messages' => [
            'allowPopups' => 'Disable any popup blockers in your browser to ensure proper download.',
            'confirmDownload' => 'Ok to proceed?',
            'downloadProgress' => 'Generating file. Please wait...',
            'downloadComplete' => 'All done! Click anywhere here to close this window, once you have downloaded the file.',
        ],
    ],
    'tableOptions' => [
        'class' => ' custom-loading-table ',
    ],
    'pjaxSettings' => [
    'options' => [
    'id' => '${this.pjax_id}', // ID of the container to refresh
    ],
    ],
    'panel' => [
    'type' => 'transparent',
    'after' => '{pager}',
    'footer' => false
    ],
    'dataProvider' => ${this.data_provider},
    'filterModel' => ${this.search_model},
    'rowOptions' => function ($model, $key, $index, $grid) {
    // Customize the row class based on the model data
    $class = 'custom-row-class';

    // Set data attributes for each row
    $dataAttributes = [
    'data-id' => $model->id,
    ];

    return ['class' => $class] + $dataAttributes;
    },

    'filterModel' => ${this.search_model},
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
      ${this.columns}
    ],
    'responsiveWrap' => true,
    'responsive' => true,
    'hover' => true,
    'resizableColumns' => ${this.resizable},

    'toolbar' => [
    [
    'content' =>
    ButtonDropdown::widget([
    'label' => "Max Cols",
    'dropdown' => [
    'items' => [
    ['label' => '5', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=5'],
    '<div class="dropdown-divider"></div>',
    ['label' => '10', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=10'],
    '<div class="dropdown-divider"></div>',
    ['label' => '20', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=20'],
    '<div class="dropdown-divider"></div>',
    ['label' => '100', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=100'],
    '<div class="dropdown-divider"></div>',
    ['label' => '200', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=200'],
    '<div class="dropdown-divider"></div>',
    ['label' => '500', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=500'],
    '<div class="dropdown-divider"></div>',
    ['label' => '1000', 'url' =>Url::to(["/${this.table_name}/index"]) . '?limit=1000'],
    '<div class="dropdown-divider"></div>',
    ['label' => '2000', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=2000'],
    '<div class="dropdown-divider"></div>',
    ['label' => '3000', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=3000'],
    '<div class="dropdown-divider"></div>',
    ['label' => '5000', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=5000'],
    ],
    ],
    'options' => ['class' => 'btn-outline-primary btn_change_list'],
    'buttonOptions' => ['class' => 'toolbar_btn btn_change_list', "id" => "btn_change_limit"]
    ]) . ' ' .
    
    Html::a('<i class="fas fa-redo"></i>', ["${this.table_name}/index"], [
    'data-pjax' => 1,
    'class' => 'toolbar_btn btn_redo',
    'title' => Yii::t('app', 'Reset Grid')
    ]),
    ],
    '{export}',
    '{toggleData}'
    ],

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


    `
  }
  getTable() {
    let table = `
    <style>
    ${this.style1} {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        border-radius: 8px;
    }

    ${this.style2} {
        position: sticky;
        top: 0;

    }
</style>
`;

table +=`
    <div class="d-flex" style="justify-content:space-between">
    <h1  class="text-dark m-0">Products</h1>

    <button type="button" id="${this.create_id}" class="toolbar_btn ${this.create_id} btn_create float-right" title="Create Products">CREATE  <i class="ps-2 fas fa-plus"></i></button>
    </div>
    <div class="${this.container_class}">

    <h1>${this.table_name.toUpperCase()}</h1>

    <!<?= GridView::widget([
      'id' => ${this.table_id},
      "striped" => true,
      "bordered" => false,
      "persistResize" => true,
      'pjax' => true,
      // 'pjaxSettings'=>[
      //     'neverTimeout'=>true,
      //     'beforeGrid'=>'My fancy content before.',
      //     'afterGrid'=>'My fancy content after.',
      //     "loadingCssClass" => "loadingCssClassddw"
      // ],
      'export' => [
          'label' => 'Export', // The export menu label
          'icon' => 'export', // The glyphicon suffix to be displayed before the label
          'target' => GridView::TARGET_BLANK, // The target for submitting the export form
          'showConfirmAlert' => true, // Whether to show a confirmation alert dialog before download
          'menuOptions' => ['class' => 'dropdown-menu-right'], // HTML attributes for the export dropdown menu
          'itemsBefore' => [
              // Any additional items to be prepended before the export dropdown list
          ],
          'itemsAfter' => [
              // Any additional items to be appended after the export dropdown list
          ],
          'options' => ['class' => 'btn btn-danger '], // HTML attributes for the export menu button
          'encoding' => 'utf-8', // The export output file encoding
          'messages' => [
              'allowPopups' => 'Disable any popup blockers in your browser to ensure proper download.',
              'confirmDownload' => 'Ok to proceed?',
              'downloadProgress' => 'Generating file. Please wait...',
              'downloadComplete' => 'All done! Click anywhere here to close this window, once you have downloaded the file.',
          ],
          // 'exportConfig' => [
          //     GridView::HTML => false, // Exclude the HTML export format
          //     GridView::CSV => false, // Include the CSV export format
          //     GridView::TEXT => false, // Include the TEXT export format
          //     GridView::EXCEL => true, // Include the EXCEL export format
          //     GridView::PDF => true, // Include the PDF export format
          //     GridView::JSON => false, // Include the JSON export format
          // ],
      ],
      'tableOptions' => [
          'class' => ' custom-loading-table ',
      ],
      'pjaxSettings' => [
      'options' => [
      'id' => '${this.pjax_id}', // ID of the container to refresh
      ],
      ],
      'panel' => [
      // 'heading' => '<h3 class="panel-title"><i class=""></i> Products</h3>',
      'type' => 'transparent',
      // 'before' => "dwdww",
      // 'before'=>Html::a('<i class="fas fa-plus"></i> Create Products', ['create'], ['class' => 'btn btn-success']),
      'after' => '{pager}',
      'footer' => false
      ],
      'dataProvider' => ${this.data_provider},
      'filterModel' => ${this.search_model},
      'rowOptions' => function ($model, $key, $index, $grid) {
      // Customize the row class based on the model data
      $class = 'custom-row-class';

      // Set data attributes for each row
      $dataAttributes = [
      'data-id' => $model->id,
      ];

      return ['class' => $class] + $dataAttributes;
      },

      'filterModel' => ${this.search_model},
      'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
        ${this.columns}
      ],
      'responsiveWrap' => true,
      'responsive' => true,
      'hover' => true,
      'resizableColumns' => ${this.resizable},

      'toolbar' => [
      [
      'content' =>
      ButtonDropdown::widget([
      'label' => "Max Cols",
      'dropdown' => [
      'items' => [
      ['label' => '5', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=5'],
      '<div class="dropdown-divider"></div>',
      ['label' => '10', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=10'],
      '<div class="dropdown-divider"></div>',
      ['label' => '20', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=20'],
      '<div class="dropdown-divider"></div>',
      ['label' => '100', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=100'],
      '<div class="dropdown-divider"></div>',
      ['label' => '200', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=200'],
      '<div class="dropdown-divider"></div>',
      ['label' => '500', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=500'],
      '<div class="dropdown-divider"></div>',
      ['label' => '1000', 'url' =>Url::to(["/${this.table_name}/index"]) . '?limit=1000'],
      '<div class="dropdown-divider"></div>',
      ['label' => '2000', 'url' => Url::to(["/${this.table_name}/index"]) .'?limit=2000'],
      '<div class="dropdown-divider"></div>',
      ['label' => '3000', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=3000'],
      '<div class="dropdown-divider"></div>',
      ['label' => '5000', 'url' => Url::to(["/${this.table_name}/index"]) . '?limit=5000'],
      ],
      ],
      'options' => ['class' => 'btn-outline-primary btn_change_list'],
      'buttonOptions' => ['class' => 'toolbar_btn btn_change_list', "id" => "btn_change_limit"]
      ]) . ' ' .
      
      Html::a('<i class="fas fa-redo"></i>', ["${this.table_name}/index"], [
      'data-pjax' => 1,
      'class' => 'toolbar_btn btn_redo',
      'title' => Yii::t('app', 'Reset Grid')
      ]),
      ],
      '{export}',
      '{toggleData}'
      ],

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


      ]); ?>
      
      
    <div class="card" class="contextMenu" id="${this.context_id}" hidden>
    <div class="overlay"></div>
    <ul>
        <li class="context_item">
            <a href="#copy" class="context_link" data-type="copy">
                Copy
            </a>
        </li>
        <li class="context_item">
            <a class="context_link view_row" data-type="view">
                view
            </a>
        </li>
        <li class="context_item">
            <a class="context_link edit_row" data-type="update">
                Update
            </a>
        </li>
        <li class="context_item">
            <a class="context_link user_delete_btn" data-type="delete">
                Delete
            </a>
        </li>
    </ul>
</div>
      
</div>


<script>
    var ROW_CLICKEDBYCONTEXT_ID = -1;
    var row_id_in_edit = -1;
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

    $( "#${this.table_id}").off("click").on("click", function(e) {
        if ($(this).attr("id") !== "contextMenu")
            $("#${this.context_id}").attr("hidden", true).removeAttr("data-id")
    })

    // $("#${this.table_id} .view_row").off("click").on("click", function(e) {
    //     var url = "<?=Url::to(['/${this.table_name}/view']) ?>?ajax=true&${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
    //     let utils = new Utils();
    //     $("#${this.context_id}").attr("hidden", true)
    //     utils.getAjaxData("GET", url, "rtl")
    // })


    $(document).on("contextmenu", ".custom-row-class", function(e) {
        e.preventDefault();
        var row_id = $(this).data("id");
        var posX = e.pageX;
        var posY = e.pageY;

        ROW_CLICKEDBYCONTEXT_ID = $(this).data("id");
        var elem = $("#${this.context_id}").css({
            position: 'absolute',
            top: posY + 'px',
            left: posX + 'px'
        }).removeAttr("hidden").attr("data-id", row_id).addClass("contextMenu");

        // $("body").append(elem);
        // $('body').append(elem);
    })


    var active_form_id = "#${this.active_form_id}";


    $("#${this.context_id}").off("click").on("click", function() {
      let type = $(this).data("type")
      alert(type)
      switch(type) {
        case "copy":

          break;
        case "delete":
          e.preventDefault();


          $("#${this.context_id}").attr("hidden", true)
          var curr_item = $(this);
          var utils = new Utils("Row deleted successfuly");
  
          if(submitted) {
              return;
          }
          submitted = true;
  
  
          Swal.fire({
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
                      var url = "<?= Url::to(['${this.table_name}/delete']) ?>?${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
                      var method = "DELETE"
                      utils.submitAjaxData(method, url, null, active_form_id,  function(val) {
              submitted = val;
          });
                  }
              submitted = false;
              });
              
          break;
        case "view":
          var url = "<?=Url::to(['/${this.table_name}/view']) ?>?ajax=true&${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
        let utils = new Utils();
        $("#${this.context_id}").attr("hidden", true)
        utils.getAjaxData("GET", url, "rtl")

          break;
        case "update":

          var utils = new Utils();

          iseditmode = true;
          if (ROW_CLICKEDBYCONTEXT_ID === -1) {
              return;
          }

          $("#${this.context_id}").attr("hidden", true)
          row_id_in_edit = ROW_CLICKEDBYCONTEXT_ID;

          let url = "<?=Url::to(['${this.table_name}/update']) ?>" + "?${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
          let method = "GET";

          utils.getAjaxData(method, url);
          break;
      }
    })
    // $("#${this.context_id} .edit_row").off("click").on("click", function(e) {
    //     var utils = new Utils();

    //     iseditmode = true;
    //     if (ROW_CLICKEDBYCONTEXT_ID === -1) {
    //         return;
    //     }


    //     $("#${this.context_id}").attr("hidden", true)
    //     row_id_in_edit = ROW_CLICKEDBYCONTEXT_ID;

    //     let url = "<?=Url::to(['${this.table_name}/update']) ?>" + "?${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
    //     let method = "GET";

    //     utils.getAjaxData(method, url);
    // })



    $(document).off("click").on("click", "#cancel_btn", function() {
        swal.close();
    })

    $("#${this.create_id}").off("click").on("click" , () => {
        var utils = new Utils();

        var url = "<?=Url::to(['/${this.table_name}/create']) ?>";
        var method = "GET";
        utils.getAjaxData(method, url);

    })


    // on submit create or update forms
    var submitted = false;

    $(document).off("submit").on("submit", active_form_id, function(e) {
        e.preventDefault();
        var submit_row_id = row_id_in_edit != -1 ? row_id_in_edit : -1;
        if (submit_row_id == -1 && iseditmode) return;
        var utils = new Utils("row \${iseditmode ? "updated" : "added"} successfuly");

        $(this).find(':submit').prop('disabled', true);

        // check if update or create is happening
        var url = iseditmode ? ("<?= Url::to(['${this.table_name}/update']) ?>?${this.primary_key}=" + submit_row_id) : "<?= Url::to(['${this.table_name}/create']) ?>"        // serialise the form data

        
        if(submitted) {
            return;
        }
        submitted = true;

        var data = $(this).serialize();

        // set the method
        var method = "POST";
        // table reload id to reload using pjax
        var reload_id = "crud-datatable-reloaded-Products";

        // in utils folder
        utils.submitAjaxData(method, url, data, reload_id, active_form_id, function(val) {
            submitted = val;
        });
    })

    // $(document).off("click").on("click", "#${this.context_id} .user_delete_btn", function(e) {
    //     e.preventDefault();


    //     $("#${this.context_id}").attr("hidden", true)
    //     var curr_item = $(this);
    //     var utils = new Utils("Row deleted successfuly");

    //     if(submitted) {
    //         return;
    //     }
    //     submitted = true;


    //     Swal.fire({
    //             title: 'Are you sure?',
    //             text: "Once deleted, you will not be able to recover it! #" + ROW_CLICKEDBYCONTEXT_ID,
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes, delete it!'
    //         })
    //         .then((result) => {
    //             if (result.isConfirmed) {
    //                 var url = "<?= Url::to(['${this.table_name}/delete']) ?>?${this.primary_key}=" + ROW_CLICKEDBYCONTEXT_ID;
    //                 var method = "DELETE"
    //                 utils.submitAjaxData(method, url, null, active_form_id,  function(val) {
    //         submitted = val;
    //     });
    //             }
    //         submitted = false;
    //         });
    // })
</script>

      `;
    return table;
  }
}
