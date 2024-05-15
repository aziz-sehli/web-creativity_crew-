<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';

$messageClass = '';
if ($status === 'success') {
    $messageClass = 'success';
    $message = 'Email sent successfully!';
} elseif ($status === 'error') {
    $messageClass = 'error';
    $message = 'Failed to send email: ' . htmlspecialchars($message);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Send Email</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('../View/man-working-bored.avif');
    background-size: cover;
    background-position: center;
        
    }
    
    .container {
        max-width: 500px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #333333;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        color: #555555;
        margin-bottom: 5px;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
        width: calc(100% - 24px);
        padding: 12px;
        border: 1px solid #dddddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .form-group textarea {
        height: 150px;
        resize: none;
    }
    .btn {
        display: block;
        width: 100%;
        padding: 12px;
        border: none;
        background-color: #007bff;
        color: #ffffff;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    .message {
        padding: 12px;
        margin-top: 20px;
        border-radius: 5px;
        font-size: 16px;
    }
    .message.success {
        background-color: #28a745;
        color: #ffffff;
    }
    .message.error {
        background-color: #dc3545;
        color: #ffffff;
    }
</style>
</head>
<body style="background-image: url('../View/man-working-bored.avif'); background-size: cover; background-position: center;">
<div class="container">
    <h2>Send Email</h2>
    <form method="post" action="mail.php">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn" name="send">Send</button>
    </form>
    <div class="message <?php echo $messageClass; ?>">
        <?php echo $message; ?>
    </div>
</div>
</body>
</html>
