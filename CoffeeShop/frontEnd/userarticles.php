<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">

</head>
<body>

    <div class="top-div">
        <header class="left-head">
             <a href = '../index.php'><img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo"></a>
            <form action="../procFiles/search_proc.php" method="get">
            <p class="articles"> Articles </p>
            </form>

            <a  class="writer" href=""><p class="write">Write</p> <img class="writing" src="../Accessories/writing.png" alt="writing"></a>
        </header>


        <div class="dropdown">
		<button class="profile-button"> <img class="userprofile" src="../Accessories/face_FILL1_wght100_GRAD-25_opsz48.png" alt=""></button>
        <img class="expand" src="./Accessories/expand_more_FILL0_wght100_GRAD-25_opsz48.png" alt="">
		<div class="dropdown-content">
			<a href="editProfile.php"> <img src="./Accessories/profile icon.png" alt=""> Profile</a>
			<a href="articles.php"> <img src="./Accessories/stories.png" alt=""> Stories</a>
			<a href="settings.php"> <img src="./Accessories/gear.png" alt=""> Settings</a>
			<a href="../procFiles/logout_proc.php"> <img src="./Accessories/logout_FILL1_wght100_GRAD-25_opsz48.png" alt=""> Sign out</a>
		</div>
	    </div>
    </div>

    


    <div class="mid-div">
        <a href="" class="published">Published</a>
        <a href="" class="draft">Draft</a>
    </div>

    <?php

        $subscriberId = 'subscriber_id';


        // display all the user's articles
        $sql = "SELECT * FROM Published WHERE subscriber_id = '$_SESSION[$subscriberId]' ORDER BY time_published";

        $result = mysqli_query($conn, $sql);

        // number of rows returned
        $count = mysqli_num_rows($result);

        // put the article's attributes in an array. for every call of row, the next row is returned
        $row = mysqli_fetch_assoc($result);

        while ($row = mysqli_fetch_assoc($result)) {

            // attributes to be displayed
            $title = $row['title'];
            $subtitle = $row['subtitle'];
            $feature_image = $row['feature_image'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            ?>

            <div>
                <p><?php echo $title; ?></p>
                <p><?php echo $subtitle; ?></p>
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['feature_image']); ?>"/>
                <p><?php echo $fname; ?></p>
                <p><?php echo $lname; ?></p>
            </div>
            
            <?php }?>


            <!-- if there's no article, echo, "No articles yet..."-->
            <?php 
        
            if ($count == 0) {
                ?>
                <p><?php echo "No articles yet...";?></p>

            <?php } ?> 


</body>
</html>