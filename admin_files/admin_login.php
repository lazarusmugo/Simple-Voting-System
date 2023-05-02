<?php
$conn =  new mysqli("localhost", "root","", "voters_db");
if(! $conn )
{
 die('Could not connect: ' . mysqli_error($conn));
}

session_start();
// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get user input
  $username = $_POST['username'];
  $password = $_POST['password'];

  // check if credentials are valid
  $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $_SESSION['admin_username'] = $username; // set session variable
    header("Location: admin_dashboard.php"); // redirect to dashboard
    exit;
  } else {
    $error_message = 'Invalid username or password'; // set error message
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>

<h1>Admin Login</h1>

<form method="POST">
  <div>
    <label>Username:</label>
    <input type="text" name="username" required>
  </div>
<br>
  <div>
    <label>Password:</label>
    <input type="password" name="password" required>
  </div>
  <br>
  <?php if (!empty($error_message)) { ?>
    <div><?php echo $error_message; ?></div>
  <?php } ?>

  <button type="submit">Login</button>
</form>

</body>
</html>