<?php
session_start();
include 'connect.php';
include("functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    $profile_image = $_FILES['profile_image']['name'];



    // Validate the input fields (both client and server-side validation)

    // Validate profile image upload
    $profile_image = $_FILES["profile_image"]["name"];
    $imageFileType = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Profile image must be in JPG, JPEG, or PNG format.";
    } else {
        // Move uploaded profile image to a suitable location
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], "uploads/" . $profile_image);

        if (!empty($name) && !empty($password) && !is_numeric($name)) {

            // Remove any non-digit characters (e.g., spaces, dashes, etc.)
            $contact = preg_replace("/[^0-9]/", "", $contact);

            if (strlen($contact) === 10 && is_numeric($contact)) {
                // The input contains exactly 10 digits and is numeric
                // You can proceed with the form submission
                $user_id = random_num(20);
                $sql = "INSERT INTO users (user_id,name, age, email, dob, contact, password, profile_image) VALUES ('$user_id','$name', '$age', '$email', '$dob', '$contact','$password', '$profile_image')";
                mysqli_query($con, $sql);
                header("Location: login.php");
                die;
            } else {
                // The input does not meet the criteria
                echo "Contact number must be exactly 10 digits.";
            }
        } else {
            echo "Please enter some valid information!";
        }
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>SR Edu Technologies</title>
</head>
<style>
    h1 {
        text-align: center;
        color: green;
    }

    form {
        width: 50%;
        margin-left: 28%;
        /* border: 2px solid black; */
    }
</style>

<body>
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <h1>Signup</h1>
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" required><br>

        <label for="age">Age:</label>
        <input type="number" class="form-control" name="age" required><br>

        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="text" name="dob" class="datepicker" autocomplete="off" required><br>

        <label for="contact">Contact Number:</label>
        <input type="tel" class="form-control" name="contact" required><br>

        <label for="profile_image">Profile Image:</label>
        <input type="file" class="form-control" name="profile_image" accept=".jpg, .jpeg, .png" required><br>

        <label for="contact">Password:</label>
        <input type="tel" class="form-control" name="password" required><br>

        <input type="submit" class="btn btn-primary w-100" value="Signup">
        <a href="login.php">Login</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd-mm-yy"
            });
        });
    </script>
</body>

</html>