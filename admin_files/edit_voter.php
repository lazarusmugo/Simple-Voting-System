<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit;
  }

// Connect to the database
$conn = new mysqli("localhost", "root", "", "voters_db");
if (!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ID = $_POST['ID'];
  $name = $_POST['name'];
  $password = $_POST['password'];
  $Voted = $_POST['Voted'];

  $sql = "UPDATE voters SET name='$name', password='$password', Voted='$Voted' WHERE ID=$ID";
  if ($conn->query($sql) === TRUE) {
    $success_message = "Voter updated successfully!";
  } else {
    $error_message = "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Get the voter data from the database
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
  $sql = "SELECT * FROM voters WHERE ID=$ID";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $password = $row['password'];
    $Voted = $row['Voted'];
  } else {
    $error_message = "Voter not found!";
  }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Voter</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
  <h1>Edit Voter</h1>
  <a href="manage_voters.php">Back to Manage Voters</a>
  
  <?php if (isset($error_message)) { ?>
    <div class="error"><?php echo $error_message; ?></div>
  <?php } else { ?>
    <?php if (isset($success_message)) { ?>
      <div class="success"><?php echo $success_message; ?></div>
    <?php } ?>
    
    <form method="POST" action="edit_voter.php">
      <input type="hidden" name="ID" value="<?php echo $ID; ?>">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
      </div>
      <div>
        <label for="Voted">Voted:</label>
        <input type="boolean" id="Voted" name="Voted" value="<?php echo $Voted; ?>" required>
      </div>
      <button type="submit" name="edit_voter">Update Voter</button>
    </form>
  <?php } ?>
</body>
</html>
