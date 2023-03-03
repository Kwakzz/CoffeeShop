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
    <title>Coffeeshop Writers</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/writers.css">

</head>
<body>

<div class="top-div">
    <header class="left-head">
    <a href='../index.php'><img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo"></a>
        <form action="../procFiles/search_proc.php" method="GET">
        <input type="search" name="search" id="search" class="search" placeholder="Search">
        </form>

        <a  class="writer" href="write.php"><p class="write">Write</p> <img class="writing" src="../Accessories/writing.png" alt="writing"></a>
    </header>


    
    <div class="dropdown">
		<button class="profile-button"> <img class="userprofile" src="../Accessories/face_FILL1_wght100_GRAD-25_opsz48.png" alt=""></button>
        <img class="expand" src="../Accessories/expand_more_FILL0_wght100_GRAD-25_opsz48.png" alt="">
		<div class="dropdown-content">
			<a href="editProfile.php"> <img src="../Accessories/profile icon.png" alt=""> Profile</a>
			<a href="articles.php"> <img src="../Accessories/stories.png" alt=""> Stories</a>
			<a href="settings.php"> <img src="../Accessories/gear.png" alt=""> Settings</a>
			<a href="../procFiles/logout_proc.php"> <img src="../Accessories/logout_FILL1_wght100_GRAD-25_opsz48.png" alt=""> Sign out</a>
		</div>
	    </div>
    </div>

    


    <div class="mid-div">
        <h3 class="writers">Our Writers</h3>

        <div class="trends">
            <img class="trending" src="../Accessories/trending.png" alt="trending">
        <h2 class="trend-text">Trending</h2> 
        </div>

        <!-- <div class="custom-dropdown">
		<button class="profile-button"> Select genre</button>
        <img class="expand" src="../Accessories/expand_more_FILL0_wght100_GRAD-25_opsz48.png" alt="">
		<div class="dropdown-content">
			<a href="#"> <img src="../Accessories/profile icon.png" alt=""> Profile</a>
			<a href="#"> <img src="../Accessories/stories.png" alt=""> Stories</a>
			<a href="#"> <img src="../Accessories/gear.png" alt=""> Settings</a>
			<a href="#"> <img src="../Accessories/logout_FILL1_wght100_GRAD-25_opsz48.png" alt=""> Sign out</a>
		</div>
	    </div> -->
    </div>

    </div>

    <?php
    
    // fetch writers from database
    // display in order of writers with most views
    $sql = "SELECT Subscribers.fname, Subscribers.lname, Subscribers.bio, Subscribers.profile_pic, COUNT(Views.published_id) AS no_of_views
    FROM Subscribers, Views, Published
    WHERE Subscribers.subscriber_id = Published.subscriber_id AND Views.published_id = Published.published_id
    GROUP BY Views.published_id
    ORDER BY no_of_views DESC";

    $result = mysqli_query($conn, $sql);

        // number of rows returned
        $count = mysqli_num_rows($result);

        // put the article's attributes in an array. for every call of row, the next row is returned
        $row = mysqli_fetch_assoc($result);

        while ($row = mysqli_fetch_assoc($result)) {

            // attributes to be displayed
            $fname = $row['fname'];
            $lname = $row['lname'];
            $bio = $row['bio'];
            $profile_pic = $row['profile_pic'];
            ?>

            <div class="author">
            <!-- <img class="profilepic" src="data:image/jpg;charset=utf8;base64, 
            -->
            <div class="author1">
                <div class="imagecontainer"></div>
                <p class="name"><?php echo $fname. " ". $lname;?></p>
                <p class="bio"><?php echo $bio; ?></p>
                </div>
            </div>
            
            <?php 
            }

    
    ?>


    <script src="../js/writers.js"></script>



</body>
</html>