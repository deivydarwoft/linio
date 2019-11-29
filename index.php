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
		<li><a href="./sample/GetBrands.php">getBrands()</a></li>
		<li><a href="./sample/GetCategoryTree.php">getCategoryTree()</a></li>
		<li><a href="./sample/CreateProducts.php">createProducts()</a></li>
		<li><a href="./sample/UpdateProducts.php">updateProducts()</a></li>
	</ul>

	<h2>2.- Orders (LinioOrder)</h2>
	<ul>
		<li><a href="./sample/GetOrderById.php">getOrderById()</a></li>
	</ul>

	<h2> 3.- Webhooks (LinioWebhook)</h2>
	<p>You must configure this function as an ENDPOINT in order to work 
	(i.e. Codeigniter routing).</p>
	<h3>- Products events</h3>
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
	<h3>- Orders events</h3>
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
				<td colspan="3">LinioWebhook::orderStatusChanged()</td>
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
	<h2>4.- Seller info</h2>
	<h3>- getMetrics</h3>
	<p>Returns sales and order metric for a specified period.</p>
	<h3>- getPayoutStatus</h3>
	<p>Returns sales and order metric for a specified period.</p>
	<h3>- getStatistics</h3>
	<p>Returns sales and orders metrics for a specified period.</p>
	<h3>- sellerUpdate</h3>
	<p>This call will update a seller email address for the seller of the user making the call.</p>

	
</body>
</html>

