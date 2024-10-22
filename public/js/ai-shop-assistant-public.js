(function($) {
    'use strict';

    let video = null;
    let canvas = null;
    let captureInterval = null;

    $(function() {
        setupImageCapture();

        $('#ai-shop-assistant-button').on('click', function() {
            if (video && video.srcObject) {
                // Stop the video stream if it's already running
                stopImageCapture();
            } else {
                // Start the video stream
                startImageCapture();
            }
        });
    });

    function setupImageCapture() {
        $('body').append('<video id="ai-shop-assistant-video" style="display:none;"></video>');
        $('body').append('<canvas id="ai-shop-assistant-canvas" style="display:none;"></canvas>');
        video = document.getElementById('ai-shop-assistant-video');
        canvas = document.getElementById('ai-shop-assistant-canvas');
    }

    function startImageCapture() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
                captureInterval = setInterval(captureAndAnalyzeImage, 5000); // Capture every 5 seconds
            })
            .catch(function(err) {
                console.error("Error accessing the camera: ", err);
                alert("Unable to access the camera. Please make sure you've granted permission.");
            });
    }

    function stopImageCapture() {
        if (video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
        }
        clearInterval(captureInterval);
    }

    function captureAndAnalyzeImage() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        
        let imageData = canvas.toDataURL('image/jpeg');

        $.ajax({
            url: ai_shop_assistant_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'ai_shop_assistant_process',
                nonce: ai_shop_assistant_vars.nonce,
                image_data: imageData
            },
            success: function(response) {
                if (response.success) {
                    displayProductSuggestions(response.data);
                } else {
                    console.error('Error processing image:', response.data.message);
                }
            },
            error: function() {
                console.error('AJAX error occurred while processing the image.');
            }
        });
    }

    function displayProductSuggestions(products) {
        var $suggestionsContainer = $('#ai-shop-assistant-suggestions');
        $suggestionsContainer.empty();

        if (products.length === 0) {
            $suggestionsContainer.append('<p>No matching products found.</p>');
            return;
        }

        products.forEach(function(product) {
            var $productElement = $('<div class="product-suggestion"></div>');
            $productElement.append('<h3>' + product.name + '</h3>');
            $productElement.append('<img src="' + product.image + '" alt="' + product.name + '">');
            $productElement.append('<p>Price: $' + product.price + '</p>');
            
            if (product.added_to_cart) {
                $productElement.append('<p>Added to cart! <a href="' + product.cart_url + '">View Cart</a></p>');
            } else {
                $productElement.append('<button class="add-to-cart" data-product-id="' + product.id + '">Add to Cart</button>');
            }

            $suggestionsContainer.append($productElement);
        });

        $suggestionsContainer.show();
    }

})(jQuery);
