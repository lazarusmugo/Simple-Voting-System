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
  if (isset($_POST['add_voter'])) {
    // Handle adding a new voter
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $Voted = $_POST['Voted'];

    $sql = "INSERT INTO voters (ID, name, password, Voted) VALUES ('$ID', '$name', '$password', '$Voted')";

    if ($conn->query($sql) === TRUE) {
      $success_message = "Voter added successfully!";
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
  } else if (isset($_POST['edit_voter'])) {
    // Handle editing an existing voter
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $Voted = $_POST['Voted'];

    $sql = "UPDATE voters SET ID = '$ID',name='$name', password='$password', Voted='$Voted' WHERE ID=$ID";
    if ($conn->query($sql) === TRUE) {
      $success_message = "Voter updated successfully!";
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
  } else if (isset($_POST['delete_voter'])) {
    // Handle deleting an existing voter
    $ID = $_POST['ID'];

    $sql = "DELETE FROM voters WHERE ID=$ID";
    if ($conn->query($sql) === TRUE) {
      $success_message = "Voter deleted successfully!";
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Get the list of voters from the database
$sql = "SELECT * FROM voters";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Manage Voters</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/W3.css">
</head>

<body>
  <h1>Manage Voters</h1>
  <a href="admin_dashboard.php">Back to Dashboard</a>

  <form method="POST" action="manage_voters.php">
    <h2>Add Voter</h2>
    <div>
      <label for="ID">Voter ID:</label>
      <input type="text" id="ID" name="ID" required>
    </div>
    <br>
    <br>
    <div>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
    </div>
    <br>
    <br>
    <div>
      <label for="password">password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <br>
    <br>
    <div>
      <label for="Voted">Voted:</label>
      <input type="boolean" id="Voted" name="Voted" required>
    </div>
    <br>
    <br>
    <button type="submit" name="add_voter">Add Voter</button>
  </form>

  <hr>

  <h2>Voter List</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>name</th>
      <th>password</th>
      <th>Voted</th>
    </tr>
    <?php
    // display voters from database
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['ID'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['password'] . "</td>";
      echo "<td>" . $row['Voted'] . "</td>";
      echo "<td><a href='edit_voter.php?ID=" . $row['ID'] . "'>Edit</a> | <a href='delete_voter.php?ID=" . $row['ID'] . "' onClick=\"return confirm('Are you sure you want to delete this voter?');\">Delete</a></td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>

</html>