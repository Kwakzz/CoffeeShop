<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/login.css">
</head>


<body>

<div class="login">

<header>
<img class="logo" id="logo" src="../Accessories/the coffee shop logo (black background).png" alt="coffee-shop logo">
</header>

<form action="../procFiles/login_proc.php" method="POST">
    <input class="email" type="email" name="email_address" id="email" placeholder="Email address">
    <input class="password" type="password" name="password" id="pass" placeholder="Password">
    <input type="submit" name='login' value="Login" class="loginbox">
    <p>Forgot your password?</p>
    <p class="link">No account?  <a href="subscribe.php">Sign up</a> </p> 
</form>


</div>
    
</body>
</html>