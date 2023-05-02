<!DOCTYPE html>
<html>
<head>
	<title>Manage Positions</title>
	<link rel="stylesheet" href="../CSS/styles.css">
	<link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
	<h1>Manage Positions</h1>

	<?php
	// Include database connection file
	$conn =  new mysqli("localhost", "root","", "voters_db");
	if(! $conn )
	{
	 die('Could not connect: ' . mysqli_error($conn));
	}

	// Retrieve positions from database
	$sql = "SELECT * FROM positions";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Display positions in a table
		echo "<table>";
		echo "<tr><th>Position ID</th><th>Name</th><th>Actions</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["Position ID"] . "</td><td>" . $row["Name"] . "</td><td><a href='edit_position.php?id=" . $row["Position ID"] . "'>Edit</a> | <a href='delete_position.php?id=" . $row["Position ID"] . "'>Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "No positions found.";
	}

	// Close database connection
	$conn->close();
	?>

	<br>
	<a href="add_position.php">Add Position</a>
</body>
</html>
