<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["case"])) {
    $case = $_POST["case"];
    $rental_id = 0;

    if ($case == "1") {
        $rental_id = 6442; 
    } elseif ($case == "2") {
        $rental_id = 1037; 
    } elseif ($case == "3") {
        $rental_id = 1056;
    }

    $updateSql = "UPDATE proj.Rental SET rental_status = 'cancelled' WHERE rental_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("i", $rental_id);

    if ($stmt->execute()) {
        $query = "SELECT v.vehicle_id, v.vehicle_status
                  FROM proj.Vehicle v
                  JOIN proj.vehicle_has_rental vhr ON v.vehicle_id = vhr.vehicle_id
                  WHERE vhr.rental_id = $rental_id";

        $res = $conn->query($query);
        $row = $res->fetch_assoc();

        $results[] = (object)[
            "status" => true,
            "body" => "Trigger worked. Car status: <strong>{$row['vehicle_status']}</strong>",
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "Rental ID: $rental_id | Vehicle ID: {$row['vehicle_id']}"
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trigger 3 Test</title>
</head>
<body>
<div style="border: 1px solid black; padding: 10px; width: 600px;">
    <strong>Trigger 3 (by Cem Şahin):</strong>
    Automatically sets vehicle status to 'available' if rental is cancelled.
    <form method="post">
        <button name="case" value="1">Case 1</button>
        <button name="case" value="2">Case 2</button>
        <button name="case" value="3">Case 3</button>
    </form>
</div>

<div style="border: 1px solid black; padding: 10px; margin-top: 20px;">
    <h2>Results:</h2>
    <?php
    if (!empty($results)) {
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
        echo "No results yet. Please click a Case button.";
    }
    ?>
</div>

<br>
<a href="../index.php">Go to homepage</a>
</body>
</html>