class CustomLoadingCellRenderer {
  init(params) {
    this.eGui = document.createElement("div");
    this.eGui.innerHTML = `
          <div class="ag-custom-loading-cell" style="padding-left: 10px; line-height: 25px;">  
              <i class="fas fa-spinner fa-pulse"></i> 
              <span>${params.loadingMessage} </span>
          </div>
      `;
  }

  getGui() {
    return this.eGui;
  }
}

class SteroidDatable {
  constructor({
    columnDefs,
    rowData,
    table_name,
    primary_key,
    filter,
    contextmenu,
    active_form_id,
  }) {
    this.columnDefs = columnDefs;
    this.suppressDragLeaveHidesColumns = true;
    this.defaultColDef = {
      flex: 1,
      minWidth: 100,
      // width: 150,
      floatingFilter: true,
      sortable: true,
      filter: true,
      resizable: true,
    };
    // this.sideBar = sideBar;
    this.suppressExcelExport = true;
    this.table_name = table_name;
    this.filter = filter;
    this.primary_key = primary_key;
    this.animateRows = true;
    this.suppressColumnVirtualisation = true;
    this.suppressRowVirtualisation = true;
    this.rowGroupPanelShow = "always";
    this.pivotPanelShow = "always";
    this.pagination = true;
    this.contextmenu = contextmenu;
    this.generateDatagrid(), (this.paginationPageSize = 20);
    // this.autoGroupColumnDef = autoGroupColumnDef;
    this.rowData = rowData;
    this.row_id = 0;
    this.active_form_id = active_form_id;
  }

  // dropdown-menu-toggleColumns
  //   getAllColumns() {

  //   var allColumns = this.gridOptions.columnApi.getAllColumns();
  //   console.log(allColumns);
  //   allColumns.forEach(item => {
  //     var li = $("<li>", {
  //     }).html($("<label>", {
  //       "class" : "dropdown-item",
  //     }).html($(
  //       "<input/>", {
  //         "type": "checkbox",
  //         "class" : "me-2",
  //         "id" : `${item.colId}`,
  //         "checked" : true,
  //         "onChange": `toggleColumn('${item.colId}')`
  //       }
  //   )).append(item.colId)).appendTo(".dropdown-menu-toggleColumns")

  //   })
  //   // $(".dropdown-menu-toggleColumns");
  // }

  static ImportExcelSheet({datatable, data}) {
    // our data is in the first sheet
    var firstSheetName = data.SheetNames[0];
    var worksheet = data.Sheets[firstSheetName];

    // we expect the following columns to be present
    var columns = {
      A: "athlete",
      B: "age",
      C: "country",
      D: "year",
      E: "date",
      F: "sport",
      G: "gold",
      H: "silver",
      I: "bronze",
      J: "total",
    };

    // var rowData = [];

    // start at the 2nd row - the first row are the headers
    var rowIndex = 2;

    // iterate over the worksheet pulling out the columns we're expecting
    while (worksheet["A" + rowIndex]) {
      var row = {};
      Object.keys(columns).forEach(function (column) {
        row[columns[column]] = worksheet[column + rowIndex].w;
      });

      rowData.push(row);

      rowIndex++;
    }

    // finally, set the imported rowData into the grid
    datatable.api.setRowData(rowData);
  }

  static getRowPerPageSelector({datatable}) {
    var html = $(`
      <select id="columnsPerPage" class="form-select d-inline-block" style="width:max-content;">
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="400">400</option>
        <option value="600">600</option>
        <option value="800">800</option>
      </select>
    `);

    // Use the correct id "#columnsPerPage" instead of "columnsPerPage "
    $(html).on("change", function () {
      var selectedValue = this.value;
      datatable.api.paginationSetPageSize(selectedValue);
    });

    return html;
  }

  static createRow() {
    $("#add_new" + this.table_name)
      .off("click")
      .on("click", () => {
        var utils = new Utils();

        var url = "<?=Url::to(['/products/create']) ?>";
        var method = "GET";
        utils.getAjaxData(method, url);
      });
  }
  static toggleColumn({datatable, columnId}) {
    var column = datatable.columnApi.getColumn(columnId);
    column.visible = !column.isVisible();
    var allColumns = datatable.columnApi.getColumns();

    var updatedColumnDefs = allColumns.map(function (col) {
      return {
        ...col.colDef,
        hide: !col.visible, // Use hide property to toggle visibility
      };
    });

    // Apply the updated column definitions
    datatable.api.setColumnDefs(updatedColumnDefs);
    datatable.api.sizeColumnsToFit({
      defaultMinWidth: 150,
    });
  }

  generateDatagrid() {
    this.gridOptions = {
      columnDefs: this.columnDefs,
      // onCellContextMenu: this.onRowClickeddd,
      onCellContextMenu: this.onCellContextMenu.bind(this),
      loadingCellRenderer: CustomLoadingCellRenderer,
      loadingCellRendererParams: {
        loadingMessage: "One moment please...",
      },
      suppressDragLeaveHidesColumns: this.suppressDragLeaveHidesColumns,

      defaultColDef: this.defaultColDef,
      // sideBar: this,
      suppressExcelExport: this.suppressExcelExport,
      // rowSelection: 'multiple', // allow rows to be selected
      animateRows: true, // have rows animate to new positions when sorted
      // onCellClicked: params => {
      //   // alert("CLICK")
      //   console.log('cell was clicked', params)
      // },

      // load columns when observed
      suppressColumnVirtualisation: this.suppressColumnVirtualisation,
      suppressRowVirtualisation: this.suppressRowVirtualisation,

      // rowGroupPanelShow: 'always',
      // pivotPanelShow: 'always',
      pagination: this.pagination,
      paginationPageSize: this.paginationPageSize, // Set the maximum number of rows per page
      // suppressPaginationPanel: true,  // Optionally hide the default pagination panel
      // autoGroupColumnDef: this.autoGroupColumnDef,

      rowData: this.rowData,
    };

    var this_var = this;
    $.contextMenu({
      selector: this.contextmenu,
      autoHide: true,
      // trigger: "contextmenu",
      build: function ($trigger, e) {
        // this callback is executed every time the menu is to be shown
        // its results are destroyed every time the menu is hidden
        // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
        // console.log($trigger)
        return {
          callback: function (key, options) {
            this_var.contextmenuCallback(key);
          },
          items: {
            edit: {name: "Edit", icon: "fa-edit"},
            copy: {name: "Copy", icon: "fa-copy"},
            delete: {name: "Delete", icon: "fa-trash"},
            view: {name: "View", icon: "fa-eye"},
            sep1: "---------",
            // quit: {
            //   name: "Quit",
            //   icon: function ($element, key, item) {
            //     return "context-menu-icon context-menu-icon-quit";
            //   },
            // },
          },
        };
      },
    });

    return this.gridOptions;
  }

  contextmenuCallback(key) {
    let utils = new Utils();
    switch (key) {
      case "edit":
        url = "sellcity.local/products/update?ajax=true&id=" + this.row_id;
        let method = "GET";

        utils.getAjaxData(method, url);

        break;

      case "view":
        var url = "sellcity.local/products/view?ajax=true&id=" + this.row_id;
        // $("#11415381087").attr("hidden", true)
        utils.getAjaxData("GET", url, "rtl");
        break;

      case "delete":
        // e.preventDefault();

        $("#11415381087").attr("hidden", true);
        var curr_item = $(this);
        utils = new Utils("Row deleted successfuly");

        // if(submitted) {
        //     return;
        // }
        // submitted = true;

        var active_id_this = this.active_form_id;
        Swal.fire({
          title: "Are you sure?",
          text:
            "Once deleted, you will not be able to recover it! #" + this.row_id,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            var url =
              "http://localhost/sellcity/web/products/delete?id=" + this.row_id;
            var method = "DELETE";
            utils.submitAjaxData(
              method,
              url,
              null,
              active_id_this,
              function (val) {
                // submitted = val;
              }
            );
          }
          // submitted = false;
        });

        break;
      case "copy":
        break;

      default:
        break;
    }
  }

  static getAllColumnss(gridOptions) {
    // console.log(this.gridOptions);
    // return this.gridOptions;
    var allColumns = gridOptions.columnApi.getAllColumns();
    // console.log(allColumns);
    var ul = $("<ul>", {
      class: "dropdown-menu-toggleColumns dropdown-menu",
    });
    allColumns.forEach((item) => {
      var li = $("<li>", {})
        .html(
          $("<label>", {
            class: "dropdown-item",
          })
            .html(
              $("<input/>", {
                type: "checkbox",
                class: "me-2",
                id: `${item.colId}`,
                checked: true,
                onChange: `toggleColumn('${item.colId}')`,
              })
            )
            .append(item.colId)
        )
        .appendTo(ul);
    });
    return ul;
  }

  onCellContextMenu(e) {
    // e.preventDefault()
    // alert("CLICKED")
    // Get the row data from the event
    var row_id = e.data.id;

    var posX = e.event.clientX;
    var posY = e.event.clientY;

    // console.log($(e.event.target)[0].className.split(" ")[0]);
    //   this.contextmenu.css({
    //     position: 'absolute',
    //     top: posY + 'px',
    //     left: posX + 'px'
    // }).removeAttr("hidden").attr("data-id", row_id);
    const currentURL = window.location.href;
    this.row_id = row_id;
    // $(e.event.target).trigger('contextmenu');

    // $("." + $(e.event.target)[0].className.split(" ")[0]).trigger(
    //   "contextmenu"
    // );
    // console.log(this.contextmenu)
    // $(".contextMenu")
    // console.log(e)
    // context_menu
    // Assuming your row data has an 'id' property, you can access the row ID like this
    // const rowId = rowData.id;

    // Do whatever you want with the row ID or data
    // console.log("Row ID:", rowId);
    // console.log("Row Data:", rowData);
  }
}
