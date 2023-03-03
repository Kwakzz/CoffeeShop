<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Coffeeshop</title>
    <link rel="stylesheet" href="/css/subscribe.css">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/subscribe.css">    
</head>


<body>

<div class="signup">

<header>
<img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo"> <p class="title">Become a Member</p>
</header>

<form action="../procFiles/subscribe_proc.php" method="POST">
    <input class="email" type="email" name="email_address" id="email" placeholder="Email address">
    <input class="password" type="password" name="password" id="pass" placeholder="Password">
    <input class="password" type="password" name="cpassword" id="pass" placeholder="Confirm Password">
    <input type="submit" name = "continue" value="Continue" class="signupbox">
    
    <p class="link">Already have an account?  <a href="login.php">Sign in</a> </p> 
</form>

</div>
    
</body>
</html>

