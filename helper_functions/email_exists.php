<?php

/** 
Check if email address exists in database
*/
function email_exists($email_address) {

    // Connect to database
    include("db_connect.php");

    // query to check if email address exists
    $sql = "SELECT * FROM Subscribers WHERE email_address = '$email_address'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count >= 1) {
        return true;
    }

    else {
        return false;
    }
}

?>