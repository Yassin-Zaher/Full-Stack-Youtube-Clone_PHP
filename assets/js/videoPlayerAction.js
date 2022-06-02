function likeVideo(button, videoId) {
    // ajax call
    $.post("ajax/likeVideo.php", {videoId: videoId})
        .done(function (data) {
            alert(data);
        })
}