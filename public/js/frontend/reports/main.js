function submitReport(url) {
    $('#report-form').on('submit', function(e) {
        var description = $('#report-description').val();
        var token = $("[name='_token']").val();
        var post_id = $("[name='post_id']").val();

        e.preventDefault(e);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            type:"POST",
            url: url,
            data: {
                post_id: post_id,
                description: description
            },
            dataType: 'json',
            success: function(data) {
                alert(lang.post.show.thanks_for_reportting);
                $('#model-report').modal('toggle');
            },
            error: function(data) {
                var errors = JSON.parse(data.responseText).description;
                alert(errors);
            }
        });
    });
}
