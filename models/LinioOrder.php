<?php 
namespace models\LinioOrder;
use \Datetime;
use models\ContextusClient\ContextusClient;
/**
 * Sales order class
 */
class LinioOrder
{
    /**
    * Get the order items for a single order. Differs from GetOrders, which gets the customer details.
    * @param   String   $xOrderId  
    * @return  [Order] 
    */
	public function getOrderById($xOrderId)
    {
    	if ($xOrderId) {
			$xMethod = 'GET';
    		$xAction = 'GetOrder';
    		$xSearchBy = 'OrderId';
    		$xSearch = $xOrderId;
    		$xProduct = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
    		$xResponse[] = $xProduct->SuccessResponse->Body->Orders->Order;
        	return $xResponse;
        }
    }
    /**
    * Returns the items for one or more orders.
    * @param   array   $aOrdersIds  
    * @return  [Order] 
    */
    public function getMultipleOrderItems($aOrdersIds)
    {
        if ($xOrderId) {
            $xMethod = 'GET';
            $xAction = 'GetMultipleOrderItems';
            $xSearchBy = 'OrderIdList';
            $xSearch = $xOrderId;
            $xProduct = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
            $xResponse[] = $xProduct->SuccessResponse->Body->Orders->Order;
            return $xResponse;
        }
    }

}