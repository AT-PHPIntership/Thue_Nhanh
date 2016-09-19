function setActiveTab(currentTab) {
    if (currentTab) {
        $('#forRent').attr("class", "tab-pane fade active in");
        $('.forRent-nav').attr("class", "forRent-nav active");
    } else {
        $('#needRent').attr("class", "tab-pane fade active in");
        $('.needRent-nav').attr("class", "needRent-nav active");
    }
};

function setFormAction(url) {
    $(document).on('click', ".btn-del", function() {
      var postID = $(this).next().val();
      $('#del-post-id').val(postID);
      $('#delete-form').attr('action', url + '/' + postID);
    });
}

function initMap(location, radius) {
    $('#map').locationpicker({
        location: location,
        radius: radius
    });
}

function checkUpdate() {
    $('form').submit(function() {
        if(!$('#content').val()) {
            alert(lang.post.create.no_content);
            return false;
        }
    });
}
