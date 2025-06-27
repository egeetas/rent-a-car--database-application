<?php
require_once('mongodb_connect.php');

$collection = $mongoClient->selectCollection("proj", "tickets");


$cursor = $collection->find(['status' => true]);
$usernames = [];
foreach ($cursor as $doc) {
    $usernames[] = $doc['username'];
}
$usernames = array_unique($usernames);

$results = [];
$selectedUser = $_GET['username'] ?? null;
if ($selectedUser) {
    $results = $collection->find([
        'status' => true,
        'username' => $selectedUser
    ]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Ticket List</title>
</head>
<body>
<h2>Select a user to view active tickets:</h2>
<form method="get">
    <select name="username">
        <option value="">-- Select Username --</option>
        <?php foreach ($usernames as $u): ?>
            <option value="<?= $u ?>" <?= ($u == $selectedUser ? 'selected' : '') ?>><?= $u ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Show Tickets">
</form>
<br>
<a href="ticket_create.php">Create New Ticket</a>
<br><br>
<div style="border: 1px solid black; padding: 10px;">
    <h3>Results:</h3>
    <?php
    if ($selectedUser) {
        $found = false;
        foreach ($results as $ticket) {
            $found = true;
            echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
            echo "<strong>Status:</strong> " . ($ticket['status'] ? 'Active' : 'Inactive') . "<br>";
            echo "<strong>Body:</strong> " . $ticket['body'] . "<br>";
            echo "<strong>Created At:</strong> " . $ticket['created_at'] . "<br>";
            echo "<a href='ticket_detail.php?id={$ticket['_id']}'>View Details</a>";
            echo "</div>";
        }
        if (!$found) echo "No active tickets for this user.";
    } else {
        echo "Please select a user from the dropdown above.";
    }
    ?>
</div>
</body>
</html>