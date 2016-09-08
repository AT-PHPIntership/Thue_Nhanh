function clickVote(url) {
    $('#btn-vote').click(function() {
        var token = $("[name='_token']").val();
        var post_id = $("[name='post_id']").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            type:"POST",
            url: voteURL,
            data: {
                post_id: post_id,
            },
            dataType: 'json',
            success: function(data){
                console.log(data);
                $("#vote-form").load(location.href + " #vote-form");
            },
            error: function(data){
                console.log(data);
                $("#vote-form").load(location.href + " #vote-form");
            }
        });
    });
}
