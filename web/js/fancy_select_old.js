class fancySelect {
  static getSelect2({
    label,
    values,
    multiple,
    init_key = 0,
    init_val = 0,
    parent,
    url,
    condition,
    table,
    representative_field,
    key,
  }) {
    let html = "";

    let lis = [];
    var currentPage = 1; // Current page number
    var isLoading = false; // Flag to prevent multiple simultaneous requests
    var itemsPerPage = 10; // Number of items to show per page
    var dropdown = $("#custom_dropdown_af"); // Replace with your actual dropdown element selector

    $.ajax({
      url: url,
      type: "GET",
      data: {
        page: currentPage,
        q: null,
        key,
        representative_field,
        table,
        condition,
      },
      beforeSend: function () {
        isLoading = true;
        // Display a loading message or spinner
        // Add a loading indicator to indicate that more items are being loaded
      },
      success: function (response) {
        // Process the response and append the new items to the dropdown
        // Replace this with your code to append the new items to the dropdown

        lis = response.results;
        isLoading = false; // Reset the loading flag

        lis = lis.map((item) => {
          return `<li class='dropdown-item'><label><input type='checkbox' class=' me-2 visually-hidden' name='${item.text}' value='${item.id}'>${item.text}</label></li>`;
        });

        if (multiple == true) {
          html += `
        <div class="dropdown form_group_updated" name="${label.toLowerCase()}[]">
        <label class="control-label pb-2" for="users-first_name">${label}</label>
          <div type="text"  class="btn form_updated form_input btn-sm dropdown-toggle" id="dd2133" data-bs-toggle="dropdown" aria-expanded="false"  style="width: 100%;">
          </div>
          <ul id="custom_dropdown_af" class="dropdown-menu custom_dropdown_af dropdown_menu_all" aria-labelledby="dd2133">
            <li class="dropdown-item">
              <input type="text" class="form-control" placeholder="Search..." id="company_input">
            </li>
            ${lis.join("")}
          </ul>
      </div>
      `;
        } else {
          html += `
        <div class="dropdown form_group_updated" name="${label.toLowerCase()}[]">
        <label class="control-label pb-2" for="users-first_name">${label}</label>
          <div class="btn form_updated form_input btn-sm dropdown-toggle" type="text" id="dd2133" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">

          </div>
          <ul id="custom_dropdown_af" class="dropdown-menu custom_dropdown_af dropdown_menu_all" aria-labelledby="dd2133">
            <li class="dropdown-item">
              <input type="text" class="form-control" placeholder="Search..." id="company_input">
            </li>
            ${lis.join("")}
            </ul>
        </div>
      `;
        }

        html += `
    <script>
      function filterDropdown(input, dropdown) {
        var inputValue = input.value.toLowerCase(); // Get the input value and convert to lowercase
        $(dropdown + ' li:not(:first-child)').filter(function() { // Filter all list items except the first one the
          $(this).toggle($(this).text().toLowerCase().indexOf(inputValue) > -1) // Show/hide based on the text matching the input value
        });
      }

      $(document).ready(function() {
        // When the user types in the search input
        $('#company_input').on('keyup', function() {
          // filterDropdown(this, ".custom_dropdown_af");
        });

        // When a dropdown item is clicked
      });
      
      $(".dropdown-item:not(:first-child)").on("click", function(event) {
        event.stopPropagation(); // Prevent event bubbling
        event.preventDefault();

        console.log($(this))
        const checkbox = $(this).find("input");
        const value = checkbox.val();
        const name = checkbox.attr("name");
      
        if (checkbox.is(":checked")) {
          checkbox.prop("checked", false);
          $("#dd2133 span[data-id='" + value + "']").remove();
        } else {
          checkbox.prop("checked", true);
          const selectedOption = $("<span>").attr("data-id", value).text(name).addClass("dropdown_lis");
          const closeButton = $("<span>").addClass("close").text("x").addClass("fw-bold ms-1");
          closeButton.on("click", function() {
            checkbox.prop("checked", false);
            $(this).parent().remove();
          });
          selectedOption.append(closeButton);
          $("#dd2133").append(selectedOption);
        }
      });
    </script>
    `;

        $(parent).html(html);

        $("#company_input").on("keyup", function () {
          // filterDropdown(this, ".custom_dropdown_af");
          var inputValue = $(this).val(); // Get the input value and convert to lowercase

          var dropdown = $("#custom_dropdown_af"); // Replace with your actual dropdown element selector

          currentPage = 1;
          $.ajax({
            url: url,
            type: "GET",
            data: {
              page: currentPage,
              q: inputValue,
              key: "id",
              representative_field: "name",
              table: "products",
              condition: "",
            },
            beforeSend: function () {
              isLoading = true;
              // Display a loading message or spinner
              // Add a loading indicator to indicate that more items are being loaded
            },
            success: function (response) {
              // Process the response and append the new items to the dropdown
              // Replace this with your code to append the new items to the dropdown
              dropdown.find("li:not(:first)").remove();
              response.results.forEach((item) => {
                console.log(item);

                let li = $("<li>")
                  .addClass("dropdown-item")
                  .html(
                    `<label><input type='checkbox' class='visually-hidden me-2' name='${item.text}' value='${item.id}'>${item.text}</label>`
                  );
                dropdown.append(li);

                li.on("click", function (event) {
                  event.stopPropagation(); // Prevent event bubbling
                  event.preventDefault();

                  console.log($(this));
                  const checkbox = $(this).find("input");
                  const value = checkbox.val();
                  const name = checkbox.attr("name");

                  if (checkbox.is(":checked")) {
                    checkbox.prop("checked", false);
                    $("#dd2133 span[data-id='" + value + "']").remove();
                  } else {
                    checkbox.prop("checked", true);
                    const selectedOption = $("<span>")
                      .attr("data-id", value)
                      .text(name)
                      .addClass("dropdown_lis");
                    const closeButton = $("<span>")
                      .addClass("close")
                      .text("x")
                      .addClass("fw-bold ms-1");
                    closeButton.on("click", function () {
                      checkbox.prop("checked", false);
                      $(this).parent().remove();
                    });
                    selectedOption.append(closeButton);
                    $("#dd2133").append(selectedOption);
                  }
                });
              });

              isLoading = false; // Reset the loading flag
            },
            error: function () {
              // Handle error cases
              isLoading = false; // Reset the loading flag
            },
          });
        });

        // LOAD MORE DATA

        var dropdown = $("#custom_dropdown_af"); // Replace with your actual dropdown element selector

        // Function to load more items
        function loadMoreItems() {
          // Check if all items have been loaded
          if (
            currentPage >
            Math.ceil(
              dropdown.find("li:not(:first-child)").length / itemsPerPage
            )
          ) {
            return;
          }

          // Simulate an AJAX request to load more items
          // Replace this with your actual AJAX call to load more items
          // Adjust the parameters as needed (e.g., page number, URL, etc.)
          $.ajax({
            url: url,
            type: "GET",
            data: {
              page: currentPage + 1,
              q: null,
              key: "id",
              representative_field: "name",
              table: "products",
              condition: "",
            },
            beforeSend: function () {
              isLoading = true;
              // Display a loading message or spinner
              // Add a loading indicator to indicate that more items are being loaded
            },
            success: function (response) {
              // Process the response and append the new items to the dropdown
              // Replace this with your code to append the new items to the dropdown
              response.results.forEach((item) => {
                console.log(item);
                let li = $("<li>")
                  .addClass("dropdown-item")
                  .html(
                    `<label><input type='checkbox' class='visually-hidden me-2' name='${item.text}' value='${item.id}'>${item.text}</label>`
                  );
                dropdown.append(li);

                li.on("click", function (event) {
                  event.stopPropagation(); // Prevent event bubbling
                  event.preventDefault();

                  console.log($(this));
                  const checkbox = $(this).find("input");
                  const value = checkbox.val();
                  const name = checkbox.attr("name");

                  if (checkbox.is(":checked")) {
                    checkbox.prop("checked", false);
                    $("#dd2133 span[data-id='" + value + "']").remove();
                  } else {
                    checkbox.prop("checked", true);
                    const selectedOption = $("<span>")
                      .attr("data-id", value)
                      .text(name)
                      .addClass("dropdown_lis");
                    const closeButton = $("<span>")
                      .addClass("close")
                      .text("x")
                      .addClass("fw-bold ms-1");
                    closeButton.on("click", function () {
                      checkbox.prop("checked", false);
                      $(this).parent().remove();
                    });
                    selectedOption.append(closeButton);
                    $("#dd2133").append(selectedOption);
                  }
                });
              });

              currentPage++; // Increment the current page number
              isLoading = false; // Reset the loading flag
            },
            error: function () {
              // Handle error cases
              isLoading = false; // Reset the loading flag
            },
          });
        }

        // Handle scroll event
        dropdown.on("scroll", function () {
          // Calculate the scroll position relative to the dropdown
          var scrollTop = dropdown.scrollTop();
          var scrollHeight = dropdown.prop("scrollHeight");
          var dropdownHeight = dropdown.innerHeight();
          var scrollPosition = scrollTop + dropdownHeight;

          // Check if the user has scrolled to the bottom
          if (scrollPosition >= scrollHeight && !isLoading) {
            loadMoreItems();
          }
        });
      },
      error: function () {
        // Handle error cases
        isLoading = false; // Reset the loading flag
      },
    });
  }
}
