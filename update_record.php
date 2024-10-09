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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $number = $_POST['number'];
    $cgpa = $_POST['cgpa'];

    $Update = "UPDATE student SET address = ?, dob = ?, number = ?, Cgpa = ? WHERE name = ?";
    $stmt = $conn->prepare($Update);
    $stmt->bind_param("sssss", $address, $dob, $number, $cgpa, $name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record updated successfully.";
    } else {
        echo "No records updated. Maybe the provided name does not exist.";
    }

    $stmt->close();
    $conn->close();
}
?>
