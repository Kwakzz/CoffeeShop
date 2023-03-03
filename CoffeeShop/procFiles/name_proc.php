<?php
session_start();

//check if register form was submited
//by checking if the submit button element name was sent as part of the request

if (isset($_REQUEST['finish'])) {

	// check if all values are not empty
    if (!empty($_REQUEST['fname']) && !empty($_REQUEST['lname'])) {
        $fname = $_REQUEST["fname"];
		$lname = $_REQUEST["lname"];
        $emailAddress = 'email_address';
    }

    else {
        exit('Please complete the form.');
    }

    // connect to database
	include('../helperFunctions/dbConnect.php');

	// update user's first name and last name
	$sql = "UPDATE Subscribers SET lname='$lname', fname = '$fname' WHERE email_address='$_SESSION[$emailAddress]'";

	$result = mysqli_query($conn, $sql);

	// check if query worked
    if ($result === TRUE) {
        session_unset();
        session_destroy();
        // redirect to login page
        header("Location: ../frontEnd/login.php");
        exit();
    }

    else {
        //echo error but continue executing the code to close the session
      echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }


}

else {
    // redirect to subscribe page
    header("Location: ../frontEnd/subscribe.php");
    exit();
}

?>