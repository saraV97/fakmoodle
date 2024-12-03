<?php
session_start();
if ($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == '') {
    header("location:../../login/login.php");
}
include '../dbConnection.php';
$conn = OpenCon();

// echo $_SESSION['course'];

$name = $_SESSION['name'];

$sql = "SELECT * FROM announcements ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($conn, $sql);#

$course = $_SESSION['course'];
// echo $course;
$sql1 = "SELECT * FROM course WHERE courseTitle = ?";
$stmt = $conn->prepare($sql1);
$stmt->bind_param('s', $course);
$stmt->execute();
$result1 = $stmt->get_result();

// -- $row2 = mysqli_fetch_array($result2);

CloseCon($conn);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Course | FakeMoodle</title>
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

<body>


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
                        Student Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="./sIndex.php" class="sidebar-link ">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="myCourse.php" class="sidebar-link nav-link active" data-bs-target="#pages"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            My Course
                        </a>

                    </li>

                    <li class="sidebar-item">
                        <a href="announcement.php" class="sidebar-link collapsed" data-bs-target="#auth"
                            aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Announcement
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="https://napier.primo.exlibrisgroup.com/discovery/search?vid=44NAP_INST:44NAP_ALMA_VU1"
                            class="sidebar-link collapsed" data-bs-target="#auth" aria-expanded="false"><i
                                class="fa-regular fa-user pe-2"></i>
                            Resources
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link " data-bs-target="#posts" aria-expanded="false"><i
                                class="fa-solid fa-sliders pe-2"></i>
                            Grades
                        </a>

                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" aria-expanded="false"><i
                                class="fa-regular fa-user pe-2"></i>
                            Tasks
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
        <div class="main rounded-4">
            <nav class="navbar navbar-expand px-4 ms-1 pb-0">
                <!-- <button class="btn" id="sidebar-toggle" type="button">
            <span class="navbar-toggler-icon"></span>
        </button> -->
                <div class="display-6">My Course</div>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <li class="nav-item dropdown pe-4 mt-2 align-self-center">
                                <a href="#" data-bs-toggle="dropdown" class="">
                                    <i class="fa-regular fa-bell h3"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">

                                        <div class="small ">You have a new Announcement for
                                            <span class="fw-bold"><?php echo "{$row['subject']}"; ?></span>
                                        </div>
                                        <div class="small">Poster by <span
                                                class="small text-success ps-1"><?php echo "{$row['poster']}"; ?></span>
                                        </div>

                                    </a>
                                </div>
                            </li>
                        <?php } ?>
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../../assets/prof1.jpg" class="avatar shadow-sm img-fluid rounded-5" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="../../Login/logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col-7 ">
                                        <div class="h5">Your Course Title</div>
                                        <div class="fw-bold h4"><?php echo $course; ?></div>
                                    </div>
                                    <div class="col-5 h5">
                                        <div class="h5">Course Year</div>
                                        <div class="fw-bold h5">2024 - 2025</div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="h6">Your Subjects</div>
                                                <div class="card-body border rounded-3 py-2 mb-2">
                                                    <div class="d-flex flex-row justify-content-between">
                                                        <div class="fw-bold h5 align-content-center">
                                                            <?php echo "{$row1['subject1']}"; ?>
                                                        </div>
                                                        <a href="subject.php?subject=<?php echo "{$row1['subject1']}"; ?>"
                                                            class="btn btn-outline-primary py-1">View
                                                            Subject</a>
                                                    </div>

                                                    <div class="d-flex flex-row justify-content-start gap-5">
                                                        <div class=" align-content-center">Lecturers:</div>
                                                        <div><img
                                                                src="https://i0.wp.com/www.andrew-mason.com/wp-content/uploads/2015/04/Headshot-Photoggrapher-London.jpg?resize=400%2C599&ssl=1"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">John Oliver</span>
                                                        </div>
                                                        <div><img
                                                                src="https://plus.unsplash.com/premium_photo-1683121771856-3c3964975777?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">Olivia</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body border rounded-3 py-2 mb-2">
                                                    <div class="d-flex flex-row justify-content-between">
                                                        <div class="fw-bold h5 align-content-center">
                                                            <?php echo "{$row1['subject2']}"; ?>
                                                        </div>
                                                        <a href="subject.php?subject=<?php echo "{$row1['subject2']}"; ?>"
                                                            class="btn btn-outline-primary py-1">View
                                                            Subject</a>
                                                    </div>

                                                    <div class="d-flex flex-row justify-content-start gap-5">
                                                        <div class=" align-content-center">Lecturers:</div>
                                                        <div><img
                                                                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">John Josefa</span>
                                                        </div>
                                                        <div><img
                                                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">Veronica Leach </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body border rounded-3 py-2">
                                                    <div class="d-flex flex-row justify-content-between">
                                                        <div class="fw-bold h5 align-content-center">
                                                            <?php echo "{$row1['subject3']}"; ?>
                                                        </div>
                                                        <a href="subject.php?subject=<?php echo "{$row1['subject3']}"; ?>"
                                                            class="btn btn-outline-primary py-1">View
                                                            Subject</a>
                                                    </div>

                                                    <div class="d-flex flex-row justify-content-start gap-5">
                                                        <div class=" align-content-center">Lecturers:</div>
                                                        <div><img src="../../assets/prof3.jpg"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">Bonie Jason</span>
                                                        </div>
                                                        <div><img
                                                                src="https://plus.unsplash.com/premium_photo-1683140621573-233422bfc7f1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                                class="avatar shadow-sm img-fluid rounded-5" alt="">
                                                            <span class="px-2">Timothy Tseng</span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class=" col-4">
                            <div class="card">
                                <div class="card-body d-flex flex-column text-center">
                                    <div class="h6 pb-3">Upcomming Classes</div>
                                    <li class="hstack">
                                        <div class="col-4">
                                            <img src="https://img.freepik.com/free-photo/elegant-young-teacher-with-brunette-hair-stylish-light-shirt-black-striped-suit-glasses-holding-writings-pen-giving-lecture_197531-24666.jpg?t=st=1733195339~exp=1733198939~hmac=e3f71899d5b5d4003ac9d215ec7e633d44f09900997a9431fb30eb6d12375b3f&w=826"
                                                class="avatar1 shadow-sm img-fluid rounded-5" alt="">
                                        </div>
                                        <div class="col-8">
                                            <span class="small fw-bold">Programme Leader</span>
                                            <div class="h5">John Oliver</div>
                                        </div>
                                    </li>
                                    <li class="hstack pt-3">
                                        <div class="col-4">
                                            <img src="https://img.freepik.com/free-photo/teacher-with-glasses-class_23-2148665899.jpg?t=st=1733195242~exp=1733198842~hmac=0f0216fae2c9d7bfceec76cd81a5afce0dfb77ca3b217a73684fdb75e50fbfce&w=360"
                                                class="avatar1 shadow-sm img-fluid rounded-5" alt="">
                                        </div>
                                        <div class="col-8">
                                            <span class="small fw-bold">Personnel Development Tutor</span>
                                            <div class="h5">Gemma James</div>
                                        </div>
                                    </li>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="h6">Important Dates</div>
                                    <div>
                                        <ul class="m-0 p-0">
                                            <li class="hstack">
                                                <div class="col-8">
                                                    <span class="small fw-bold">Assignment Submission</span>

                                                    <div>Web Development</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col-3 text-center ps-4">
                                                    <span class="h5">3th</span>
                                                    <div>Dec</div>
                                                </div>
                                            </li>
                                            <li class="hstack mt-3">
                                                <div class="col-8">
                                                    <span class="small fw-bold">Assignment Submission</span>

                                                    <div>Database Systems</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col-3 text-center ps-4">
                                                    <span class="h5">6th</span>
                                                    <div>Dec</div>
                                                </div>
                                            </li>
                                            <li class="hstack mt-3">
                                                <div class="col-8">
                                                    <span class="small fw-bold">Semester Exam</span>
                                                    <div>Computer Systems</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col-3 text-center ps-4">
                                                    <span class="h5">19th</span>
                                                    <div>Dec</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

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