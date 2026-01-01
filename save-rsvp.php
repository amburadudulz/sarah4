<?php
// save-rsvp.php
header('Content-Type: application/json');

// hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['status'=>'error','msg'=>'Method not allowed']);
  exit;
}

// ambil & sanitasi
$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$attend  = trim($_POST['attend'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '') {
  http_response_code(400);
  echo json_encode(['status'=>'error','msg'=>'Nama wajib diisi']);
  exit;
}

// data baru
$new = [
  'name'    => htmlspecialchars($name, ENT_QUOTES),
  'phone'   => htmlspecialchars($phone, ENT_QUOTES),
  'attend'  => htmlspecialchars($attend, ENT_QUOTES),
  'message' => htmlspecialchars($message, ENT_QUOTES),
  'time'    => date('Y-m-d H:i:s')
];

$file = __DIR__ . '/rsvp-data.json';

// baca data lama
$data = [];
if (file_exists($file)) {
  $json = file_get_contents($file);
  $data = json_decode($json, true) ?: [];
}

// tambah data
$data[] = $new;

// simpan ulang
file_put_contents(
  $file,
  json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode(['status'=>'ok','count'=>count($data),'last'=>$new]);
