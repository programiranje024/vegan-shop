<?php

require_once '../lib/lib.php';

Product::clearCart($_GET['uid']);

header('Content-Type: application/json');
echo json_encode(['success' => true]);
