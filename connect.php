<?php
// Establish PDO connection
$Name = $_POST['name'];
$Gender = $_POST['gender'];
$DOB = $_POST['dob'];
$Address = $_POST['address'];
$Email = $_POST['email'];
$Number = $_POST['number']; 
$Cgpa = $_POST['cgpa'];

if (!empty($Name) || !empty($Gender) || !empty($DOB) || !empty($Address) || !empty($Email) || !empty($Number) || !empty($Cgpa)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbname = "test";

    // Create connection 
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $Select = "SELECT email FROM student WHERE email = ? LIMIT 1";
        $INSERT = "INSERT INTO student (name, gender, dob, address, email, number, Cgpa) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare Statement for select query
        $stmt = $conn->prepare($Select);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        $stmt->close();

        if ($rnum == 0) {
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssss", $Name, $Gender, $DOB, $Address, $Email, $Number, $Cgpa);
            $stmt->execute();
            echo "Registration Successfully";
            header('location:index1.html');
            exit; // Add this line to stop further execution
        } 
        else {
            echo "Registration unsuccessfull";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
