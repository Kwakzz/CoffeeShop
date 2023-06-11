<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// this file contains a function which removes whitespace, slashes and change data to an HTML representation
include ("../helper_functions/secure_input.php");

// this file contains a function which connects to the database
include ("../helper_functions/db_connect.php");

// this file contains a function which checks if email address exists in database
include ("../helper_functions/email_exists.php");

// condition for users who click on "continue" 
if (isset($_POST["continue"])) {

    session_start();

    // store email address as a session variable
    // this will allow users to insert their first name, last name and bio in the next page

    // get user input
    $email_address = secure_input($_POST["email_address"]);
    $password = secure_input($_POST["password"]);
    $cpassword = secure_input($_POST["cpassword"]);
    $username = "";
    
    // create session variable for email address. it will be used in name.php
    $_SESSION["email_address"] = $email_address;

    // generate username
    foreach (str_split($email_address) as $char) {
        if ($char == "@") {
            break;
        }
        $username .= $char;
    }

    // check if email already exists
    if (email_exists($email_address)){
        ?>
        <script>
            document.getElementById("error_message").innerText = "Account already exists.";
            return false;
        </script>
    <?php
    }

    // if all conditions are met, insert user input into database
    
    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Subscribers (subscriber_id, fname, lname, username, bio, time_of_subscription, email_address, subscriber_password, profile_pic) VALUES (NULL, NULL, NULL, '$username', 'No bio yet', current_timestamp(), '$email_address', '$hashed_password', NULL)";
        $result = mysqli_query($conn, $sql);

        if ($result == TRUE) {
            // finish subscription process in name.php
            header("Location: ../name.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
    // Handle the duplicate entry error here
    echo "Error: Email address already exists.";
}

}

?>