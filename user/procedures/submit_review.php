<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


$customerQuery = "SELECT customer_id, customer_name FROM Customer ORDER BY customer_name";
$customerResult = $conn->query($customerQuery);


$selectedCustomerId = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
$vehicles = [];

if ($selectedCustomerId) {
    $vehicleQuery = "
        SELECT DISTINCT v.vehicle_id, v.brand, v.model
        FROM Vehicle v
        JOIN vehicle_has_rental vhr ON v.vehicle_id = vhr.vehicle_id
        JOIN customer_has_rental chr ON vhr.rental_id = chr.rental_id
        WHERE chr.customer_id = ?";
    
    $stmt = $conn->prepare($vehicleQuery);
    $stmt->bind_param("i", $selectedCustomerId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'])) {
    $customer_id = $_POST["customer_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $rating = $_POST["rating"];

    $sql = "CALL submit_review(?, ?, ?, @review_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $customer_id, $vehicle_id, $rating);

    if ($stmt->execute()) {
        $res = $conn->query("SELECT @review_id AS review_id");
        $row = $res->fetch_assoc();
        $review_id = $row["review_id"];

        $results = [
            (object)[
                "status" => true,
                "body" => "Review done! ID: $review_id",
                "created_at" => date("Y-m-d H:i:s"),
                "username" => "Customer ID: $customer_id"
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
    <title>Submit Review</title>
</head>
<body>
    <div style="border: 1px solid blue; padding: 10px; margin: 10px;">
        <strong>Stored Procedure: submit_review (by Fatih Özoral)</strong>: 
        Takes customer ID, vehicle ID and rating (1-5) as input. Creates a review record and links it with both the customer and vehicle.
    </div>

    <h2>Call Stored Procedure: submit_review</h2>
    <form method="post">
        <label>Customer:</label><br>
        <select name="customer_id" onchange="this.form.submit()" required>
            <option value="">Select customer...</option>
            <?php
            while($row = $customerResult->fetch_assoc()) {
                $selected = ($selectedCustomerId == $row['customer_id']) ? 'selected' : '';
                echo '<option value="' . $row["customer_id"] . '" ' . $selected . '>' . 
                     htmlspecialchars($row["customer_name"]) . '</option>';
            }
            ?>
        </select><br><br>

        <?php if ($selectedCustomerId): ?>
            <label>Vehicle:</label><br>
            <select name="vehicle_id" required>
                <option value="">Select vehicle...</option>
                <?php foreach ($vehicles as $vehicle): ?>
                    <option value="<?php echo $vehicle['vehicle_id']; ?>">
                        <?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Rating (1-5):</label><br>
            <input type="number" name="rating" min="1" max="5" required><br><br>

            <input type="submit" value="Submit Review">
        <?php endif; ?>
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