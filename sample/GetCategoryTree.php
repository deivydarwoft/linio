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
    if ($depth > 5) {
        return;
    }
    printf(str_repeat('    ', $depth) . $category->getName() . "\n");
    foreach ($category->getChildren() as $child) {
        printOut($child, $depth + 1);
    }
}
if ($response instanceof ErrorResponse) {
    printf("ERROR !\n");
    printf("%s\n", $response->getMessage());
} else {
    /** @var GetCategoryTree $response */
    foreach ($response->getCategories() as $cat) {
        printOut($cat, 0);
    };
}