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
            url: url,
            data: { content: postNewContent, postId: postId, _token: token}
        })
        .done(function (msg) {
            postContentElement.children('.post-content').text(postNewContent);
            $('#modal-edit-post').modal('hide');
        });
    });


});