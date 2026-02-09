<?php
// Headers taaki browser error na de
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// File jaha data save hoga
$file = 'database.txt';

// Agar file nahi hai to create karo
if (!file_exists($file)) {
    file_put_contents($file, '[]');
}

$method = $_SERVER['REQUEST_METHOD'];

// DATA LOAD KARNA (GET)
if ($method === 'GET') {
    $content = file_get_contents($file);
    // Agar khali hai to empty array bhejo
    echo empty($content) ? '[]' : $content;
} 

// DATA SAVE KARNA (POST)
elseif ($method === 'POST') {
    $input = file_get_contents('php://input');
    if (!empty($input)) {
        if(file_put_contents($file, $input)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Write permission denied"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}
?>