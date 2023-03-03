<?php
session_start();
include ('../helperFunctions/dbConnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/genre.css">

</head>
<body>

    <div class="top-div">
        <header class="left-head">
        <a href='../index.php'><img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo"></a>
            <form action="../procFiles/search_proc.php" method="get">
            <input type="search" name="search" id="search" class="search" placeholder="Search">
            </form>

            <a  class="writer" href=""><p class="write">Write</p> <img class="writing" src="../Accessories/writing.png" alt="writing"></a>
        </header>


        <div class="dropdown">
		<button class="profile-button"> <img class="userprofile" src="../Accessories/face_FILL1_wght100_GRAD-25_opsz48.png" alt=""></button>
        <img class="expand" src="../Accessories/expand_more_FILL0_wght100_GRAD-25_opsz48.png" alt="">
		<div class="dropdown-content">
			<a href="editProfile.php"> <img src="./Accessories/profile icon.png" alt=""> Profile</a>
			<a href="articles.php"> <img src="./Accessories/stories.png" alt=""> Stories</a>
			<a href="settings.php"> <img src="./Accessories/gear.png" alt=""> Settings</a>
			<a href="../procFiles/logout_proc.php"> <img src="./Accessories/logout_FILL1_wght100_GRAD-25_opsz48.png" alt=""> Sign out</a>
		</div>
	    </div>
    </div>

    


    <div class="mid-div">

    <h3 class="more-genres">More Genres</h3>

    <?php


    // query for genres for display
    $sql = "SELECT name FROM Genres";

    $result = mysqli_query($conn, $sql);


    // check if query returned anything

        while ($row = mysqli_fetch_assoc($result)) {

            ?>
            <p><?php echo $row['name'];?><p>

            <?php
        }
        ?>
        


    </div>



</body>
</html>