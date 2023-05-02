<?php
include("connection.php");

// Check if the user is logged in and hasn't voted yet
session_start();
if (!isset($_SESSION['ID']) || $_SESSION['voted'] == 1) {
    header("Location: index.php");
    exit();
}

// Fetch the voter's information from the database
$voter_id = $_SESSION['ID'];
$sql = "SELECT * FROM voters WHERE ID='$voter_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="CSS/W3.css">
    <title>Home Page</title>
</head>

<body>
    <h3>Welcome <?php echo $row['name']; ?>!</h3>
    <p>Please select your preferred candidate for each position:</p>

    <form action="vote.php" method="post" >

        <?php
        $sql = "SELECT * FROM positions";
        $result = mysqli_query($conn, $sql);

        // Loop through each position
        while ($row = mysqli_fetch_assoc($result)) {
            $position_id = $row['Position ID'];
            $position_name = $row['Name'];

            echo "<h4>" . $position_name . "</h4>";

            // Get the candidates for this position
            $sql2 = "SELECT * FROM candidates WHERE `position ID`='$position_id'";
            $result2 = mysqli_query($conn, $sql2);

            // Loop through each candidate
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $candidate_id = $row2['candidate ID'];
                $candidate_name = $row2['Name'];

                // Display radio buttons for each candidate
                echo "<input type='radio' name='position-$position_id' value='$candidate_id' required> $candidate_name<br>";
            }

            echo "<br>";
        }
        ?>

        <input type="hidden" name="voter_id" value="<?php echo $voter_id; ?>">
        <input type="submit" name="submit_vote" value="Submit Vote">

    </form>
</body>

</html>