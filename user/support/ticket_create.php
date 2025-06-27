<?php
require_once('mongodb_connect.php');

$collection = $mongoClient->selectCollection("proj", "tickets");
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $body = $_POST['body'] ?? '';

    if (!empty($username) && !empty($body)) {
        $ticket = [
            'username' => $username,
            'body' => $body,
            'status' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'comments' => []
        ];
        $collection->insertOne($ticket);
        $message = "✅ Ticket created successfully.";
    } else {
        $message = "❌ Both username and message body are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Ticket</title>
</head>
<body>
<h2>Create New Support Ticket</h2>
<a href="user_ticket_list.php">Back to Ticket List</a> |
<a href="../../user/index.php">Return to Homepage</a>
<br><br>
<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Message:</label><br>
    <textarea name="body" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" value="Submit Ticket">
</form>
<br>
<div style="border: 1px solid black; padding: 10px; margin-top: 10px;">
    <?php echo $message; ?>
</div>
</body>
</html>