<?php
session_start();
setcookie("user", $_SESSION['name'], time() - 3600);
session_unset();
session_destroy();

// Redirect to the login page:
header('Location: ../index.html');
?>