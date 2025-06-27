<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS306 Phase III - Web Interface</title>
</head>
<body>
    <h1>CS306 Project - Web Interface</h1>

    <h2>Triggers:</h2>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Trigger 1 (by Ege Taş):</strong> Automatically sets payment status to 'completed' if amount ≥ 600, else 'pending'.<br>
        <a href="triggers/trigger_1.php">Go to the trigger's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Trigger 2 (by Fatih Özoral):</strong> Automatically updates vehicle status to 'rented' after a rental is made.<br>
        <a href="triggers/trigger_2.php">Go to the trigger's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Trigger 3 (by Cem Şahin):</strong> Automatically sets vehicle status to 'available' if rental is cancelled.<br>
        <a href="triggers/trigger_3.php">Go to the trigger's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Trigger 4 (by Maya Sezgin):</strong> Automatically updates vehicle status after maintenance. 'completed' → available, otherwise → maintenance.<br>
        <a href="triggers/trigger_4.php">Go to the trigger's page</a>
    </div>

    <hr>

    <h2>Stored Procedures:</h2>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Stored Procedure: make_payment (by Ege Taş):</strong> Creates a payment record and links it to customer and rental with automatic status trigger.<br>
        <a href="procedures/make_payment.php">Go to the procedure's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Stored Procedure: rent_vehicle (by Cem Şahin):</strong> Handles full rental process including payment, vehicle and status management.<br>
        <a href="procedures/rent_vehicle.php">Go to the procedure's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Stored Procedure: submit_review (by Fatih Özoral):</strong> Adds user review and links it to both vehicle and rental for feedback tracking.<br>
        <a href="procedures/submit_review.php">Go to the procedure's page</a>
    </div>

    <div style="border: 1px solid blue; padding: 5px; margin-bottom: 10px;">
        <strong>Stored Procedure: add_vehicle_maintenance (by Maya Sezgin):</strong> Registers vehicle maintenance record and updates vehicle status accordingly.<br>
        <a href="procedures/add_vehicle_maintenance.php">Go to the procedure's page</a>
    </div>

    <hr>

    <h2>Support Page</h2>
    <a href="support/user_ticket_list.php">Support Page</a>

    <hr>

    <h2>Admin Panel</h2>
    <a href="../admin/index.php">Admin: All Tickets</a>

</body>
</html>