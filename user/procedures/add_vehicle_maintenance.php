<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$vehicles = $conn->query("SELECT vehicle_id, brand, model FROM Vehicle ORDER BY brand, model");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = $_POST["vehicle_id"];
    $cost = $_POST["cost"];
    $status = $_POST["status"];

    $sql = "CALL add_vehicle_maintenance(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $vehicle_id, $cost, $status);

    if ($stmt->execute()) {
        $results = [
            (object)[
                "status" => true,
                "body" => "Maintenance kaydı başarıyla eklendi.",
                "created_at" => date("Y-m-d H:i:s"),
                "username" => "Vehicle ID: $vehicle_id"
            ]
        ];
    } else {
        $results = [
            (object)[
                "status" => false,
                "body" => "Hata: " . $stmt->error,
                "created_at" => date("Y-m-d H:i:s"),
                "username" => "Sistem"
            ]
        ];
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Maintenance</title>
</head>
<body>
    <div style="border: 1px solid blue; padding: 10px; margin: 10px;">
        <strong>Stored Procedure: add_vehicle_maintenance (by Maya Sezgin)</strong>: 
        Takes vehicle ID, maintenance cost, and maintenance status as input. Adds a new maintenance record for the specified vehicle.
    </div>

    <form method="post" style="margin-left: 10px;">
        <label>Vehicle:</label><br>
        <select name="vehicle_id" required>
            <option value="">Select vehicle...</option>
            <?php while($vehicle = $vehicles->fetch_assoc()): ?>
                <option value="<?php echo $vehicle['vehicle_id']; ?>">
                    <?php echo $vehicle['brand'] . ' ' . $vehicle['model']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Maintenance Cost:</label><br>
        <input type="number" step="0.01" name="cost" required><br><br>

        <label>Maintenance Status:</label><br>
        <select name="status" required>
            <option value="completed">completed</option>
            <option value="in progress">in progress</option>
        </select><br><br>

        <input type="submit" value="Add Maintenance">
    </form>

    <div style="border: 1px solid black; padding: 10px; margin: 10px;">
        <h2>Results:</h2>
        <?php
        if (isset($results)) {
            foreach ($results as $document) {
                echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
                $status_str = $document->status ? "Active" : "Inactive";
                echo "<strong>Status: </strong>{$status_str}<br>";
                echo "<strong>Body: </strong>{$document->body}<br>";
                echo "<strong>Created At: </strong>{$document->created_at}<br>";
                echo "<strong>Username: </strong>{$document->username}<br>";
                echo "</div>";
            }
        } else {
            echo "No results found!<br>";
        }
        ?>
    </div>

    <a href="../index.php">Go to homepage</a>
</body>
</html>