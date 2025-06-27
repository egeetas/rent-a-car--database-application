<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["case"])) {
    $case = $_POST["case"];
    $cost = 100.00;
    $status = '';
    $vehicle_id = 0;

    
    if ($case == "1") {
        $vehicle_id = 8001;
        $status = 'completed';      
    } elseif ($case == "2") {
        $vehicle_id = 8002;
        $status = 'in progress';    
    } elseif ($case == "3") {
        $vehicle_id = 8003;
        $status = 'pending';        
    }


    $conn->query("INSERT IGNORE INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type)
                  VALUES ($vehicle_id, 'TEST$vehicle_id', 'Demo', 'Model-$vehicle_id', 'Sedan', 'available', 100.00, 'Gas')");


    $res = $conn->query("SELECT IFNULL(MAX(maintenance_id), 9000) + 1 AS new_id FROM proj.Maintenance");
    $maintenance_id = $res->fetch_assoc()["new_id"];


    $stmt1 = $conn->prepare("INSERT INTO proj.Maintenance (maintenance_id, maintenance_cost, maintenance_status) VALUES (?, ?, ?)");
    $stmt1->bind_param("ids", $maintenance_id, $cost, $status);
    $stmt1->execute();


    $stmt2 = $conn->prepare("INSERT INTO proj.vehicle_has_maintenance (vehicle_id, maintenance_id) VALUES (?, ?)");
    $stmt2->bind_param("ii", $vehicle_id, $maintenance_id);
    $stmt2->execute();


    $q = $conn->query("SELECT vehicle_status FROM proj.Vehicle WHERE vehicle_id = $vehicle_id");
    $vehicle_status = $q->fetch_assoc()["vehicle_status"];

    $results[] = (object)[
        "status" => true,
        "body" => "Trigger worked. New car status: <strong>$vehicle_status</strong> (Maintenance: $status)",
        "created_at" => date("Y-m-d H:i:s"),
        "username" => "Vehicle ID: $vehicle_id | Maintenance ID: $maintenance_id"
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trigger 4 - Maintenance Status Test</title>
</head>
<body>
    <div style="border: 1px solid black; padding: 10px; width: 600px;">
        <strong>Trigger 4 (by Maya Sezgin):</strong> When a maintenance record is added, the system checks the maintenance status and updates the vehicle status.<br>
        <ul>
            <li>'completed' → vehicle becomes <strong>available</strong></li>
            <li>else → vehicle becomes <strong>maintenance</strong></li>
        </ul>

        <form method="post">
            <button name="case" value="1">Case 1: completed (8001)</button>
            <button name="case" value="2">Case 2: in progress (8002)</button>
            <button name="case" value="3">Case 3: pending (8003)</button>
        </form>
    </div>

    <div style="border: 1px solid black; padding: 10px; margin-top: 20px;">
        <h2>Results:</h2>
        <?php
        if (!empty($results)) {
            foreach ($results as $document) {
                echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
                echo "<strong>Status:</strong> Success<br>";
                echo "<strong>Body:</strong> {$document->body}<br>";
                echo "<strong>Created At:</strong> {$document->created_at}<br>";
                echo "<strong>Record:</strong> {$document->username}<br>";
                echo "</div>";
            }
        } else {
            echo "No results yet.";
        }
        ?>
    </div>

    <a href="../index.php">Return to Homepage</a>
</body>
</html>