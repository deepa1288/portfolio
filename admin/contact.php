<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Database connection
    include('../include/config.php');

    $sql = "INSERT INTO contact (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('Failed to save message. Please try again.'); window.location.href='../index.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
