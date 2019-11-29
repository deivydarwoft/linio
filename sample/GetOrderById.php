<?php 
require_once '../models/LinioOrder.php';
require_once '../models/ContextusClient.php';

use models\ContextusClient\ContextusClient;
use models\LinioOrder\LinioOrder;


$xResponse = LinioOrder::getOrderById(801386);
print_r($xResponse);