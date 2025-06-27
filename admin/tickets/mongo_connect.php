<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // vendor klasörü scripts içinde varsayılıyor

try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    return $mongoClient;
} catch (Exception $e) {
    die("MongoDB Connection Error: " . $e->getMessage());
}
?>