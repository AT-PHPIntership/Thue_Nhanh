/**
 * Submit creating comment.
 *
 * @param  {[string]}       url The target submit to.
 *
 * @return {[void|boolean]}
 */
function submitComment(url) {
    $('#comment-form').on('submit', function(e) {
        var comment = $('#comment-text').val();
        var user_id = $("[name='user_id']").val();
        var post_id = $("[name='post_id']").val();
        var token = $("[name='_token']").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        e.preventDefault(e);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                user_id: user_id,
                post_id: post_id,
                content: comment
            },
            dataType: 'json',
            success: function(data) {
                $("#comments").load(location.href + " #comments");
                $(".detail").load(location.href + " .detail");
            },
            error: function(data) {
                var errors = JSON.parse(data.responseText).content;
                alert(errors);
            }
        });
    });
}

/**
 * Submit deleting comment.
 *
 * @param  {[string]}       url The target submit to.
 *
 * @return {[void|boolean]}
 */
function submitDelCmt(url) {
    $('.del-cmt-form').on('submit', function(evt) {
        evt.preventDefault(evt);
        if (!confirm(lang.comment.delete.confirm_msg)) {
            return false;
        }
        var commentID = $(this).find("[name='comment_id']").val();
        var token = $("[name='_token']").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: {
                _method: 'DELETE',
                id: commentID
            },
            dataType: 'json',
            success: function(data) {
                descreaseCmt(data.commentID);
            },
            error: function(data) {
                console.log(data);
                var errors = JSON.parse(data.responseText).id;
                alert(errors);
            }
        });
    });
}

/**
 * Descrease the number of comments on view and hide comment.
 *
 * @param {[int]} id the comment id
 *
 * @return {[void]}
 */
function descreaseCmt(id) {
    // Remove the comment onview
    var row = '.row_' + id;
    $(row).remove();
    // Update the number of comments
    var countCmt = parseInt($('#count-cmts').html());
    $('#count-cmts').text(--countCmt);
}
