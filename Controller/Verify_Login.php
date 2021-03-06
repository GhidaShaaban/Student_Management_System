<?php
try {
    header("Content-Type: application/json; charset=UTF-8");
    session_start();
    $_SESSION = array();
    require_once("../Model/DatabaseSMS.php");
    $db = new DatabaseSMS();
    $result = array();

    $username = $_POST["uname"];
    $password = $_POST["psw"];
    $loginType = $_POST["loginType"];

    switch ($loginType) {
        case "student":
            require_once('../Model/Student.php');
            $User = new Student($db);
            $pageLocation = "Student_Registration.php";
            break;
        case "teacher":
            require_once('../Model/Teacher.php');
            $User = new Teacher($db);
            $pageLocation = "Teacher_Profile.php";
            break;
        case "admin":
            require_once('../Model/Admin.php');
            $User = new Admin($db);
            $pageLocation = "Choose_Directory.php";
            break;

        default:
            die("Invalid Login Type");
    }
    $User->setUsername($username);
    $User->setPassword($password);




    if (!isset($_POST["uname"]) || !isset($_POST["psw"]) || !isset($_POST["loginType"])) {

        $result["Error"] = 1;
        $result["Message"] = "missing parameter";
        die(json_encode($result));
    } elseif (
        !$_POST["uname"]
        || !$_POST["psw"]
        || !$_POST["loginType"]
    ) {
        $result["Error"] = 1;
        $result["Message"] = "empty value";
        die(json_encode($result));
    } elseif ($User->verifyLogin() == true) {

        if (isset($_POST["remember"])) {

            setcookie('email', $username, time() + 60 * 60 * 7);
            setcookie('pass', $passwordd, time() + 60 * 60 * 7);
            setcookie('isLoggedIn', true, time() + 60 * 60 * 7);
        }

        $_SESSION["usern"] = $username;
        $_SESSION["pass"] = $password;
        $_SESSION["loginType"] = $loginType;
        $_SESSION["id"] = $User->getId();
        $_SESSION["userName"] = $User->getUserFirstName() . " " . $User->getUserLastName();
        $result["Error"] = 0;
        $result["Message"] = "Success";
        $result["location"] = $pageLocation;
        die(json_encode($result));
    } else {
        $result["Error"] = 0;
        $result["Message"] = "Invalid Username or Password";
        die(json_encode($result));
    }
} catch (Exception $e) {
    header("Location:../View/SignIn.php?result=" . $e->getMessage());
}
