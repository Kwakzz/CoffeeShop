<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/signup.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <title>Become a member</title>

</head>


<body>

    <!--Sign up form-->
    <form name="sign_up" action="proc_files/signup_proc.php" method="POST" onsubmit="return validateSignUp()">

        <!--Logo-->
        <img src="images/coffee shop logo black.png"/> 

        <p id = heading>Become a member </p>
        <div class = entries>

            <!--Email address-->
            <input type="email" name = "email_address" id = "email_address" placeholder="Email Address" required>
            <br>

            <!--Password-->
            <div id = "password_container">
                <i class="fas fa-eye" id="toggle_password" onclick="togglePasswordVisibility()"></i>
                <input type="password" name = "password" id = "password" placeholder="Password" required>
            </div>
            <br>

            <!--Confirm password-->
            <div id = cpassword_container>
                <i class="fas fa-eye" id="toggle_cpassword" onclick="toggleConfirmPasswordVisibility()"></i>
                <input type="password" name = "cpassword" id = "cpassword" placeholder="Confirm Password" required>
            </div>
        </div>
        <br> 

        <!--Error message-->
        <p id = "error_message"></p>

        <!--Continue button-->   
        <input type="submit" name = "continue" id="continue" value = "Continue">

        <a href="login.php"><p>Already have an account? Sign in.</p></a>

    </form>

    <!--Link to javascript files containing validate and toggleVisibility function-->
    <script src="./scripts/validateSignUp.js"></script>
    <script src="./scripts/toggleVisibility.js"></script>


</body>
</html>
