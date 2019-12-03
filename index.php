<!DOCTYPE html>
<html>
<head>
	<title>Contextus - Linio</title>
</head>
<body>
	<h1>Integration with Linio</h1>

	<h2>1.- User Authentication</h2>
	<p>Simulating Contextus data to Linio API - SDK</p>
	<pre>
		<code>
			{
				"apiURL" : "https://sellercenter-api.linio.com.mx/",
				"apiUser" : "pruebaelapi@linio.com",
				"apiKey" : "b04291a074c06a71ee4f29e2a512a4a1ddc5a231"
			}
		</code>
	</pre>


	<h2>2.- Products (LinioProducts)</h2>
	<ul>
		<li>
			2.1.-<a href="./sample/GetBrands.php"> getBrands()</a>
			<span>Get all product brands.</span>
		</li>

		<li>
			2.2.-<a href="./sample/GetCategoryTree.php"> getCategoryTree()</a>
			<span>Get the list of all product categories.</span>
		</li>
		<li>
			2.3.-<a href="./sample/GetGetCategoryAttributes.php"> getGetCategoryAttributes()</a>
			<span>Returns a list of attributes with options for a given category. It will also display attributes for TaxClass and ShipmentType, with their possible values listed as options.</span>
		</li>
		<li>
			2.4.-<a href="./sample/GetCategoriesByAttributeSet.php"> getCategoriesByAttributeSet()</a>
			<span>.</span>
		</li>
		<li>
			2.5.-<a href="./sample/CreateProducts.php"> createProducts()</a>
			<span>Create one or multiple new products.</span>
		</li>
		<li>
			2.6.-<a href="./sample/GetProducts.php"> getProducts()</a>
			<span>Get all products.</span>
		</li>
		<li>
			2.7.-<a href="./sample/UpdateProducts.php"> updateProducts()</a>
			<span>Update the attributes of one or more existing products.</span>
		</li>
		<li>
			2.8.- <a href="./sample/RemoveProducts.php"> removeProducts()</a>
			<span>Removes one or more products.</span>
		</li>
	</ul>

	<h2>3.- Orders (LinioOrder)</h2>
	<ul>
		<li>
			3.1.- <a href="./sample/GetOrderById.php">getOrderById()</a>
			<span>Get the customer details for a range of orders. Substantially different from GetOrder, which retrieves the order items for an order.</span>
		</li>
	</ul>

	<h2> 4.- Webhooks (LinioWebhook)</h2>
	<p>You must configure this function as an ENDPOINT in order to work 
	(i.e. Codeigniter routing).</p>
	<h3>4.1.- Products events</h3>
	<h4>onProductCreated</h4>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/ProductCreated.php">LinioWebhook::productCreate()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>SellerSkus</td>
				<td>String[]</td>
				<td>List of seller skus to be used to get more details using the API.</td>
			</tr>
		</tbody>
	</table>
	<h4>onProductUpdated</h4>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/ProductUpdated.php">LinioWebhook::productUpdated()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>SellerSkus</td>
				<td>String[]</td>
				<td>List of seller skus to be used to get more details using the API.</td>
			</tr>
		</tbody>
	</table>
	<h4>Product QC Status Changed</h4>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/ProductChanged.php">LinioWebhook::productChanged()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>SellerSkus</td>
				<td>String[]</td>
				<td>List of seller skus to be used to get more details using the API.</td>
			</tr>
		</tbody>
	</table>
	<h3>4.2.- Orders events</h3>
	<h4>orderCreated</h4>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/OrderCreated.php">LinioWebhook::orderCreated()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>OrderId</td>
				<td>Int</td>
				<td>Order identifier to be used to get more details using the API.</td>
			</tr>
		</tbody>
	</table>
	<h4>onOrderItemsStatusChanged</h4>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/OrderStatusChanged.php">LinioWebhook::orderStatusChanged()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>OrderId</td>
				<td>Int</td>
				<td>Order identifier to be used to get more details using the API.</td>
			</tr>
			<tr>
				<td>OrderItemIds</td>
				<td>Int[]</td>
				<td>Order identifier to be used to get more details using the API.</td>
			</tr>
			<tr>
				<td>NewStatus</td>
				<td>String</td>
				<td>New item status.</td>
			</tr>
		</tbody>
	</table>
	<h2>5.- Seller info</h2>
	<h3>5.1.- getMetrics</h3>
	<p>Returns sales and order metric for a specified period.</p>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3"><a href="./sample/GetMetrics.php">LinioSeller::getMetrics()</a></td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>StatisticsType</td>
				<td>String</td>
				<td>Time frame of Metrics.Day = Today, Week = This Week, Month = This Month, All Time = Since Account Opened.</td>
			</tr>
			<tr>
				<td>SkuNumber</td>
				<td>Integer</td>
				<td>Number of SKUs in Seller's Catalog.</td>
			</tr>
			<tr>
				<td>SkuActive</td>
				<td>Integer</td>
				<td>Number of SKUs active in Seller's Catalog.</td>
			</tr>
			<tr>
				<td>SalesTotal</td>
				<td>Integer</td>
				<td>Local Currency Value of Sales for a particular Statistic Type.</td>
			</tr>
			<tr>
				<td>Orders</td>
				<td>Integer</td>
				<td>Total Number of Orders received for a particular Statistic Type.</td>
			</tr>
			<tr>
				<td>Commission</td>
				<td>Integer</td>
				<td>Total Amount of Commission Paid for a particular Statistic Type.</td>
			</tr>
			<tr>
				<td>ReturnsPercentage</td>
				<td>Decimal</td>
				<td>% of Orders returned for particular Statistic Type.</td>
			</tr>
			<tr>
				<td>CancellationPercentage</td>
				<td>Decimal</td>
				<td>% of Orders canceled for particular Statistic Type.</td>
			</tr>
		</tbody>
	</table>
	<h3>5.2.- getPayoutStatus</h3>
	<p>Returns sales and order metric for a specified period.</p>
	<form  method="POST" action="./sample/GetPayoutStatus.php">
		<label>Created After:</label>
		<span>Filter statements created after the provided date. Mandatory.</span>
		<input type="date" name="createdAfter" required="">
		<input type="submit" value="Filter">
	</form>
	<table border="1" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3">LinioSeller::getPayoutStatus($xCreatedAfter)</td>
			</tr>
			<tr>
				<th colspan="3">@return</th>
			</tr>
			<tr>
				<th>Field</th>
				<th>Type</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>StatementNumber</td>
				<td>String</td>
				<td>Statement Identifier.</td>
			</tr>
			<tr>
				<td>CreatedAt</td>
				<td>DateTime</td>
				<td>When the statement was created.</td>
			</tr>
			<tr>
				<td>UpdatedAt</td>
				<td>DateTime</td>
				<td>When the statement was last updated.</td>
			</tr>
			<tr>
				<td>OpeningBalance</td>
				<td>Decimal</td>
				<td>The opening balance.</td>
			</tr>
			<tr>
				<td>ItemRevenue</td>
				<td>Decimal</td>
				<td>The revenue generated by the item.</td>
			</tr>
			<tr>
				<td>ShipmentFee</td>
				<td>Decimal</td>
				<td>Cost of shipping.</td>
			</tr>
			<tr>
				<td>ShipmentFeeCredit</td>
				<td>Decimal</td>
				<td>Shipping credit, if any.</td>
			</tr>
			<tr>
				<td>OtherRevenueTotal</td>
				<td>Decimal</td>
				<td>?</td>
			</tr>
			<tr>
				<td>FeesTotal</td>
				<td>Decimal</td>
				<td>Sum of Payment Fee & Return to Seller Fee.</td>
			</tr>
			<tr>
				<td>Subtotal1</td>
				<td>Decimal</td>
				<td>(Sum of Item Revenue, Other Revenue) - Fees(Total).</td>
			</tr>
			<tr>
				<td>Refunds</td>
				<td>Decimal</td>
				<td>Sum of all refunds, if any.</td>
			</tr>
			<tr>
				<td>FeesOnRefundsTotal</td>
				<td>Decimal</td>
				<td>Accumulated fees on refunds issued.</td>
			</tr>
			<tr>
				<td>Subtotal2</td>
				<td>Decimal</td>
				<td>(Sum of Subtotal1) - Refunds.</td>
			</tr>
			<tr>
				<td>ClosingBalance</td>
				<td>Decimal</td>
				<td>Closing Balance.</td>
			</tr>
			<tr>
				<td>GuaranteeDeposit</td>
				<td>Decimal</td>
				<td>Guarantee Deposit.</td>
			</tr>
			<tr>
				<td>Payout</td>
				<td>Decimal</td>
				<td>Amount to be Paid Out to Seller for Statement.</td>
			</tr>
			<tr>
				<td>Paid</td>
				<td>Boolean</td>
				<td>Payout Status of Statement. 1 is Paid. 0 is Not Paid.</td>
			</tr>
		</tbody>
	</table>
	<h3>5.3.- getStatistics</h3>
	<p>Returns sales and orders metrics for a specified period. <a href="./sample/GetStatistics.php">LinioSeller::getStatistics()</a></p>
	<h3>5.4.- sellerUpdate</h3>
	<p>This call will update a seller email address for the seller of the user making the call.</p>
	<form  method="POST" action="./sample/SellerUpdate.php">
		<label>Email:</label>
		<input type="email" name="email" required="">
		<input type="submit" value="Update">
	</form>

	
</body>
</html>

