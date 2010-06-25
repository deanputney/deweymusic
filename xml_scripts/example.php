<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<html>
	<head>
		<title>All About Dean Putney</title>
		<link rel="stylesheet" type="text/css" href="css/helvetica.css">
		<script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function (){
				$(".header_icon").hover(
					function (){
						$(".icon_contents", this).toggle();
					},
					function (){
						$(".icon_contents", this).toggle();
					}
				);
			});
		</script>
		<?php
			include('xmlfunctions.php');
		?>
	</head>
	<body>
		<div id="head">
			Welcome to the virtual home of
		</div>
		<div id="index_home">
			<table width="100%" cellpadding="0px" cellspacing="0px" height="50px">
				<tr>
					<td valign="top" style="margin-top:0;">
						<h1 class="name">Dean Putney</h1>
					</td>
					<td align="center" valign="top" width="55px" class="header_icon" height="60px">
						<span class="icon_contents">
							<img src="../icons/classy/png/48x48/image_jpg.png" alt="" />
						</span>
						<span class="icon_contents" style="display:none">
							<img src="../icons/classy/png/32x32/image_jpg.png" alt="" />
							Photos
						</span>
					</td>
					<td align="center" valign="top" width="55px" class="header_icon">
						<span class="icon_contents">
							<img src="../icons/classy/png/48x48/application.png" alt="" />
						</span>
						<span class="icon_contents" style="display:none">
							<img src="../icons/classy/png/32x32/application.png" alt="" />
							Web
						</span>
					</td>
					<td align="center" valign="top" width="55px" class="header_icon">
						<span class="icon_contents">
							<img src="../icons/classy/png/48x48/page.png" alt="" />
						</span>
						<span class="icon_contents" style="display:none">
							<img src="../icons/classy/png/32x32/page.png" alt="" />
							Resume
						</span>
					</td>
					<td align="center" valign="top" width="55px" class="header_icon">
						<span class="icon_contents">
							<img src="../icons/simplistica/png/48x48/calendar_date.png" alt="" />
						</span>
						<span class="icon_contents" style="display:none">
							<img src="../icons/simplistica/png/32x32/calendar_date.png" alt="" />
							Calendar
						</span>
					</td>
					<td align="center" valign="top" width="55px" class="header_icon">
						<span class="icon_contents">
							<img src="../icons/simplistica/png/48x48/mail.png" alt="" />
						</span>
						<span class="icon_contents" style="display:none">
							<img src="../icons/simplistica/png/32x32/mail.png" alt="" />
							Contact
						</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="15px"></td>
				</tr>
			</table>
			<div id="twitter">
				<img class="entry_icon" src="../icons/socialize/png/32x32/twitter.png" alt="" />
				<?php
					include('tweets.php');
				?>
			</div>
			<div id="lastfm">
				<?php
					include('lastfm.php');
				?>
			</div>
			<div id="googlereader">
				<?php
					//include('googlereader.php');
				?>
			</div>
			<div id="delicious">
				<?php
					include('delicious.php');
				?>
			</div>
			<div id="flickr">
				<?php
					include('flickr.php');
				?>
			</div>
		</div>
	</body>
</html>