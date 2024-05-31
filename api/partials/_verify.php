<?php
session_start();

//checking if user is verified
if (!isset($_SESSION["verified"]) && $_SESSION["verified"] == false) {
    header("location:../partials/_form.php");
    exit();
}