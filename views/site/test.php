<h2>Hello Ag Grid</h2>
<button class="btn btn-primary" id="btn_export">Export(CSV file EXCELL)</button>
<button class="btn btn-danger" onclick="importExcel()">Populate (import excell file)</button>
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Show/Hide Columns
  </button>
</div>
<button class="btn btn-dark d-dipslay-block" id="add_new_product">Add New Product</button>
<div id="myGrid" class="ag-theme-material" style="height:90vh;max-height:100vh;margin: 1rem auto 0 auto"></div>
<script type="text/javascript">
  
  var dd;
  
  $(document).ready(() => {
   
  })
  $("#columnsPerPage").on('change', function() {
    // var selectedValue = this.value;
    // dd.api.paginationSetPageSize(selectedValue);
  });
 

  // var numberValueFormatter = function (params) {
  //   return params.value.toFixed(2);
  // };

  // const aggrid = document.getElementById("mygrid");



  function onBtnUpdate() {
    document.querySelector('#csvResult').value = gridOptions.api.getDataAsCsv();
  }

  // class CustomLoadingCellRenderer {
  //   init(params) {
  //     this.eGui = document.createElement('div');
  //     this.eGui.innerHTML = `
  //           <div class="ag-custom-loading-cell" style="padding-left: 10px; line-height: 25px;">  
  //               <i class="fas fa-spinner fa-pulse"></i> 
  //               <span>${params.loadingMessage} </span>
  //           </div>
  //       `;
  //   }

  //   getGui() {
  //     return this.eGui;
  //   }
  // }





  // IMPORT EXCELL
  // pull out the values we're after, converting it into an array of rowData
  function populateGrid(workbook) {
    // our data is in the first sheet
    var firstSheetName = workbook.SheetNames[0];
    var worksheet = workbook.Sheets[firstSheetName];

    // we expect the following columns to be present
    var columns = {
      A: 'athlete',
      B: 'age',
      C: 'country',
      D: 'year',
      E: 'date',
      F: 'sport',
      G: 'gold',
      H: 'silver',
      I: 'bronze',
      J: 'total',
    };

    // var rowData = [];

    // start at the 2nd row - the first row are the headers
    var rowIndex = 2;

    // iterate over the worksheet pulling out the columns we're expecting
    while (worksheet['A' + rowIndex]) {
      var row = {};
      Object.keys(columns).forEach(function(column) {
        row[columns[column]] = worksheet[column + rowIndex].w;
      });

      rowData.push(row);

      rowIndex++;
    }

    // finally, set the imported rowData into the grid
    gridOptions.api.setRowData(rowData);
  }



  function importExcel() {
    makeRequest(
      'GET',
      'https://www.ag-grid.com/example-assets/olympic-data.xlsx',
      // success
      function(data) {
        var workbook = convertDataToWorkbook(data);

        SteroidDatable.importExcelSheet({datatable:dd,data:workbook});
      },
      // error
      function(error) {
        throw error;
      }
    );
  }




  // ENDD------------

  // var autoGroupColumnDef = {
  //   headerName: 'Group',
  //   minWidth: 170,
  //   field: 'model',
  //   valueGetter: (params) => {
  //     if (params.node.group) {
  //       return params.node.key;
  //     } else {
  //       return params.data[params.colDef.field];
  //     }
  //   },
  // };

  function toggleColumn(columnId) {
    console.log(dd)
    SteroidDatable.toggleColumn({datatable:dd,columnId})
  }

  $(document).ready(() => {
    const columns = <?= json_encode($columns) ?>;
    
    let columns_object = [];
    columns.forEach((item) => {
      columns_object.push({
        field: item,
      });
    });

    console.log(columns_object);
    dd = new SteroidDatable({
      columnDefs: columns_object,
      contextmenu: ".ag-center-cols-container",
      rowData: <?= json_encode($data) ?>,
      table_name: "products",
      filter: "",
      primary_key: "id",
      active_form_id: "#active_form_Products"
    });
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, dd);

    $("#btn_export").on("click", () => {
      dd.api.exportDataAsCsv();
    })
    
    $(".dropdown-toggle").after(SteroidDatable.getAllColumnss(dd));

    $("#myGrid").on("contextmenu", (e) => {
      e.preventDefault();
    })

    var html = SteroidDatable.getRowPerPageSelector({datatable:dd});
    $(".btn-group").after(html);

    dd.api.sizeColumnsToFit({
      defaultMinWidth: 150,
    });

  });
  // new agGrid.Grid(aggrid, gridOptions);
</script>