<?php
// Establish PDO connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "test";

// Create connection 
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
    $email = $_POST['email'];

    $Delete = "DELETE FROM student WHERE email = ?";
    $stmt = $conn->prepare($Delete);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully.";
    } else {
        echo "No records deleted. Maybe the provided email does not exist.";
    }

    $stmt->close();
    $conn->close();
}
?>
