<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "lms_db";
$con = mysqli_connect($host, $user, $pass, $dbname);

function test($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$_SESSION['categoryErr'] = '';
$categoryName = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_category = test($_POST['category']);

    if (empty($_POST["category"])) {

        $_SESSION['categoryErr'] = '*Category Name is required';

    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $input_category)) {

        $_SESSION['categoryErr'] = '*Input a valid Category Name';

    } else {
        $categoryName = $input_category;
    }

    if (empty($_SESSION['categoryErr'])) {
        $sql = "insert into category (categoryName, Status) values(?, ?)";
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_category, $param_status);
            $param_category = $categoryName;
            $param_status = $_POST['status'];

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['validres'] = "Category Added Successfully!";
                header("location: addCategory.php");
            } else {
                $_SESSION['invalidres'] = "Sorry! Something went wrong!";
                header("location: addCategory.php");
            }
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $_SESSION['categoryErr'];
        header('location: addCategory.php');
    }

    mysqli_close($con);
}
?>
