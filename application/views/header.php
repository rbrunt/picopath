<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Home - PicoPath</title>
	<link rel="stylesheet" href="/media/styles/main.css" type="text/css" />
	<link rel="stylesheet" href="/media/styles/nivo-slider.css" type="text/css" />
	<!--[if lte IE 8]><link rel="stylesheet" href="/media/styles/ie.css" type="text/css" /><![endif]-->
	<script src="/media/scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
	<script src="/media/scripts/jquery.nivo.slider.pack.js" type="text/javascript"></script>
	<script src="/media/scripts/blanka.js" type="text/javascript"></script>
</head>
<body>
	<div id="header">
		<div class="inner cf">
			<form method="post" action="/links/search" class="search">
				<fieldset>
					<legend>Search</legend>
					<input type="text" name="search" value="" />
					<input type="image" name="submit" src="/media/images/search/button.png" alt="Search" />
				</fieldset>
			</form>

			<div id="navigation">
				<ul>
					<li<?php if (isset($tab) && $tab == 'home') { ?> class="current-menu-item"<?php } ?>><a href="/home">home</a></li>
					<li<?php if (isset($tab) && $tab == 'account') { ?> class="current-menu-item"<?php } ?>>
						<a href="/account">account</a>
						<ul>
							<li><a href="/users/loginform/">&raquo; log in</a></li>
							<li><a href="#">&raquo; submit a link</a></li>
							<li><a href="/users/home/">&raquo; my account</a></li>
                                                        <li><a href="/users/logout/">&raquo; log out</a></li>
						</ul>
					</li>
					<li<?php if (isset($tab) && $tab == 'statistics') { ?> class="current-menu-item"<?php } ?>><a href="/statistics">stats</a></li>
					<li<?php if (isset($tab) && $tab == 'news') { ?> class="current-menu-item"<?php } ?>><a href="/news">news</a></li>
				</ul>
			</div>
		</div>
	</div>

	<hr />

	<div id="content" class="home">
		<div class="inner">