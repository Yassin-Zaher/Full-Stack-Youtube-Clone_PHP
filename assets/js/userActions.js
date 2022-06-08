function subscribe(userTo, userLoggedIn, button) {
    if(userTo == userLoggedIn){
        alert("You can't subscribe to yourself");
        return;
    }

    $.post("ajax/subscribe.php")
        .done(function () {
            console.log("DONE :)")
        })
}