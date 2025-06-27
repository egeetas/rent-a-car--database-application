<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proj';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["case"])) {
    $case = $_POST["case"];
    $amount = 0;

    if ($case == "1") {
        $amount = 500; 
    } elseif ($case == "2") {
        $amount = 600; 
    } elseif ($case == "3") {
        $amount = 750; 
    }

    $method = "credit card";

    $res = $conn->query("SELECT IFNULL(MAX(payment_id), 2000) + 1 AS new_id FROM proj.Payment");
    $new_id = $res->fetch_assoc()["new_id"];

    $sql = "INSERT INTO proj.Payment (payment_id, payment_amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $new_id, $amount, $method);

    if ($stmt->execute()) {
        $res = $conn->query("SELECT payment_status FROM proj.Payment WHERE payment_id = $new_id");
        $status = $res->fetch_assoc()["payment_status"];

        $results[] = (object)[
            "status" => $status === "completed",
            "body" => "Trigger executed. Payment status: <strong>$status</strong>",
            "created_at" => date("Y-m-d H:i:s"),
            "username" => "Inserted Payment ID: $new_id"
        ];
    } else {
        $results[] = (object)[
            "status" => false,
            "body" => "Error: " . $stmt->error,
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
    <title>Trigger 1 Test</title>
</head>
<body>
    <div style="border: 1px solid black; padding: 10px; width: 500px;">
        <strong>Trigger 1 (by Ege Taş):</strong>
        Automatically sets payment status to 'completed' if amount ≥ 600, else 'pending'.
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
        } 
        ?>
    </div>

    <br>
    <a href="../index.php">Go to homepage</a>
</body>
</html>