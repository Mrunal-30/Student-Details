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

    $Select = "SELECT * FROM student WHERE email = ?";
    $stmt = $conn->prepare($Select);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output student information here
            echo "Name: " . $row['name'] . "<br>";
            echo "Gender: " . $row['gender'] . "<br>";
            echo "DOB: " . $row['dob'] . "<br>";
            echo "Address: " . $row['address'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "Number: " . $row['number'] . "<br>";
            echo "CGPA: " . $row['cgpa'] . "<br>";
        }
    } else {
        echo "No records found with the provided email.";
    }

    $stmt->close();
    $conn->close();
}
?>
