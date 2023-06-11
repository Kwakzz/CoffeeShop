<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/login.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    
    <title>Login</title>
</head>


<body>
    <form action="proc_files/login_proc.php" method="POST">

        <!--Logo-->
        <div id = "logo_bg"><img src="images/coffee shop.png"/></div>
        <div class="entries">

            <!--Email address-->
            <input type="email" name = "email_address" id = "email_address" placeholder="Email Address">
            <br>

            <!--Password-->
            <div id = "password_container">
                <i class="fas fa-eye" id="toggle_password" onclick="togglePasswordVisibility()"></i>
                <input type="password" name = "password" id = "password" placeholder="Password" required>
            </div>
        </div>
        <br>

        <!--Login button-->
        <input type="submit" name = "login" id="login" value = "Login">

        <p>Forgot your password?</p>
        <a href="signup.php"><p>No account? Sign up.</p></a>
    </form>

    <!--Link to javascript file containing toggleVisibility function-->
    <script src="./scripts/toggleVisibility.js"></script>
</body>
</html>
