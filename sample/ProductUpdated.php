<?php 
require_once '../models/LinioWebhook.php';
require_once '../models/ContextusClient.php';

use models\ContextusClient\ContextusClient;
use models\LinioWebhook\LinioWebhook;

$xResponse = LinioWebhook::productUpdated();
print_r($xResponse);