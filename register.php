<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
        $file_name = $_FILES['profile_pic']['name'];
        $file_destination = 'image/' . $file_name; 
        
        if(move_uploaded_file($file_tmp_name, $file_destination)) {
            $sql = "INSERT INTO users (username, password, profile_pic) VALUES ('$username', '$hashed_password', '$file_destination')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        echo "File upload failed. Error code: " . $_FILES['profile_pic']['error'];
    }
}

$conn->close();
?>
