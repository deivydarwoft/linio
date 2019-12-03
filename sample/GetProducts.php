<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getProducts
$response = LinioProducts::getProducts();

foreach ($response as $product) {
	echo "Name: ".$product->getName().
	"<br>SellerSku: ".$product->getSellerSku().
	"<br>Price: ".$product->getPrice().
	"<br>PrimaryCategory: ".$product->getPrimaryCategory().
	"<br>Categories: ".$product->getCategories();
	echo "<br>-------------------------<br>";
}