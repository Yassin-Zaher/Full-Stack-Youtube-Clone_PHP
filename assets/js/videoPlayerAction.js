function likeVideo(button, videoId) {
    // ajax call
    $.post("ajax/likeVideo.php", {videoId: videoId})
        .done(function (data) {
            var likeButton = $(button);
            var disLikeButton = $(button).siblings(".disLikeButton");

            likeButton.addClass("active");
            disLikeButton.removeClass("active");

            var result = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), result.likes);
            updateLikesValue(disLikeButton.find(".text"), result.dislikes);

            if(result.likes < 0){
                likeButton.removeClass("active");
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
            }else{
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up-active.png");
            }

        })
}

function updateLikesValue(element, num){
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + num);
}