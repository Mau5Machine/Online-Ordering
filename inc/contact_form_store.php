<?php
// start the session
session_start();

// check for the values from the email form
$name = isset($_POST['name']) ? $_POST['name'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$comments = isset($_POST['comments']) ? $_POST['comments'] : "";

// Start the connection to the database
include 'connect.php';

$sql = "INSERT INTO contact_forms 
(`contact_id`, `contact_name`, `contact_email`, `contact_phone`, `contact_message`, `contact_created`) 
VALUES 
(NULL, :name, :email, :phone, :message, CURRENT_TIMESTAMP)";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':message', $comments, PDO::PARAM_STR);
    
    // execute
    $stmt->execute();
