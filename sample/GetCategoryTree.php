<?php 
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;


$response = LinioProducts::getCategoryTree();
/**
 * Recursive print
 *
 * @param Category $category
 * @param int $depth
 */
function printOut($category, $depth)
{
    // This condition will avoid to have big tree printed out
    // if ($depth > 5) {
    //     return;
    // }
    printf(str_repeat('-', $depth) . $category->getName() . "<br>");
    foreach ($category->getChildren() as $child) {
        printOut($child, $depth + 1);
    }
}

foreach ($response as $xCat) {
    printOut($xCat, 0);
}
