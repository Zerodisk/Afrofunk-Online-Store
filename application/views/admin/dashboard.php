<html>
	<head>
		<?php echo $head;?>
	</head>
	<body>
		<div id="container">
		    <?php echo $header;?>
			<div id="content">
				<form name="" id="" method="get">
						
						<div class="dateblock">
							Last Update <?=$date_last_push?>
						</div>
						
						<div class="updateblock">
							
							<table width="98%" border="0">
							<?php foreach($brand_update_list as $brand){?>
								<tr>
									<td><a href="/store/admin/product?page=0&mid%5B%5D=100&mid%5B%5D=101&mid%5B%5D=102&status=all&brand%5B%5D=<?=rawurlencode(rawurlencode($brand['brand']))?>"><?=$brand['brand']?></a></td>
									<td align="right"><?=$brand['num_item']?></td>
								</tr>
							<?php }?>
							</table>
									
						</div>
						
						<div class="sumblock">
							<a href="http://dashboard.commissionfactory.com.au/Affiliate/Creatives/DataFeeds/ivKEs4ex1reY6M$n2eeR4pfygumdtsG3grGNp9$nm@Cq4ff4turUgslT/">
								check iconic feed
							</a><br><br>
							<table width="98%" border="0">
								<tr>
									<td><b>Items</b></td>
									<td></td>
								</tr>
								<tr>
									<td>Number of Items</td>
									<td><?=$num_items?></td>
								</tr>
								<tr>
									<td>Online Items</td>
									<td><?=$num_items_online?></td>
								</tr>
								<tr>
									<td>Offline Items</td>
									<td><?=$num_items_offline?></td>
								</tr>
								<tr>
									<td><b>Brands</b></td>
									<td></td>
								</tr>
								<tr>
									<td>Number of brands</td>
									<td><?=$num_brand?></td>
								</tr>
								<tr>
									<td>Online brands</td>
									<td><?=$num_brand_online?></td>
								</tr>
								<tr>
									<td>Offline brands</td>
									<td><?=$num_brand_offline?></td>
								</tr>
							</table>						
						
						</div>
						
						<div class="micblock">
						
						</div>
				
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>