<?php 

if (isset($_GET['subscriber_id'])) {

    $subscriber_id = $_GET['subscriber_id'];

    include ('../helperFunctions/dbConnect.php');

    $sql = "SELECT Subscribers.fname, Subscribers.lname, Subscribers.bio, Subscribers.profile_pic
    FROM Subscribers
    WHERE Subscribers.subscriber_id = $subscriber_id";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $fname = $row['fname'];
        $lname = $row['lname'];
        $bio = $row['bio'];
        $profile_pic = $row['profile_pic'];

        ?>

        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['profile_pic']); ?>"/>
        <p><?php echo $fname;?></p>
        <p><?php echo $lname;?></p>
        <p><?php echo $bio;?></p>
        
    <?php
    } 

}

?>

// sudo apt install mysql_server