<?php
session_start();
include 'connect.php';
include("functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>

<head>
    <title>SR Edu Technologies</title>
</head>
<style>
    h1 {
        text-align: center;
        color: green;
    }

    .details {
        text-align: center;
        /* color: blue; */
        display: flex;
        margin-left: 32%;
    }

    .box a{
        text-decoration: none;
        background-color: black;
        color: white;
        list-style: none;
    }
</style>

<body>
    <span class="box">
        <a href="logout.php">Logout</a>
    </span>

    <br>
    <h1>Your information</h1> <br><br>
    <div class="details">
        <!-- <table>
            <tr>id</tr>
            <tr>Name</tr>
            <tr>Email-id</tr>
            <tr>DOB</tr>
            <tr>Contact</tr>
            <tr>Image</tr>
        </table> -->
        <div class="left">
            Name - <?php echo $user_data['name']; ?> <br>
            Email-id - <?php echo $user_data['email']; ?> <br>
            DOB - <?php echo $user_data['dob']; ?> <br>
            Contact - <?php echo $user_data['contact']; ?> <br>
        </div>
        <div class="right">
            Profile Image : <br>
            <td><img src="uploads/<?php echo $user_data['profile_image']; ?>" width="200px" alt=""></td>
        </div>
    </div>
    <br><br>


</body>

</html>