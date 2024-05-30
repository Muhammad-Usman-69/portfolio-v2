<?php
include ("_verify.php");
include ("_dbconnect.php");

if (isset($_GET["del"]) && $_GET["del"] == 1) {
    //if user is deleting
    $sql = "DELETE FROM `skills` WHERE `num` = ?";
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

$sql = "INSERT INTO `skills` (`name`, `url`) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $name, $url);
mysqli_stmt_execute($stmt);
header("location: ../edit");