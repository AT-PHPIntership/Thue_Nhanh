// LocationPicker
const DEFAULT_RADIUS = 100;
const DEFAULT_LAT = 21.0227731;
const DEFAULT_LNG = 105.8018581;
$(document).ready(function(){
    // Innital component
    $('#location').locationpicker({
        radius: DEFAULT_RADIUS,
        inputBinding: {
            latitudeInput: $('#location-lat'),
            longitudeInput: $('#location-lon'),
            radiusInput: $('#location-radius'),
            locationNameInput: $('#location-address')
        },
        enableAutocomplete: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {
            // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
    });

    var defaultPos = {
        latitude: DEFAULT_LAT,
        longitude: DEFAULT_LNG,
    }

    // Get current location. Try HTML5 geolocation.
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
            defaultPos = {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude
            };
            $('#location').locationpicker('location', defaultPos);
        });
    } else {
        alert(lang.post.create.unsupport_geolocation);
        $('#location').locationpicker('location', defaultPos);
    }
});

// Tinymce
tinymce.init({
    selector:'#content',
    // menubar: "false"
});

// Show small thumbnail images before uploading
const EXTNS = ["jpg", "jpeg", "png", "gif"];

$(document).ready(function() {
    var toggle_img = $('.toggle-img');
    var image_holder = $("#image-holder");
    var toggle_btn = $('#toggle-btn');
    $("#photos").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        image_holder.empty();

        if (extn == EXTNS[0] || extn == EXTNS[1] || extn == EXTNS[2] || extn == EXTNS[3]) {
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image",
                            "style": "width:136px; padding: 10px 10px 0px 0px;",
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                    // show the toggle button.
                    toggle_img.show();
                }
            } else {
                alert(lang.post.create.not_support_thumbnail);
                toggle_img.hide();
            }
        } else {
            alert(lang.post.create.select_only_img);
            toggle_img.hide();
        }
    });
    // toggle button
    toggle_img.click(function(){
        image_holder.toggle();
        $("i",this).toggleClass("fa-angle-double-down fa-angle-double-up");
    });
});

// show/hide the map
$(document).ready(function() {
    $('.toggle-map').click(function() {
        $('.map_holder').toggle();
        $("i",this).toggleClass('fa-caret-up fa-caret-down');
    });
});
