<?php
include ("_verify.php");
include ("_dbconnect.php");
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit();
}
$id = $_POST["id"];
$name = $_POST["name"];
$profession = $_POST["profession"];
$img = $_POST["img"];

$sql = "UPDATE `info` SET `name` = ?, `profession` = ?, `img` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $name, $profession, $img, $id);
mysqli_stmt_execute($stmt);
header("location: ../edit");