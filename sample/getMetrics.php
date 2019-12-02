<?php 
require_once '../models/LinioSeller.php';
require_once '../models/ContextusClient.php';

use models\ContextusClient\ContextusClient;
use models\LinioSeller\LinioSeller;

$xResponse = LinioSeller::getMetrics();
print_r($xResponse);