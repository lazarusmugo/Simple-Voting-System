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

// Check if ID is set and get its value
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
} else {
    $error_message = "Voter ID not specified.";
}

// Handle deleting the voter from the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM voters WHERE ID=$ID";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Voter deleted successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect back to manage_voters.php after deleting the voter
    header("Location: manage_voters.php");
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Voter</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
  <h1>Delete Voter</h1>
  <a href="admin_dashboard.php">Back to Dashboard</a>

  <?php
    // Start the session and check if the user is logged in
  
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "voters_db");
    if (!$conn) {
      die('Could not connect: ' . mysqli_error($conn));
    }

    // Handle deleting the voter
    $ID = $_GET['ID'];

    $sql = "DELETE FROM voters WHERE ID=$ID";
    if ($conn->query($sql) === TRUE) {
      $success_message = "Voter deleted successfully!";
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
  ?>

  <?php if (isset($success_message)): ?>
    <p><?php echo $success_message; ?></p>
  <?php endif; ?>

  <?php if (isset($error_message)): ?>
    <p><?php echo $error_message; ?></p>
  <?php endif; ?>
</body>
</html>
