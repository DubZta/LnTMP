<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "attendance_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Failed Connection: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['bio'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bio = $_POST['bio'];

        $sql = "INSERT INTO user (firstName, lastName, email, password, bio) VALUES ('$firstName', '$lastName', '$email', '$password', '$bio')";

        if ($conn->query($sql) === TRUE) {
            echo "Account Successfully Added";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Wrong Password!";
            }
        } else {
            echo "Wrong Username!";
        }
    }
}
$conn->close();
?>