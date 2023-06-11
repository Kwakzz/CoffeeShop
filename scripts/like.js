/**
 * AJAX call to like_proc.php
 * @param {*} published_id 
 */
 var hasLiked = false;

function like(published_id, liked, loggedIn) {
    var xhttp = new XMLHttpRequest();

    // If user is not logged in, then redirect to login page
    if (loggedIn == 0) {
        window.location.href = "../coffeeshop/login.php";
    }


    // If user has not liked the post, then send a request to like_proc.php
    if (liked == 0 && hasLiked == false) {


        xhttp.open("GET", "../coffeeshop/proc_files/like_proc.php?published_id=" + published_id, true);
        xhttp.send();

        xhttp.onload = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var no_of_likes = parseInt(document.getElementById("no_of_likes").innerHTML);
                no_of_likes++;
                document.getElementById("no_of_likes").innerHTML = no_of_likes;
            }
        }

        hasLiked = true;
    }
    // Else, alert the user that he/she has already liked the post
    if (liked == 1) {
        alert("You have already liked this post!");
    }


}

