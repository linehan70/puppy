<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$file = __DIR__ . '/puppylog_data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    $decoded = json_decode($body, true);
    if ($decoded === null) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }
    if (file_put_contents($file, json_encode($decoded, JSON_PRETTY_PRINT)) !== false) {
        echo json_encode(['ok' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Could not write file. Check folder permissions.']);
    }
} else {
    echo file_exists($file) ? file_get_contents($file) : json_encode([]);
}
