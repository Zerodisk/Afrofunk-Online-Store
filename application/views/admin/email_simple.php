<html>
	<head>
		<?php echo $head;?>
	</head>
	<body>
		<div id="container">
		    <?php echo $header;?>
			<div id="content">
				<form method="post" action="simpleEmail_sent">
				<h2>Page for sending simple email</h2>
				<table width="90%" border="0" align="center">
					<tr>
						<td width="20%">From Name:</td>
						<td>
							<input type="text" name="fromName" size="50" value="AfroFunk Clothing">
						</td>
					</tr>
					<tr>
						<td>From Email:</td>
						<td>
							<input type="text" name="fromEmail" size="50" value="info@afrofunk.com.au">
						</td>
					</tr>
					<tr>
						<td>Subject:</td>
						<td>
							<input type="text" name="subject" size="50">
						</td>
					</tr>
					<tr>
						<td>Body:</td>
						<td>
							<textarea name="body" rows="25" cols="80"></textarea>
						</td>
					</tr>
					<tr>
						<td>Email format:</td>
						<td>
							<input type="radio" name="emailFormat" value="html" checked>html
							&nbsp;&nbsp;&nbsp;
							<input type="radio" name="emailFormat" value="text">text
						</td>
					</tr>
					<tr>
						<td>Recipients:<br>
						(list of email)
						</td>
						<td>
							<textarea name="recipient" rows="20" cols="40"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Send" style="font-size:25px; width:150px"></td>
					</tr>
				</table>
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>	