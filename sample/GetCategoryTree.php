<?php 
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;


$response = LinioProducts::getCategoryTree();

print_r($response);
