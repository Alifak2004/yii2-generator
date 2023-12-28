class FancySelect {
  static getSelect2({ multiple, data, parent, select_id, url }) {

    console.log("IAMG EHREEEE")
    console.log($(parent))
    $(select_id).select2({
      dropdownParent: $(parent),
      multiple,
      closeOnSelect: false,
      // ajax: {
      //   url: url,
      //   type: "GET",
      //   dataType: 'json',
      //   data: function (params) {
      //     return {
      //       page: params.page || 1,
      //       q: params.term || null,
      //       key: "id",
      //       representative_field: "name",
      //       table: "products",
      //       condition: ""
      //     };
      //   },
      //   processResults: function (data, params) {
      //     // Process the received data and convert it to Select2-compatible format
      //     var results = [];
      //     $.each(data.results , function (index, item) {
      //       results.push({
      //         id: item.id,
      //         text: item.text
      //       });
      //     });
          
      //     console.log(results)
      //     // Return the formatted results to Select2
      //     return {
      //       results: results,
      //       pagination: {
      //         more: data.pagination.more
      //       }
      //     };
      //   },
      // },
      minimumResultsForSearch: 10,
      placeholder: 'Select a state...',
      allowClear: true
    });

    if (data && data.length > 0) {
      $(select_id).val(data).trigger('change');
    }
  }
}
