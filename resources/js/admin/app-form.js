/*
 |--------------------------------------------------------------------------
 | Shards Dashboards: Blog Add New Post Template
 |--------------------------------------------------------------------------
 */

'use strict';

(function ($) {
    $(document).ready(function () {

        $("#image").change(function() {
            showImagePreview(this, "#image-preview");
        });


        $("#images").change(function() {
            showImagePreview(this, "#images-preview", true);
        });

    });

    function showImagePreview(input, target, append) {
        if(typeof append === "undefined"){
            append = false;
        }

        if (input.files && input.files[0]) {

            for(var i = 0; i < input.files.length; i++){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[i]);

                reader.onload = function(e) {
                    // create an image element
                    var img = $('<img />', {
                        src: e.target.result,
                        class: 'img-thumbnail'
                    });

                    // append it to target
                    if(append){
                        img.appendTo($(target));
                    }
                    else{
                        $(target).html(img);
                    }
                }
            }
        }
    }

    // handle delete image event
    $(".product-image").on("click", ".remove-temp", function(){
        $(this).parent().remove();
    });

    // handle delete image event
    $(".product-image").on("click", ".remove", function(){
        var imageId = $(this).attr('data-id');
        var productId = $(this).attr('data-product');
        deleteProductImage($(this), imageId, productId);
    });


    function deleteProductImage(element, imageId, productId){
        var url = '/products/'+ productId +'/image/'+ imageId;

        axios.delete(url)
        .then(function (response) {
            if(response.data.success){
                element.parent().remove();
            }
        })
        .catch(function (error) {
            alert('error');
        });
    }

})(jQuery);
