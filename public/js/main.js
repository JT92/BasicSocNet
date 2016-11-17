$( document ).ready(function() {

    var postContentElement = null;

    // Edit Post - Open up modal when edit is clicked
    $('.post .inter-post-edit').on('click', function(){
        // event.preventDefault();

        postContentElement = $(this).closest('.post');
        var postContent = $(this).parent().siblings('.post-content').text();
        $('#modal-edit-post').modal('show');
        $('#modal-edit-post .post-content').text(postContent);
    });

    // Edit Post - Edit the post when save post is clicked on the modal
    $('#modal-edit-post .modal-save').on('click', function() {

        // get modal post content
        var postNewContent = $('#modal-edit-post .post-content').val();
        var postId = postContentElement.attr('data-postid');

        // write post changes to database
        $.ajax({
            method: 'POST',
            url: editUrl,
            data: { content: postNewContent, postId: postId, _token: token}
        })
        .done(function (msg) {
            postContentElement.children('.post-content').text(postNewContent);
            $('#modal-edit-post').modal('hide');
        });
    });

    //
    $('.inter-post-like, .inter-post-dislike').on('click', function(event) {

        event.preventDefault();

        // get post info
        postContentElement = $(this).closest('.post');          // the post container
        var postId = postContentElement.attr('data-postid');    // post id
        var postLiked = $(this).hasClass('inter-post-like');    // whether liked or disliked pressed

        // send to db
        $.ajax({
            method: 'POST',
            url: likeUrl,
            data: {postId: postId, postLiked: postLiked, _token: token}
        })
        .done(function() {
            // if like/unlike clicked
            if (postLiked){
                event.target.innerText = event.target.innerText == 'Like' ? 'Unlike' : 'Like';
                $(event.target).siblings('.inter-post-dislike').text('Dislike');
            }

            // if dislike/remove dislike clicked
            else
                event.target.innerText = event.target.innerText == 'Dislike' ? 'Remove Dislike' : 'Dislike';
                $(event.target).siblings('.inter-post-like').text('Like');
        });

    });


});