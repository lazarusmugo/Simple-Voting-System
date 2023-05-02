<!DOCTYPE html>
<html>
<head>
	<title>Manage Candidates</title>
	<link rel="stylesheet" href="../CSS/styles.css">
	<link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
	<h1>Manage Candidates</h1>

	<?php
	// Include database connection file
	$conn =  new mysqli("localhost", "root","", "voters_db");
	if(! $conn )
	{
	 die('Could not connect: ' . mysqli_error($conn));
	}

	// Retrieve candidates from database
	$sql = "SELECT * FROM candidates";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Display candidates in a table
		echo "<table>";
		echo "<tr><th>candidate ID</th><th>Name</th><th>Position ID</th><th>number of votes</th><th>Actions</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["candidate ID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Position ID"] . "</td><td>" . $row["number of votes"] . "</td><td><a href='edit_candidate.php?id=" . $row["candidate ID"] . "'>Edit</a> | <a href='delete_candidate.php?id=" . $row["candidate ID"] . "'>Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "No candidates found.";
	}

	// Close database connection
	$conn->close();
	?>

	<br>
	<a href="add_candidate.php">Add Candidate</a>
</body>
</html>
