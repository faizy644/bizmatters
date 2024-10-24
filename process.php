<?php
// Start the session
session_start();

// Initialize variables
$firstName = $lastName = $email = $message = "";
$errors = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate first name
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    
    // Validate last name
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }

    // Validate message
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    // Check if there are no errors
    if (empty($errors)) {
        // Here you can process the valid data (e.g., send an email, save to database)
        // Example: Sending an email
        $to = "sqa.644@gmail.com"; // Replace with your email
        $subject = "New Contact Form Submission";
        $body = "Name: $firstName $lastName\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $_SESSION['success'] = "Thank you for your message! It has been sent.";
            header("Location: thank_you.php"); // Redirect to a thank you page
            exit;
        } else {
            $errors[] = "There was a problem sending your message. Please try again.";
        }
    }
}
?>
