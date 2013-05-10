<html>
	<head>
		<?php echo $head;?>
	</head>
	<body>
		<div id="container">
		    <?php echo $header;?>
			<div id="content">
				<p>&nbsp;</p>
				<?php foreach ($categories as $category) {?>
			
				<form method="post" action="update_description">
					<input type="hidden" name="cat_id" value="<?=$category['cat_id']?>" />
					
					<b><?=$category['parent_name']?> - <?=$category['category_name']?></b><br>
					meta-description: <input type="text" name="description" value="<?=$category['description']?>" maxlength="400" size="118" />
					
					&nbsp;&nbsp;<input type="submit" value="save" />
				</form>
				<br><br>
				
				<?php }?>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>	