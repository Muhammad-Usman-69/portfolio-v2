<?php
include("partials/_dbconnect.php");

if ($conn == false) {
    exit();
}

//initiating array
$arr = array();

//table names
$tables = array("info", "skills", "projects");

//moving through each table
foreach ($tables as $table) {
    $section = array();
    $sql = "SELECT * FROM `$table`";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        //removing first element
        array_shift($row);
        //pushing row to sections
        array_push($section, $row);
    }
    //pushing sections to whole blocks
    array_push($arr, $section);
}

header("Content-Type:JSON");
echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);