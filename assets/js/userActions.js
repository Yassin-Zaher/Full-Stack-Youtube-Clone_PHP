function subscribe(userTo, userFrom, button) {
    if(userTo == userFrom){
        alert("You can't subscribe to yourself");
        return;
    }

    $.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
        .done(function (data) {
            let subscribers = JSON.parse(data);
            if(subscribers.count != null){
                //means that the user subscribed
                //TODO : change the sub button to unsub
                $(button).toggleClass("subscribe unsubscribe");
                var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
                $(button).text(buttonText + " " + subscribers.count)
            } else {

                alert("Something wont wrong")
            }
        })
}