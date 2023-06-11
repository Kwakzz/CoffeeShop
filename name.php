<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/name.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">

    <title>Become a member</title>
</head>


<body>
    <form action="proc_files/name_proc.php" method="POST">
        <img src="images/coffee shop logo black.png"/> 
        <div class="entries">
            <label for="fname">First Name</label>
            <br>
            <input type="text" name = "fname" id="fname" class = "name">
            <br>
            <label for="lname">Last Name</label>
            <br>
            <input type="text" name = "lname" id="lname" class = "name">
            <br>
            <label for="bio" id=bio_label>Bio</label>
            <br>
            <input type="text" name = "bio" id="bio" class="name">
        </div>
        <br>
        <input type="submit" name = "finish" id="finish" value = "Finish">
    </form>
</body>
</html>
