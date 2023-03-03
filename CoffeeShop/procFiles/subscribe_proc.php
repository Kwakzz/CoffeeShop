<?php 

session_start();

//check if register form was submited
//by checking if the submit button element name was sent as part of the request

if (isset($_POST['continue'])) 
{
	// check if all values are not empty
    if (!empty($_POST['email_address']) && !empty($_POST['password']) && !empty($_POST["cpassword"])) {


        include ('../helperFunctions/secureInput.php');

        $_SESSION['email_address'] = secureInput($_POST["email_address"]);
        $pw = secureInput($_POST["password"]);
		$cpw = secureInput($_POST["cpassword"]);
        $emailAddress = 'email_address';
    }

    else {
        exit('Please complete the form.');
    }

    
    // connect to database
	include('../helperFunctions/dbConnect.php');

	// check if account already exists
	$sql = "SELECT * from `Subscribers` where `email_address` = '$_SESSION[$emailAddress]'";

	$result = mysqli_query($conn, $sql);

	$num = mysqli_num_rows($result);

	if ($num == 0) {

		// check if password value is the same as confirm password value
		if ($pw == $cpw) {

	
			//encrypt password
			//use the php password_hash function
			$encrypted_pw = password_hash($pw, PASSWORD_DEFAULT);


			echo $encrypted_pw;

			//write query
			$sql = "INSERT INTO `Subscribers` (`subscriber_id`, `fname`, `lname`, `username`, `bio`, `time_of_subscription`, `email_address`, `subscriber_password`, `profile_pic`) VALUES (NULL, NULL, NULL, NULL, 'No bio yet', current_timestamp(), '$_SESSION[$emailAddress]', '$encrypted_pw', NULL)";
			$result = mysqli_query($conn, $sql);

			echo $sql;
            
			// check if query worked
			if ($result === TRUE) {
                header ("Location: ../frontEnd/name.php");
                exit();
			}

			else {
				//echo error but continue executing the code to close the session
			  echo "Error: " . $sql . "<br>" . mysqli_connect_error();
			}
		}

		else {
			echo "Passwords don't match.";
			//redirect to subscribe page
			header("Location: ../frontEnd/subscribe.php");
			exit();
		}
	}

	else {
		echo "Account already exists";
		//redirect to subscribe page
		header("Location: ../frontEnd/subscribe.php");
		exit();
	}

	} 

else {
	//redirect to register page
}

?>