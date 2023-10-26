<?php
session_start();

include("connect.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the input fields (both client and server-side validation)

    // Authenticate user (query the database using MySQL)

    // Start a session for the user if login is successful
    // session_start();
    if (!empty($email) && !empty($password) && !is_numeric($email)) {

        //read from database
        $sql = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $sql);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: user.php");
                    die;
                }
            }
        }

        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
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
    <form action="login.php" method="post">
        <h1>Login</h1>
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required><br>

        <input type="submit" class="btn btn-primary w-100" value="Login">
        <a href="signup.php">Signup</a>
    </form>
</body>

</html>