<?php
session_start();
if ($_SESSION['userType'] == 'student') {
    header("location:../../login/login.html");
}
include '../dbConnection.php';
$conn = OpenCon();

if (isset($_POST['addStudent'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $studentID = $_POST['studentID'];
    $year = $_POST['year'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = 'student';

    // $check = "SELECT * FROM student_data WHERE username = $username";
    // $checkUser = mysqli_query($conn, $check);
    // if (mysqli_num_rows($checkUser) == 1) {
    //     echo "<script type='text/javascript'>
    //     alert('Username already exists. Try a different one.')
    //     </script>";
    // } else {

    $sql = " INSERT INTO student_data(ID,fname,lname,email,phone,age,country,address,course,year,username,password,userType)
VALUES ('$studentID','$fname', '$lname', '$email', '$phone', '$age', '$country', '$address', '$course', '$year', '$username', '$password','$userType')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script type='text/javascript'>
        alert('Data Upload Success')
        </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Data Upload Failed')
        </script>";
    }
}

$sql2 = "SELECT * FROM course ORDER BY courseID";
$result2 = mysqli_query($conn, $sql2);

CloseCon($conn);
// }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FakeMoodle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
</head>


<div class="wrapper">

    <aside id="sidebar" class="rounded-4 sticky-top">
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="../../index.html"
                    class="navbar-brand fw-bold d-flex flex-row justify-content-center align-items-center">
                    <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z"
                            fill="#5417D7"></path>
                    </svg>
                    <div class="h6 pt-2 px-2 fw-bold">FakeMoodle</div>
                </a>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-header opacity-75">
                    Admin Menu
                </li>
                <li class="sidebar-item">
                    <a href="aIndex.php" class="sidebar-link">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed nav-link" data-bs-target="#pages"
                        data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                        Students
                    </a>
                    <ul id="pages" class="sidebar-dropdown list-unstyled  ms-4" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addStudent.php" class="sidebar-link nav-link active">Add Student</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="manageStudent.php" class="sidebar-link">Manage Student</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                        aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                        Subjects
                    </a>
                    <ul id="posts" class="sidebar-dropdown list-unstyled collapse ms-4" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addSubject.php" class="sidebar-link">Add Subject</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="manageSubject.php" class="sidebar-link">Manage Subject</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="announcement.php" class="sidebar-link collapsed" data-bs-target="#auth"
                        aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                        Announcement
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" aria-expanded="false"><i
                            class="fa-regular fa-user pe-2"></i>
                        Grades
                    </a>
                </li>

            </ul>
        </div>
    </aside>
    <div class="main rounded-4">
        <nav class="navbar navbar-expand px-4 ms-1">

            <div class="display-6">Add Student</div>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown pe-4 mt-2 align-self-center">
                        <a href="#" data-bs-toggle="dropdown" class="">
                            <i class="fa-regular fa-bell h3"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <img src="../../assets/prof1.jpg" class="avatar shadow-sm img-fluid rounded-5" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="profile.php" class="dropdown-item">Profile</a>
                            <a href="../../login/logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content px-3 py-2 ">
            <div class="container-fluid">
                <div class="row">
                    <form class="my-4" action="#" method="POST">
                        <div class=" col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="h5 pb-3">Enter Student Details</div>
                                    <!-- <div class="">12th November, 2024</div> -->
                                    <div>

                                        <div class="mb-3 row">
                                            <div class="col">
                                                <label class="form-label">First
                                                    Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname"
                                                    required>

                                            </div>
                                            <div class="col">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="mb-3 col">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="name@example.com" required>
                                            </div>

                                            <div class="mb-3 col">
                                                <label class="form-label">Phone</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">+44</div>
                                                    </div>

                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        min="10" max="11" placeholder="9898989898" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="mb-3 col">
                                                <label class="form-label">Age</label>
                                                <input type="number" class="form-control" min="22" max="100" step="1"
                                                    value="22" id="age" name="age" required>
                                            </div>

                                            <div class="mb-3 col">
                                                <label class="form-label">Country</label>
                                                <select class="form-control" id="country" name="country" required>
                                                    <option selected disabled value="">Choose...</option>
                                                    <option>United Kingdom</option>
                                                    <option>France</option>
                                                    <option>USA</option>
                                                </select>
                                                <!-- <input type="text" class="form-control" id="country" name="country"
                                                    placeholder="United Kingdom" required> -->
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Residential Address" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Course</label>
                                            <select class="form-control" id="course" name="course" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option><?php echo "{$row['courseTitle']}"; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label class="form-label">Subject 1</label>
                                            <select class="form-control" id="subject1" name="subject1" required>
                                                <option selected disabled value="">Choose...</option>

                                                <option>Software Development</option>
                                                <option>Web Development</option>
                                                <option>Database System</option>
                                                <option>Software Development</option>
                                                <option>Software Development</option>
                                                <option>Software Development</option>

                                            </select>
                                        </div> -->

                                        <div class="mb-3 row">
                                            <div class="mb-3 col">
                                                <label class="form-label">Student
                                                    ID</label>
                                                <input type="number" class="form-control" id="studentid"
                                                    name="studentID" placeholder="______" required>
                                            </div>

                                            <div class="mb-3 col">
                                                <label class="form-label">Year</label>
                                                <input class="form-control" type="number" min="1900" max="2099" step="1"
                                                    value="2024" id="year" name="year" placeholder="2024" required>
                                            </div>
                                        </div>

                                        <!-- <button type="submit" class="btn btn-primary">Register</button> -->

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>

                        <div class=" col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="h6">Login Details</div>
                                    <div class="mb-3 row">
                                        <div class="mb-3 col">
                                            <label class="form-label">Username</label>
                                            <input type="username" class="form-control" id="username" name="username"
                                                minlength="5" required>

                                        </div>

                                        <div class="mb-3 col">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                minlength="5" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary w-25 px-3" name="addStudent"
                                value="addStudent">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </main>


    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    </script>
    </body>

</html>