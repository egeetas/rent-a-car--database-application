<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $vehicle_id = $_POST["vehicle_id"];
    

    $start_date = date('Y-m-d H:i:s', strtotime($_POST["start_date"] . ' 00:00:00'));
    $end_date = date('Y-m-d H:i:s', strtotime($_POST["end_date"] . ' 23:59:59'));

    $sql = "CALL rent_vehicle(?, ?, ?, ?, @rental_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $customer_id, $vehicle_id, $start_date, $end_date);

    if ($stmt->execute()) {
        $res = $conn->query("SELECT @rental_id AS rental_id");
        $row = $res->fetch_assoc();
        $rental_id = $row["rental_id"];

        $results = [
            (object)[
                "status" => true,
                "body" => "Vehicle rental successful. Rental ID: " . $rental_id,
                "created_at" => date("Y-m-d H:i:s"),
                "username" => "Customer ID: " . $customer_id
            ]
        ];
    } else {
        $results = [
            (object)[
                "status" => false,
                "body" => "Error: " . $stmt->error,
                "created_at" => date("Y-m-d H:i:s"),
                "username" => "System"
            ]
        ];
    }
    $stmt->close();
}


$customerQuery = "SELECT customer_id, customer_name FROM Customer ORDER BY customer_name";
$customerResult = $conn->query($customerQuery);


$vehicleQuery = "SELECT vehicle_id, brand, model, licence_plate FROM Vehicle WHERE vehicle_status = 'available' ORDER BY brand, model";
$vehicleResult = $conn->query($vehicleQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent Vehicle</title>
</head>
<body>
    <div style="border: 1px solid blue; padding: 10px; margin: 10px;">
        <strong>Stored Procedure: rent_vehicle (by Cem Şahin)</strong>: 
        Takes customer ID, vehicle ID, rental dates as input. Creates a new rental record, links customer with vehicle, and updates vehicle status accordingly.
    </div>

    <form method="post" style="margin-left: 10px;">
        <label>Customer:</label><br>
        <select name="customer_id" required>
            <option value="">Select customer...</option>
            <?php
            while($row = $customerResult->fetch_assoc()) {
                echo '<option value="' . $row["customer_id"] . '">' . 
                     htmlspecialchars($row["customer_name"]) . '</option>';
            }
            ?>
        </select><br><br>

        <label>Vehicle:</label><br>
        <select name="vehicle_id" required>
            <option value="">Select vehicle...</option>
            <?php
            while($row = $vehicleResult->fetch_assoc()) {
                echo '<option value="' . $row["vehicle_id"] . '">' . 
                     htmlspecialchars($row["brand"] . ' ' . $row["model"]) . 
                     ' (' . htmlspecialchars($row["licence_plate"]) . ')</option>';
            }
            ?>
        </select><br><br>

        <label>Start Date:</label><br>
        <input type="date" name="start_date" required><br><br>

        <label>End Date:</label><br>
        <input type="date" name="end_date" required><br><br>

        <input type="submit" value="Rent Vehicle">
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
<?php
$conn->close();
?>