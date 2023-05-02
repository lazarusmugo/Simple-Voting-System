<!DOCTYPE html>
<html>
<head>
	<title>Edit Position</title>
	<link rel="stylesheet" href="../CSS/styles.css">
	<link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
	<h1>Edit Position</h1>

	<?php
	// Include database connection file
	$conn =  new mysqli("localhost", "root","", "voters_db");
	if(! $conn )
	{
	 die('Could not connect: ' . mysqli_error($conn));
	}

	// Retrieve position from database
	$sql = "SELECT * FROM positions WHERE `Position ID` = " . $_GET["id"];
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
	} else {
		echo "Position not found.";
		exit;
	}

	// Close database connection
	$conn->close();
	?>

	<form method="post" action="save_position.php">
		<input type="hidden" name="id" value="<?php echo $row["Position ID"]; ?>">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" value="<?php echo $row["Name"]; ?>">
		<br><br>
		<input type="submit" value="Save">
	</form>

	<br>
	<a href="manage_positions.php">Back to Manage Positions</a>
</body>
</html>
