<!DOCTYPE html>
<html>
<head>
	<title>View Results</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/W3.css">
</head>
<body>
	<h1>View Results</h1>
    <?php
    // Include database connection file
    $conn = new mysqli("localhost", "root", "", "voters_db");
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    // Retrieve results from database
    $sql = "SELECT * FROM candidates  ORDER BY 'number of votes' DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display results in a table
        echo "<table>";
        echo "<tr><th>Name</th><th>Number of Votes</th><th>Position Name</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["number of votes"] . "</td><td>"  .$row["Position name"] . "</td><td>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
