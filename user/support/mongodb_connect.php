<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $db = $mongoClient->proj;
    $collection = $db->tickets; 
} catch (Exception $e) {
    die("MongoDB Connection Error: " . $e->getMessage());
}
?>