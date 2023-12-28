class ImageInput {
  static getImageInput({type, oldImages}) {
    // type => single or multiple
    // var oldImagesString = JSON.stringify(oldImages);

    var oldImagesString = oldImages.images;


    const isEmpty = (arr) => {
        return arr.length === 0;
      };

    // oldImages is ann object and you can not use object iteration that is why you need to turn it to an array anmd then reuse the forloop and all done
    var returnred = `
    
    <div class="flexing">
        <div class="file-input-block dummy_file_button">
            <span class="textImage">Select Image/s</span>
            <div class="thumbnailContainer"></div>
        </div>
        <input type="file" style="" class="fileInput_css"  ${
          type == "single" ? "" : "multiple"
        }>
        <input type="hidden" class="imageData" name="imageData" ${
          type == "single" ? "" : "multiple"
        }>
    </div>


    <script>
    var images = "";
    function getBase64FromImageUrl(imageUrl, callback) {
        var img = new Image();
        img.crossOrigin = "Anonymous";
        img.onload = function() {
          var canvas = document.createElement('canvas');
          canvas.width = img.width;
          canvas.height = img.height;
      
          var ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0);
      
          var dataURL = canvas.toDataURL('image/png');
          callback(dataURL);
        };
      
        img.src = imageUrl;
      }

    $(".dummy_file_button").on("click", function(e) {
      $(".fileInput_css").trigger("click");
  })
       
        `;

    if ( oldImagesString && !isEmpty(oldImagesString)) {
    returnred += `
          var image_index = 0;

          $(document).ready(function() {
            $('.imageData').val("");
            var thumbnailContainer = $('.thumbnailContainer');
            ${JSON.stringify(oldImagesString)}.forEach(item => {
                $(".textImage").text("")
                    var thumbnailWrapper = $('<div class="thumbnail-wrapper"></div>');
                    getBase64FromImageUrl(item.url, function(base64) {
                        console.log($('.imageData').val())

                        $('.imageData').val($('.imageData').val() + base64 + ' ' + image_index + ",");
                      });
                    // $('.imageData').val($('.imageData').val() + item.base64 + ' ' + image_index + ",");
                    var bottom_bar = $("<div>", {
                        "class": "bottom_bar"
                    })
                    var thumbnail = $('<img class="thumbnail">');
                    thumbnail.attr('src', item.url);
                    
                    var removeButton = $('<button class="remove-button" data-imageid=' + image_index + '>X</button>');
                    console.log(image_index)
                    removeButton.on('click', function(event) {
                        event.stopPropagation(); // Prevent click event propagation
                        alert("clicked")
                        var imageid = $(this).data("imageid");
                        var newImages_arr = $(".imageData").val().split(",");
                        var filteredArray = newImages_arr.filter(function(imageData) {
                            console.log(imageData.split(" ")[1] + " " +  imageid)
                            return  imageData.split(" ")[1] !== imageid;
                          });
                        var newImages = filteredArray.join(",");
                        console.log(filteredArray)
                        $('.imageData').val(newImages);


                        if ($(".thumbnailContainer").children().length <= 0) {
                            $(".textImage").text("Select Image/s")
                        }

                        thumbnailWrapper.remove(); // Remove the thumbnail on button click
                    });

                    var viewButton = $('<a href="#ex1" rel="" class="view-button">View</a>');

                    image_index++;

                    bottom_bar.append(removeButton)
                    bottom_bar.append(viewButton)
                    var content = $("<img>", {
                        "src": item.url,
                        "style": "padding:.2rem"
                    })

                    thumbnailWrapper.append(thumbnail);
                    thumbnailWrapper.append(bottom_bar);
                    
                    if ("${type}" == "single" && $(".thumbnailContainer").children().length > 0) {
                      thumbnailContainer.empty();
                  }
                    // Append the thumbnail image to the container
                    thumbnailContainer.append(thumbnailWrapper);
                })
            });
                `;
    }

    returnred += `
        
    $('.fileInput_css').on('change', function(event) {

        var fileInput = event.target;
        var thumbnailContainer = $('.thumbnailContainer');

        $(".textImage").text("")
        // Check if files are selected
        if (fileInput.files && fileInput.files.length > 0) {
            $.each(fileInput.files, function(index, file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var thumbnailWrapper = $('<div class="thumbnail-wrapper"></div>');
                    var better_res = e.target.result.split(",")
                    $('.imageData').val($('.imageData').val() + better_res[1] + ',');
                    var bottom_bar = $("<div>", {
                        "class": "bottom_bar"
                    })

                    var thumbnail = $('<img class="thumbnail">');
                    thumbnail.attr('src', e.target.result);
                    image_index++;
                    var removeButton = $('<button class="remove-button"  data-imageid=' +image_index +'>X</button>');
                    removeButton.on('click', function(event) {
                        event.stopPropagation(); // Prevent click event propagation
                        alert("clicked")
                        var imageid = $(this).data("imageid");
                        var newImages_arr = $(".imageData").val().split(",");
                        // newImages_arr.splice(imageid, 1); // Remove one element at the specified index
                        newImages_arr[imageid] = "" // Remove one element at the specified index

                        var newImages = newImages_arr.join(",");
                        console.log(newImages_arr)
                        console.log(newImages)
                        $('.imageData').val(newImages);


                        if ($(".thumbnailContainer").children().length <= 0) {
                            $(".textImage").text("Select Image/s")
                        }

                        thumbnailWrapper.remove(); // Remove the thumbnail on button click
                    });

                    // removeButton.on('click', function(event) {
                    //     event.stopPropagation(); // Prevent click event propagation
                    //     thumbnailWrapper.remove(); // Remove the thumbnail on button click
                    //     if ($(".thumbnailContainer").children().length <= 0) {
                    //         $(".textImage").text("Select Image/s")
                    //     }
                    // });

                    var viewButton = $('<a href="#ex1" rel="" class="view-button">View</a>');

                   
                    bottom_bar.append(removeButton)
                    bottom_bar.append(viewButton)
                    var content = $("<img>", {
                        "src": e.target.result,
                        "style": "padding:.2rem"
                    })

                    thumbnailWrapper.append(thumbnail);
                    thumbnailWrapper.append(bottom_bar);
                    
                    if ("${type}" == "single" && $(".thumbnailContainer").children().length > 0) {
                      thumbnailContainer.empty();
                  }
                    // Append the thumbnail image to the container
                    thumbnailContainer.append(thumbnailWrapper);

                    $(document).on('click', '.view-button', function(event) {
                        event.stopPropagation(); // Prevent click event propagation
                        event.preventDefault();
                        this.blur(); // Manually remove focus from clicked link.
                        content.appendTo('body').modal({
                            fadeDuration: 200,
                            fadeDelay: 0
                        });
                    });

                };

                reader.readAsDataURL(file);
            });
        }
    });


    </script>
    
   
    `;

    return returnred;
  }
}
