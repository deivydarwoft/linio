<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getCategoryAttributes
$response = LinioProducts::getGetCategoriesByAttributeSet(12);
print_r($response);die;

