  class Utils {

    constructor(msg) {
      this.message = msg;
      console.log("MESSAGE IS " + this.message)
      this.count = 0;
    }

    showMessage() {
      // this.message = msg;
    }

    incrementCount() {
      this.count++;
      console.log(`Count: ${this.count}`);
    }

  getAjaxData(method,url,animation_direction = "btt") {
    let animation = {in:"animate__fadeInUpBig", out:"animate__fadeOutDownBig"}
      switch (animation_direction) {
        case "rtl":
          animation.in = "animate__fadeInRightBig"
          animation.out = "animate__fadeOutRightBig"
          break;
        default:
          break;
      }

        $.ajax({
            method, // The HTTP method (e.g., GET, POST, PUT, DELETE)
            url,
            success: function(html) {

                Swal.fire({
                    showClass: {
                        popup: `animate__animated ${animation.in} animate__faster`
                    },
                    hideClass: {
                        popup: `animate__animated ${animation.out} animate__faster`
                    },
                    customClass: {
                        container: `full-width-alert ${animation_direction}`
                    },
                    // title: 'Create New',
                    // text: "Once deleted, you will not be able to recover it! #",
                    html: html,
                    // icon: 'info',
                    showCancelButton: false,
                    showConfirmButton: false,
                })
                var scripts = $(html).find('script');
                scripts.each(function() {
                  $.globalEval(this.innerHTML);
                });
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
  }

  // Function to execute scripts within an HTML element
    executeScripts(element) {
      $(element).find('script').each(function() {
        eval($(this).text());
      });
    }

  submitAjaxData(method,url,data,reload_id,canvas_id, callbackfunc) {

    var message = this.message;
        $.ajax({
          method, // The HTTP method (e.g., GET, POST, PUT, DELETE)
          url,
          data: data,
          success: function(response) {
            callbackfunc(false);
            const parse_data = JSON.parse(response);
              if (parse_data["finish"] == true || method.toLowerCase() == "delete") {
                swal.close();
                if(method.toLowerCase() =="delete") {
                  swal.fire({
                    icon: 'success',
                    title: "Success!", // Set the title of the success message
                    text: message, // Set the message content
                    showConfirmButton: true, // Hide the "OK" button
                    timer: 2000, // Automatically close the success message after 2000 milliseconds (2 seconds)
                    on: "success",
                });
                }
                
                swal.fire({
                  text: message, // Set the message content
                  title: "Success!", // Set the title of the success message
                  icon: "success", // Specify the success icon
                  showConfirmButton: true, // Hide the "OK" button
                  timer: 2000, // Automatically close the success message after 2000 milliseconds (2 seconds)
              });
                  $.pjax.reload({
                      container: '#' + reload_id
                  });

                  // dont use growl
                  return;
              }
              $(canvas_id).html("")
              $(canvas_id).html(parse_data["html"])

          },
          error: function(xhr, status, error) {
              console.log('Error:', error);
          }
        });
  }
}


