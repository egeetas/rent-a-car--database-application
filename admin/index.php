<?php
$mongoClient = require_once __DIR__ . '/tickets/mongo_connect.php';

$collection = $mongoClient->selectCollection("proj", "tickets");
$activeTickets = $collection->find(['status' => true]);
$closedTickets = $collection->find(['status' => false]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Ticket Management</title>
    <style>
        .ticket-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .ticket-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .ticket-card:hover {
            background-color: #f0f0f0;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .status-active {
            background-color: #28a745;
            color: white;
        }
        .status-closed {
            background-color: #dc3545;
            color: white;
        }
        .view-details {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
        }
        .view-details:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Ticket Management System (Admin View)</h2>
    <a href="../user/index.php">Return to Homepage</a>
    
    <div class="ticket-section">
        <h3>Active Tickets</h3>
        <?php
        $foundActive = false;
        foreach ($activeTickets as $ticket) {
            $foundActive = true;
            echo "<div class='ticket-card'>";
            echo "<span class='status-badge status-active'>Active</span><br>";
            echo "<strong>Username:</strong> " . $ticket['username'] . "<br>";
            echo "<strong>Created At:</strong> " . $ticket['created_at'] . "<br>";
            echo "<strong>Message:</strong> " . $ticket['body'] . "<br>";
            echo "<a href='tickets/ticket_detail.php?id={$ticket['_id']}' class='view-details'>View Details</a>";
            echo "</div>";
        }
        if (!$foundActive) echo "<p>No active tickets found.</p>";
        ?>
    </div>

    <div class="ticket-section">
        <h3>Closed Tickets</h3>
        <?php
        $foundClosed = false;
        foreach ($closedTickets as $ticket) {
            $foundClosed = true;
            echo "<div class='ticket-card'>";
            echo "<span class='status-badge status-closed'>Closed</span><br>";
            echo "<strong>Username:</strong> " . $ticket['username'] . "<br>";
            echo "<strong>Created At:</strong> " . $ticket['created_at'] . "<br>";
            echo "<strong>Message:</strong> " . $ticket['body'] . "<br>";
            echo "<a href='tickets/ticket_detail.php?id={$ticket['_id']}' class='view-details'>View Details</a>";
            echo "</div>";
        }
        if (!$foundClosed) echo "<p>No closed tickets found.</p>";
        ?>
    </div>
</body>
</html>