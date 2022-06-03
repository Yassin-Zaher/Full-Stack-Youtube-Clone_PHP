function likeVideo(button, videoId) {
    // ajax call
    $.post("ajax/likeVideo.php", {videoId: videoId})
        .done(function (data) {
            var likeButton = $(button);
            var disLikeButton = $(button).siblings(".disLikeButton");

            var result = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), result.likes);
            updateLikesValue(disLikeButton.find(".text"), result.dislikes);

        })
}

function updateLikesValue(element, num){
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + num);
}