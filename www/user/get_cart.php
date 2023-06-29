<?php

require_once '../lib/lib.php';

$count = Product::getCartItemCount($_GET['uid']);

header('Content-Type: application/json');
echo json_encode(['count' => $count]);
