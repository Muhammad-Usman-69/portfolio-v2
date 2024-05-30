<?php
include ("_verify.php");
include ("_dbconnect.php");
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit();
}
$name = $_POST["name"];
$url = $_POST["url"];
$num = $_POST["num"];

$sql = "UPDATE `skills` SET `name` = ?, `url` = ? WHERE `num` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $name, $url, $num);
mysqli_stmt_execute($stmt);
header("location: ../edit");