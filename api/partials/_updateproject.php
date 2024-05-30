<?php
include ("_verify.php");
include ("_dbconnect.php");
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit();
}
$num = $_POST["num"];
$name = $_POST["name"];
$url = $_POST["url"];
$description = $_POST["description"];
$main = $_POST["main"];

$sql = "UPDATE `projects` SET `name` = ?, `url` = ?, `description` = ?, `main` = ? WHERE `num` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $name, $url, $description, $main, $num);
mysqli_stmt_execute($stmt);
header("location: ../edit");