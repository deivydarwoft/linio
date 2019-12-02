<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getBrands
$response = LinioProducts::getBrands();
// $brand->getId()
// $brand->getGlobalIdentifier()
// $brand->getName()
foreach ($response as $brand) {
	echo "Name: ". $brand->getName();
	echo "<br>";
}
