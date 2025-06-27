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

function generateUniqueId($conn, $table, $column) {
    do {
        $id = rand(7000, 9999);
        $check = $conn->query("SELECT 1 FROM $table WHERE $column = $id");
    } while ($check && $check->num_rows > 0);
    return $id;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["case"])) {
    $vehicle_id = generateUniqueId($conn, 'proj.Vehicle', 'vehicle_id');
    $rental_id = generateUniqueId($conn, 'proj.Rental', 'rental_id');


    $conn->query("INSERT INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type)
                  VALUES ($vehicle_id, 'TR$vehicle_id', 'TestBrand', 'ModelX', 'Sedan', 'available', 100.00, 'Gas')");


    $conn->query("INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status)
                  VALUES ($rental_id, NOW(), DATE_ADD(NOW(), INTERVAL 5 DAY), 'active')");


    $stmt = $conn->prepare("INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $vehicle_id, $rental_id);

    if ($stmt->execute()) {
        $status = $conn->query("SELECT vehicle_status FROM proj.Vehicle WHERE vehicle_id = $vehicle_id")
                       ->fetch_assoc()["vehicle_status"];
        $results[] = (object)[
            "status" => true,
            "body" => "Trigger worked. Car status: $status",
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "Vehicle ID: $vehicle_id"
        ];
    } else {
        $results[] = (object)[
            "status" => false,
            "body" => "Hata: " . $stmt->error,
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "Sistem"
        ];
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trigger 2 Test: Assign Vehicle to Rental (by Fatih Özoral)</title>
</head>
<body>
    <h2>Trigger 2 Test: Assign Vehicle to Rental (by Fatih Özoral)</h2>
    <p><strong>Trigger 2:</strong> Once a vehicle is associated with a rental, its status is automatically updated to <strong>'rented'</strong>. This trigger ensures real-time synchronization of vehicle availability when a rental is created.</p>

    <form method="post">
        <button name="case" value="1">Case 1</button>
        <button name="case" value="1">Case 2</button>
        <button name="case" value="1">Case 3</button>
    </form>

    <div style="border: 1px solid black; padding: 10px; margin-top: 20px;">
        <h3>Test Results:</h3>
        <?php
        foreach ($results as $result) {
            echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
            echo "<strong>Status:</strong> " . ($result->status ? "Success" : "Failed") . "<br>";
            echo "<strong>Body:</strong> " . $result->body . "<br>";
            echo "<strong>Created At:</strong> " . $result->created_at . "<br>";
            echo "<strong>Username:</strong> " . $result->username . "<br>";
            echo "</div>";
        }
        ?>
    </div>

    <a href="../index.php">Go to homepage</a>
</body>
</html>