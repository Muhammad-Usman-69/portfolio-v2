<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["code"])) {
    $password = '$2y$10$i4WoghW0/upjiYV8aNpnEekj9HCwiRId3fJE3ASNDDbc90QvHCj/q';
    //verifying code
    if (password_verify($_POST["code"], $password)) {
        session_start();
        $_SESSION["verified"] = true;
        header("location: ../edit");
        exit();
    } else {
        echo "Wrong Password";
    }
}

?>

<form action="_form" method="post">
    <input type="text" placeholder="verification code" name="code" id="code">
    <input type="submit">
</form>