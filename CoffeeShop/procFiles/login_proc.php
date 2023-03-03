<?php

session_start();

// check if user came via login button
if (isset($_POST['login'])) {

    include ('../helperFunctions/secureInput.php');

    // check if entry fields were empty
    if (!empty($_POST['email_address']) && !empty($_REQUEST['password'])) {
        $emailAddress = secureInput($_REQUEST['email_address']);
        $pw = secureInput($_REQUEST['password']);

    }
    else {
        exit('Please complete the form.');
    }

    // connect to database
    include('../helperFunctions/dbConnect.php');

    // check if there's a user with the entered email address
    $sql = "SELECT * FROM Subscribers WHERE email_address = '$emailAddress'";
    $result = mysqli_query($conn, $sql);

    // number of rows query returned.
    $count = mysqli_num_rows($result);


    // check if query returned anything
    if ($count == 1) {

        // put the user's attributes in an array
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // create session variables for user login details
        $_SESSION['subscriber_id'] = $row['subscriber_id'];
        $_SESSION['email_address'] = $row['email_address'];
        $_SESSION['pw'] = $row['subscriber_password'];
        

        // verify password
        if (password_verify($pw, $_SESSION['pw'])) {
            echo "Successfully logged in!";
            // redirect to homepage
            header("Location: ../index.php");
            exit();
        }

        // don't specify to user which detail was wrong
        else {
            echo "Wrong email or password";
            session_destroy();
            //redirect to login page
        }
    } 

    else {
        echo "Wrong email or password";
        session_destroy();
        //redirect to login page
    }

}

else {
	//redirect to login page

}
?>