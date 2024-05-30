<?php
include ("_verify.php");
include ("_dbconnect.php");

if (isset($_GET["del"]) && $_GET["del"] == 1) {
    //if user is deleting
    $sql = "DELETE FROM `projects` WHERE `num` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_GET["num"]);
    mysqli_stmt_execute($stmt);
    header("location: ../edit");
    exit();
}

//checking post
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location: ../edit");
    exit();
}

$name = $_POST["name"];
$url = $_POST["url"];
$description = $_POST["description"];
$main = $_POST["main"];

if ($name == "" || $url == "" || $description == "" || $main == "") {
    header("location: ../edit");
    exit();
}

$sql = "INSERT INTO `projects` (`name`, `url`, `description`, `main`) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $name, $url, $description, $main);
mysqli_stmt_execute($stmt);
header("location: ../edit");
exit();