<?php
session_start();
if ($_SESSION['userType'] == 'student') {
    header("location:../../login/login.html");
}
include '../dbConnection.php';
$conn = OpenCon();

if ($_GET["student_id"]) {
    $user_id = $_GET["student_id"];
    echo $user_id;
    $sql = "DELETE FROM student_data WHERE ID ='" . $_GET["student_id"] . "'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location:manageStudent.php");
    }
}
CloseCon($conn);
// }
?>