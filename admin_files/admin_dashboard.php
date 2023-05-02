<?php
session_start(); // start the session
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/W3.css">
</head>

<body>
  <h1>Welcome To The Admin Dashboard</h1>
  <form>
    <ul>
      <li><a href="manage_voters.php">Manage Voters</a></li>
      <li><a href="manage_positions.php">Manage Positions</a></li>
      <li><a href="manage_candidates.php">Manage Candidates</a></li>
      <li><a href="view_results.php">View Results</a></li>
    </ul>
  </form>
</body>

</html>