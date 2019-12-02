<?php 
require_once '../models/LinioSeller.php';
require_once '../models/ContextusClient.php';

use models\ContextusClient\ContextusClient;
use models\LinioSeller\LinioSeller;
if ($_POST['email']) {
	$xResponse = LinioSeller::sellerUpdate($_POST['email']);
	print_r($xResponse);
}