<!DOCTYPE html>
<html>
<head>
	<title>Edit Candidate</title>
	<link rel="stylesheet" href="../CSS/styles.css">
	<link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
	<h1>Edit Candidate</h1>

	<?php
	// Include database connection file
	$conn = new mysqli("localhost", "root", "", "voters_db");
	if (!$conn) {
		die('Could not connect: ' . mysqli_error($conn));
	}

	// Get candidate ID from URL parameter
	$candidate_id = $_GET["id"];

	// Retrieve candidate from database
	$sql = "SELECT * FROM candidates WHERE `candidate ID` = $candidate_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		// Display candidate information in a form
		echo "<form method='post' action='save_candidate.php'>";
		echo "<input type='hidden' name='candidate_id' value='" . $row["candidate ID"] . "'>";
		echo "Name: <input type='text' name='name' value='" . $row["Name"] . "'><br>";
		echo "Position ID: <input type='text' name='Position_id' value='" . $row["Position ID"] . "'><br>";
		echo "<input type='submit' value='Save'>";
		echo "</form>";
	} else {
		echo "Candidate not found.";
	}

	
	$conn->close();
	?>
</body>
</html>
