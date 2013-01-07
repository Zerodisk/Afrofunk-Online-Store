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
									<td><a href="product?page=0&status=all&brand%5B%5D=<?=rawurlencode(rawurlencode($brand['brand']))?>"><?=$brand['brand']?></a></td>
									<td align="right"><?=$brand['num_item']?></td>
								</tr>
							<?php }?>
							</table>
									
						</div>
						
						<div class="sumblock">
							<a href="http://dashboard.commissionfactory.com.au/Affiliate/Creatives/DataFeeds/ivKEs4ex1reY6M$n2eeR4pfygumdtsG3grGNp9$nm@Cq4ff4turUgslT/">
								check iconic feed
							</a><br><br>
							Number of Online Items = aa <br><br>
							Number of brands = bb <br><br>
							Online brands = cc <br><br>
							Offline brands = dd <br><br>								
						
						</div>
						
						<div class="micblock">
						
						</div>
				
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>