<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'fake_moodle';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT ID,username, password, course, userType FROM student_data WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($ID, $username, $password, $course, $userType);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        // if (password_verify($_POST['password'], $password)) {
        if ($_POST['password'] === $password && $userType === 'student') {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['ID'] = $ID;
            $_SESSION['course'] = $course;
            $_SESSION['userType'] = $userType;

            $cookie_name = "user";
            $cookie_value = $_SESSION['name'];
            // $_SESSION['cookie'] = $cookie_value;

            setcookie("user", $_SESSION['name'], time() + 30 * 24 * 60 * 60);

            header("location:../dashboard/student/sindex.php");
            // echo 'Welcome back, ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
        } else if ($_POST['password'] === $password && $userType === 'admin') {

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['ID'] = $ID;
            $_SESSION['course'] = $course;
            $_SESSION['userType'] = $userType;

            $cookie_name = "user";
            $cookie_value = $_SESSION['name'];
            // $_SESSION['cookie'] = $cookie_value;

            setcookie("user", $_SESSION['name'], time() + 30 * 24 * 60 * 60);
            header("location:../dashboard/admin/aindex.php");
        } else {
            // Incorrect password
            echo "<script type='text/javascript'> 
        alert('Incorrect Username or Password. Try Again.');
        window.location.href = 'login.php'; 
      </script>";
        }
    } else {
        // Incorrect username
        echo "<script type='text/javascript'> 
        alert('User not Registered. Contact Us.');
        window.location.href = 'login.php';
      </script>";
    }


    $stmt->close();
}
?>