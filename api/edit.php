<?php
include ("partials/_verify.php");
include ("partials/_dbconnect.php");
/* function random_str(
  $length,
  $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
  $str = '';
  $max = mb_strlen($keyspace, '8bit') - 1;
  if ($max < 1) {
      throw new Exception('$keyspace must be at least two characters long');
  }
  for ($i = 0; $i < $length; ++$i) {
      $str .=  $keyspace[random_int(0, $max)];
  }
  return $str;
}

echo random_str(10); */

$id = "odNykl2Fww";

//fetching info
$sql = "SELECT * FROM `info` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$name = $row["name"];
$profession = $row["profession"];
$img = $row["img"];

//checking if available
if ($name == null || $profession == null || $img == null) {
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Portfolio Info</title>
  <style>
    body {
      font-family: arial;
    }
  </style>
</head>

<body>
  <form action="partials/_updateinfo" style="display: flex; flex-direction: column" method="post">
    <h4>Change Info</h4>
    <input type="text" value="<?php echo $id; ?>" id="id" name="id" />
    <input type="text" value="<?php echo $name; ?>" id="name" name="name" />
    <input type="text" value="<?php echo $profession; ?>" id="profession" name="profession" />
    <input type="text" value="<?php echo $img; ?>" id="img" name="img" />
    <input type="submit" />
  </form>

  <form action="partials/_insertproject" style="display: flex; flex-direction: column" method="post">
    <h4>Insert Project</h4>
    <input type="text" placeholder="name" id="name" name="name" required />
    <input type="text" placeholder="url" id="url" name="url" required />
    <input type="text" placeholder="description" id="description" name="description" required />
    <input type="text" placeholder="main" id="main" name="main" required>
    <input type="submit" />
  </form>

  <form action="partials/_insertskill" style="display: flex; flex-direction: column" method="post">
    <h4>Insert Skill</h4>
    <input type="text" placeholder="name" id="name" name="name" required />
    <input type="text" placeholder="url" id="url" name="url" required />
    <input type="submit" />
  </form>

  <h4>Change Projects Data</h4>
  <?php
  //fetching projects
  $sql = "SELECT * FROM `projects`";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $url = $row["url"];
    $description = $row["description"];
    $main = $row["main"];
    $num = $row["num"];
    echo '<form action="partials/_updateproject" style="display: flex; flex-direction: column" method="post">
      <input type="number" value="' . $num . '" id="num" name="num" required />
      <input type="text" value="' . $name . '" id="name" name="name" required />
      <input type="text" value="' . $url . '" id="url" name="url" required />
      <input type="text" value="' . $description . '" id="description" name="description" required />
      <input type="text" value="' . $main . '" id="main" name="main" required>
      <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <input type="submit" />
        <button type="button" href="partials/_insertproject?del=1&num=' . $num . '">Delete</button>
      </div>
    </form>';
  }
  ?>

  <h4>Change Skills Data</h4>
  <?php
  //fetching projects
  $sql = "SELECT * FROM `skills`";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $url = $row["url"];
    $num = $row["num"];
    echo '<form action="partials/_updateskill" style="display: flex; flex-direction: column" method="post">
    <input type="number" value="' . $num . '" id="num" name="num" required />
    <input type="text" value="' . $name . '" id="name" name="name" required />
    <input type="text" value="' . $url . '" id="url" name="url" required />
      <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <input type="submit" />
        <button type="button" href="partials/_insertskill?del=1&num=' . $num . '">Delete</button>
      </div>
    </form>';
  }
  ?>

</body>

</html>