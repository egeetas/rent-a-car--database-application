<?php
require_once('mongodb_connect.php');

$ticketId = $_GET['id'] ?? null;
$message = "";

if ($ticketId) {
    $collection = $mongoClient->selectCollection("proj", "tickets");
    $ticket = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($ticketId)]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commentText = $_POST['comment'] ?? '';

        if (!empty($commentText)) {
            $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($ticketId)],
                ['$push' => [
                    'comments' => [
                        'username' => $ticket['username'],
                        'comment' => $commentText,
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                ]]
            );
            $message = "Comment added.";
            header("Location: ticket_detail.php?id=$ticketId");
            exit();
        }
    }
} else {
    die("Invalid ticket ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Details</title>
</head>
<body>
<h2>Ticket Details</h2>
<a href="user_ticket_list.php">Back to Ticket List</a> |
<a href="../../user/index.php">Return to Homepage</a>
<br><br>
<p><strong>Username:</strong> <?php echo $ticket['username']; ?></p>
<p><strong>Body:</strong> <?php echo $ticket['body']; ?></p>
<p><strong>Status:</strong> <?php echo $ticket['status'] ? 'Active' : 'Inactive'; ?></p>
<p><strong>Created At:</strong> <?php echo $ticket['created_at']; ?></p>

<h3>Comments:</h3>
<?php
if (!empty($ticket['comments'])) {
    foreach ($ticket['comments'] as $comment) {
        echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
        echo "<strong>Created At:</strong> {$comment['created_at']}<br>";
        echo "<strong>Username:</strong> {$comment['username']}<br>";
        echo "<strong>Comment:</strong> {$comment['comment']}<br>";
        echo "</div>";
    }
} else {
    echo "<p>No comments yet.</p>";
}
?>

<form method="post">
    <textarea name="comment" placeholder="Add a comment" required></textarea><br>
    <input type="submit" value="Add Comment">
</form>
</body>
</html>