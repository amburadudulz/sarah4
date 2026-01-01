<?php
header('Content-Type: application/json');

$file = __DIR__ . '/rsvp-data.json';

if (!file_exists($file)) {
  echo json_encode([]);
  exit;
}

$data = json_decode(file_get_contents($file), true) ?: [];

// ambil 1 data TERAKHIR
$last = end($data);

echo json_encode($last);
