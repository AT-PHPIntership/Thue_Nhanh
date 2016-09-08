function submitComment(url){
    $('#comment-form').on('submit', function(e){
        var comment = $('#comment-text').val();
        var token = $("[name='_token']").val();
        var user_id = $("[name='user_id']").val();
        var post_id = $("[name='post_id']").val();
        // var url = "{{route('comment.store')}}";
        const CREATED = 200;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        e.preventDefault(e);

        $.ajax({
            type:"POST",
            url: url,
            data: {
                user_id: user_id,
                post_id: post_id,
                content: comment
            },
            dataType: 'json',
            success: function(data){
                $("#comments").load(location.href + " #comments");
                $(".detail").load(location.href + " .detail");
            },
            error: function(data){
                var errors = JSON.parse(data.responseText).content;
                alert(errors);
            }
        });
    });
}
