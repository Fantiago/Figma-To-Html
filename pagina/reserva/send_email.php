<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $to = "your-email@example.com";
    $subject = "New message from your website";
    $body = "From: $name\n Email: $email\n Message:\n $message";

    if(mail($to, $subject, $body)){
        echo "<script>alert('Message sent successfully.');</script>";
    } else {
        echo "<script>alert('Error sending message.');</script>";
    }
}
?>