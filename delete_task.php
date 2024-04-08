<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['username']) && isset($_GET["id"])) {
    $username = $_SESSION['username'];
    $id = $_GET["id"];

    $sql = "DELETE FROM tasks WHERE id=$id AND username='$username'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
