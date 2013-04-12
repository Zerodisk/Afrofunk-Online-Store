<?php  echo '<?xml version="1.0" encoding="utf-8"?>'; ?> 
<rss version="2.0">
    <channel>
        <title>Afrofunk Clothing Feed</title>
        <link>http://www.afrofunk.com.au</link>
        <description>This is the afrofunk products update - RSS feed</description>
        <image>
			<url>http://www.afrofunk.com.au/store/images/afrologo.png</url>
			<title>Afrofunk Clothing</title>
			<link>http://www.afrofunk.com.au</link>
		</image>
        <language>en-us</language>
        <copyright>Copyright (C) 2013 afrofunk.com.au</copyright>
        
        <?php foreach($products as $product){?>
        <item>
            <title><![CDATA[<?=$product['product_name']?>]]></title>
            <description>
              <![CDATA[  
            	<p class="image-container" style="text-align: center;"> 
            		<a href="http://www.afrofunk.com.au/store/product/view/<?=$product['sku']?>">
            			<img src="<?=$product['image_url']?>" width="300" border="0" />
            		</a>
            	</p>
            	<p>
            		<?=$product['description']?>
            	</p>                       
              ]]>
            </description>
            <link>http://www.afrofunk.com.au/store/product/view/<?=$product['sku']?></link>
            <category><?=str_replace('&', '&amp;', $product['category_name'])?></category>
            <category><?=str_replace('&', '&amp;', $product['brand'])?></category>
            <pubDate><?=date("D, d M Y H:i:s O", strtotime($product['date_first_online']))?></pubDate>
        </item>
        <?php }?>

    </channel>
</rss>