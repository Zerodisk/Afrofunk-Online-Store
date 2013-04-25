<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/admin_layout.css" />
		<style type="text/css">
			.login
			{ 
				font:9pt Lucida, Verdana, sans-serif;
			}

			.error
			{
				font:9pt Lucida, Verdana, sans-serif;
				color: red
			}
		</style>
	</head>
	<body>
	<div id="container">
		<div style="margin-left:350px; margin-top:150px;">
			<form name="frm_login" action="<?=base_url().'admin/sessions/authenticate'?>" method="post">
				<table>
					<tr>
						<td class="login">user name:</td>
						<td><?=form_input('username')?></td>
					</tr>
					<tr>
						<td class="login">password:</td>
						<td><?=form_password('password') ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align: right;"><?=form_submit('mysubmit', 'Login'); ?></td>
					</tr>
				</table>
				
				<?if ($message != NULL){?> 
					<br /><div class="error"><?=$message ?></div>
				<?} ?>
			</form>
		</div>
	</div>
	</body>
</html>
<script>
	document.frm_login.username.focus();
</script>