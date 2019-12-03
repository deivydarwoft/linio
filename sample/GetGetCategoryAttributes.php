<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getCategoryAttributes
$response = LinioProducts::getCategoryAttributes(18702);
print_r($response);die;

