<?php 
require_once '../models/LinioSeller.php';
require_once '../models/ContextusClient.php';

use models\ContextusClient\ContextusClient;
use models\LinioSeller\LinioSeller;
if ($_POST['createdAfter']) {
	$xResponse = LinioSeller::getPayoutStatus($_POST['createdAfter']);
	print_r($xResponse);
}