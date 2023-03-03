<?php

session_start();

if (isset($_GET["delete_account"])) {

    if (!$_SESSION['subscriber_id']) {
        echo "sign in first";
    }

    include ('../helperFunctions/dbConnect.php');

    $subscriberId = 'subscriber_id';

    $sql = "DELETE FROM Subscribers, Published, Drafts WHERE subscriber_id = '$_SESSION[$subscriberId]'";

    $result = mysqli_query($conn, $sql);
            
	// check if query worked
	if ($result === TRUE) {
        session_destroy();
        // redirect to subscribe page
        header("Location: ../frontEnd/subscribe.php");
        exit();
	}

    else {
		//echo error but continue executing the code to close the session
		echo "Error: " . $sql . "<br>" . mysqli_connect_error();
	}
  
}

?>