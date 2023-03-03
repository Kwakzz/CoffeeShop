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
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/editProfile.css">
</head>
<body>

    <div class="top-div">
        <header class="left-head">
             <a href='../index.php'><img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo"></a>
            <form action="../procFiles/search_proc.php" method="get">
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

    <?php




        $subscriberId = 'subscriber_id';
        $sql = "SELECT bio, username, profile_pic FROM Subscribers WHERE subscriber_id='$_SESSION[$subscriberId]'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $bio = $row['bio'];
        $user_name = $row['username'];



        ?>

    


    <div class="mid-div">
        <h3>Edit Profile</h3>
        <form action="../procFiles/editProfile_proc.php" method="GET">
        <div class="profile-pic">
            <p class="profile"> <b>Profile Picture </b> </p>
            <label class="custom-upload-button" for="upload-button">Upload from Computer</label>
            <input type="file" id="upload-button" class="upload-btn" name="profile_pic" accept="image/*" onchange="selectPicture()" value = <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['profile_pic']); ?>"/>>
            <div id="picture-container">
                <!-- <img class="profile-icon" src="./Accessories/user copy.png" alt=""> -->
            </div>
        </div>

        

        <div class="name">
        <label for="det" class="det1">Username</label>
        <input type="text" class="det" name="user_name" id="det" value=<?php echo $user_name; ?>>
        
        <div class="bio">
        <label for="det" class="det2">Bio</label>
        <input type="text" class="det" name="bio" id="det" value=<?php echo $bio; ?>>
        </div>


        <input class="discard" name="save_changes" type="submit" value="Save">
            <input class="save" type="button" value="Cancel">


</form>

    </div>

</body>

<script src = "../js/editProfile.js"></script>

</html>