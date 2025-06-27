<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}


$customers = $conn->query("SELECT DISTINCT c.customer_id, c.customer_name 
                          FROM Customer c 
                          JOIN customer_has_rental chr ON c.customer_id = chr.customer_id 
                          ORDER BY c.customer_name");


$selectedCustomer = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
$rentals = [];
if ($selectedCustomer) {
    $stmt = $conn->prepare("SELECT r.rental_id, v.brand, v.model 
                           FROM Rental r
                           JOIN customer_has_rental chr ON r.rental_id = chr.rental_id
                           JOIN vehicle_has_rental vhr ON r.rental_id = vhr.rental_id
                           JOIN Vehicle v ON vhr.vehicle_id = v.vehicle_id
                           WHERE chr.customer_id = ?");
    $stmt->bind_param("i", $selectedCustomer);
    $stmt->execute();
    $rentals = $stmt->get_result();
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $customer_id = $_POST["customer_id"];
    $rental_id = $_POST["rental_id"];
    $amount = $_POST["amount"];
    $method = $_POST["method"];

    $sql = "CALL make_payment(?, ?, ?, ?, @payment_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iids", $customer_id, $rental_id, $amount, $method);

    if ($stmt->execute()) {
        $query = $conn->query("SELECT @payment_id AS payment_id");
        $row = $query->fetch_assoc();
        $payment_id = $row["payment_id"];

        $results[] = (object)[
            "status" => true,
            "body" => "✅ Payment successful!",
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "Payment ID: $payment_id"
        ];
    } else {
        $results[] = (object)[
            "status" => false,
            "body" => "❌ Error: " . $stmt->error,
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "System"
        ];
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stored Procedure: make_payment</title>
</head>
<body>
    <div style="border: 1px solid blue; padding: 10px; margin: 10px;">
        <strong>Stored Procedure: make_payment (by Ege Taş)</strong>: 
        Takes customer ID, rental ID, amount, and payment method as input. Based on the payment amount, it sets the payment status, inserts the payment into the system, and associates it with both the customer and rental with the output as the rental_id.
    </div>

    <form method="post" style="margin-left: 10px;">
        <label>Customer:</label><br>
        <select name="customer_id" onchange="this.form.submit()" required>
            <option value="">Select customer...</option>
            <?php while($row = $customers->fetch_assoc()): ?>
                <option value="<?php echo $row['customer_id']; ?>" <?php echo ($selectedCustomer == $row['customer_id']) ? 'selected' : ''; ?>>
                    <?php echo $row['customer_name']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <?php if ($selectedCustomer): ?>
            <label>Rental:</label><br>
            <select name="rental_id" required>
                <option value="">Select rental...</option>
                <?php while($rental = $rentals->fetch_assoc()): ?>
                    <option value="<?php echo $rental['rental_id']; ?>">
                        <?php echo $rental['brand'] . ' ' . $rental['model']; ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <label>Amount:</label><br>
            <input type="number" step="0.01" name="amount" required><br><br>

            <label>Method:</label><br>
            <input type="text" name="method" required><br><br>

            <input type="submit" name="submit" value="Submit Payment">
        <?php endif; ?>
    </form>

    <div style="border: 1px solid black; padding: 10px; margin: 10px;">
        <h2>Results:</h2>
        <?php
        if (isset($results) && count($results) > 0) {
            foreach ($results as $document) {
                echo "<div style='border: 1px solid blue; padding: 10px; margin: 5px;'>";
                $status_str = $document->status ? "Success" : "Failed";
                echo "<strong>Status: </strong>{$status_str}<br>";
                echo "<strong>Body: </strong>{$document->body}<br>";
                echo "<strong>Created At: </strong>{$document->created_at}<br>";
                echo "<strong>Username: </strong>{$document->username}<br>";
                echo "</div>";
            }
        } 
        ?>
    </div>

    <a href="../index.php">Go to homepage</a>
</body>
</html>
