<?php
 	include("config.php");
?><!DOCTYPE html>
<html>
<head>
	<title>Home - <?php echo $name ?></title>
	<link rel="icon" type="image/png" href="<?php echo $logo ?>" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
	<meta name="theme-color" content="<?php echo $colorhex ?>">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:creator" content="@jekeltor" />
	<meta property="og:url" content="https://gfnrp.us" />
	<meta property="og:title" content="<?php echo $name ?>" />
	<meta property="og:description" content="<?php echo $description ?>" />
	<meta property="og:image" content="<?php echo $logo ?>" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inria+Sans&display=swap" rel="stylesheet">
	<script>
	  	window.onload = function() { 
	  		setTimeout(function(){ var loader = document.getElementById('loader');
	  		loader.classList.add("none"); }, 2000);
	  	}
	</script>
	<style>
		body {
			height: 100vh;
			width: 100%;
			overflow: hidden;
			margin: 0;
			background-color: rgb(39, 43, 48);
			font-family: 'Inria Sans', sans-serif;
		}

		.loader {
			height: 100vh;
			width: 100%;
			background-color: <?php echo $colorhex ?>;
			position: absolute;
			z-index: 10;
		}

		.loader .loading {
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			left: 0;
			z-index: 99;
		}

		.loader .loading:after {
		  	content: "";
		  	width: 8vh;
		  	height: 8vh;
		  	position: absolute;
		  	top: -30px;
		  	right: 0;
		  	left: 0;
		  	bottom: 0;
		  	margin: auto;
		  	border: 1vh solid #fff;
		  	border-top: 1vh dotted #fff;
		  	border-bottom: 1vh dotted #fff;
		  	border-radius: 50%;
		  	animation: loading 2s infinite;
		}

		.none {
			animation: .25s ease-in 0s 1 preloader;
			animation-fill-mode: forwards;
		}

		.dropdown {
			display: none;
			background-color: <?php echo $colorhex ?>;
			position: fixed;
			top: 0;
			left: 0;
			z-index: 3;
			height: 100vh;
			width: 100%;
			align-items: center;
			justify-content: center
		}

		.dropdownshow {
			display: flex;
		}

		.dropdown .center {
			text-align: center;
		}

		.dropdown .center a {
			display: block;
			font-size: 4vh;
			color: #fff;
			margin-bottom: 1vh;
			text-decoration: none;
		}

		.navbar {
			position: fixed;
			top: 0;
			left: 0;
			height: 15vh;
			width: 100%;
			background-color: rgba(255, 255, 255, .1);
			z-index: 3;
			box-shadow: 0 .01vh 1vh 0 #000;
		}

		.navbarhidden {
			background-color: rgba(255, 255, 255, 0);
			box-shadow: none;
		}

		.navbar .mleft {
			display: none;
			align-items: center;
			justify-content: flex-start;
		}

		.navbar .mleft img {
			height: 10vh;
			width: auto;
		}

		.navbarlefthidden {
			display: none !important;
		}

		.navbar .links {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 15vh;
			margin-right: 2.5vw;
		}

		.navbar .mright {
			display: none;
			align-items: center;
			justify-content: flex-end;
		}

		.navbar .mright a {
			font-size: 4vh;
			color: #fff;
			cursor: pointer;
			background-image: none !important;
		}

		.navbar a {
			color: #fff;
			font-size: 2vh;
			text-decoration: none;
			margin: 0 2%;
			background-image: linear-gradient(#fff, #fff);
			background-size: 0 .3vh, auto;
			background-repeat: no-repeat;
			background-position: center bottom;
			transition: all .2s ease-out;
			padding-bottom: .3vh;
		}

		.navbar a:hover, .navbar a.active {
			background-size: 100% .3vh, auto;
		}

		.navbar .votea {
			background-color: <?php echo $colorhex ?>;
			padding: 1.5vh 3%;
			font-size: 2.25vh;
			border-radius: 5vh;
			box-shadow: 0 .5vh 0 0 rgb(<?php echo $colordarker ?>);
			cursor: pointer;
			transition: .5s ease;
			background-image: none;
		}

		.body {
			display: flex;
			height: 100vh;
			width: 100%;
			background-size: cover;
			background-repeat: no-repeat;
			position: absolute;
			z-index: 1;
			align-items: center;
			justify-content: center;
			overflow: hidden;
			<?php if ($youtubeid == "") { ?>
			background-image: url(<?php echo $backgroundimg ?>);
			background-size: cover;
			background-repeat: no-repeat;
			<?php }?>
		}

		.body .bg-video #player {
			left: 0;
			width: 150vw;
			height: 150vh;
			z-index: 1;
		}

		.body .screen {
			display: flex;
			height: 90vh;
			width: 100%;
			position: absolute;
			z-index: 2;
			align-items: flex-end;
			justify-content: center;
			text-align: center;
		}

		.body .screen .spacer {
			display: flex;
			width: 100%;
			margin-bottom: 12.5vh;
			align-items: center;
			justify-content: center;
		}

		.body .screen .spacer .left, .body .screen .spacer .center, .body .screen .spacer .right {
			width: 33%;
		}

		.body .screen .spacer .left {
			display: flex;
			text-align: right;
			align-items: center;
			justify-content: flex-end;
			cursor: pointer;
			text-decoration: none;
		}

		.body .screen .spacer .left .l h1 {
			color: <?php echo $colorhex ?>;
			font-size: 4vh;
			margin: 0;
			margin-bottom: .5vh;
			font-weight: 900;
		}

		.body .screen .spacer .left .l p {
			font-size: 1.75vh;
			color: #fff;
			margin: 0;
		}

		.body .screen .spacer .left .r {
			font-size: 6.5vh;
			color: <?php echo $colorhex ?>;
			margin-left: 7.5%;
			margin-top: 1.5vh;
		}

		.body .screen .spacer .left .r i {
			margin: 0;
		}

		.body .screen .spacer .center img {
			display: inline-block;
			height: 40vh;
			width: auto;
		}

		.body .screen .spacer .center p {
			display: none;
			font-size: 4vh;
			color: #fff;
		}

		.body .screen .spacer .right {
			display: flex;
			text-align: left;
			align-items: center;
			justify-content: flex-start;
			cursor: pointer;
		}

		.body .screen .spacer .right .l {
			font-size: 6.5vh;
			color: <?php echo $colorhex ?>;
			margin-right: 7.5%;
			margin-top: 1.5vh;
		}

		.body .screen .spacer .right .l i {
			margin: 0;
		}

		.body .screen .spacer .right .r h1 {
			color: <?php echo $colorhex ?>;
			font-size: 4vh;
			margin: 0;
			margin-bottom: .5vh;
			font-weight: 900;
		}

		.body .screen .spacer .right .r p {
			font-size: 1.75vh;
			color: #fff;
			margin: 0;
		}

		.body .screen .spacer .right .r .hidden {
		  	position: fixed;
		  	bottom: 0;
		  	right: 0;
		  	pointer-events: none;
		  	opacity: 0;
		  	transform: scale(0);
		}

		@keyframes preloader {
			0% {
				visibility: visible;
				opacity: 1;
			}

			99% {
				visibility: hidden;
				opacity: 0;
				height: 100vh;
				width: 100%;
			}

			100% {
				height: 0vh;
				width: 0%;
				display: none;
				z-index: -5;
			}
		}

		@keyframes loading {
		  	0% {
		    	transform: rotate(0);
		  	}

		  	50% {
		    	transform: rotate(360deg);
		  	}
		}

		@media screen and (max-width: 600px), (orientation : portrait) {
			.navbar {
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.navbar .mleft {
				display: flex;
				width: 47%;
				margin-left: 3%;
			}

			.navbar .links {
				display: none;
			}

			.navbar .links .link {
				display: none;
			}

			.navbar .links .votea {
				display: none;
			}

			.navbar .mright {
				display: flex;
				width: 46%;
				margin-right: 4%;
			}

			.body {
				background-image: url(<?php echo $backgroundimg ?>);
				background-size: cover;
				background-repeat: none;
				background-position: center;
			}
			.body .bg-video #player {
				display: none;
			}

			.body .screen .spacer .left, .body .screen .spacer .right {
				display: none;
			}

			.body .screen .spacer .center {
				width: 100%;
				align-items: center;
				justify-content: center;
				text-align: center;
			}

			.body .screen .spacer .center img {
				display: inline-block;
			}

			.body .screen .spacer .center p {
				display: inline-block;
				margin: 0;
			}
		} 
	</style>
</head>
<section class="loader" id="loader">
	<div class="loading">
	</div>
</section>
<body>
	<section class="dropdown" id="dropdown">
		<div class="center">
			<?php
				foreach ($linkarray as $key => $link) {
					if ($link == "" || $link == "#") {
					}

					elseif ($link !== "" && $link !== "#" && $link !== null) {
						$piece = explode("#", $link);
						if ($key == "mainbutton") {
							echo '<a class="votea" href="'.$piece[1].'">'.$piece[0].'</a>';
						}

						elseif ($key !== "mainbutton") {
							echo '<a class="link" href="'.$piece[1].'">'.$piece[0].'</a>';
						}
					}
				}
			?>
		</div>
	</section>
	<section class="navbar" id="navbar">
		<div class="mleft">
			<img src="<?php echo $logo ?>" id="navbarleft">
		</div>
		<div class="links">
			<?php
				foreach ($linkarray as $key => $link) {
					if ($link == "" || $link == "#") {
					}

					elseif ($link !== "" && $link !== "#" && $link !== null) {
						$piece = explode("#", $link);
						if ($key == "mainbutton") {
							echo '<a class="votea" href="'.$piece[1].'">'.$piece[0].'</a>';
						}

						elseif ($key !== "mainbutton") {
							if ($piece[0] == "Home") {
								echo '<a class="active" href="'.$piece[1].'">'.$piece[0].'</a>';
							}

							elseif ($piece[0] !== basename(dirname($_SERVER[PHP_SELF]))) {
								echo '<a href="'.$piece[1].'">'.$piece[0].'</a>';
							}
						}
					}
				}
			?>
		</div>
		<div class="mright">
			<a onclick="dropDown()" id="dropdownbtn"><i class="fas fa-bars"></i></a>
		</div>
	</section>
	<section class="body">
		<div class="bg-video" id="bg-video">
			<?php if ($youtubeid == "") {
			}

			else if ($youtubeid !== "" && $youtubeid !== null) {
			?>
	  		<iframe id="player" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="640" height="360" src="https://www.youtube.com/embed/<?php echo $youtubeid ?>?autoplay=1&amp;controls=1&amp;loop=1&amp;playlist=<?php echo $youtubeid ?>&amp;enablejsapi=1&amp;origin=https%3A%2F%2Fjakehamblin.com&amp;widgetid=1&amp;modestbranding=1&amp;mute=1"></iframe>
	  		<?php } ?>
	  	</div>
	  	<div class="screen">
	  		<div class="spacer">
	  			<a class="left" href="<?php echo $discord ?>" target="_blank">
	  				<div class="l">
	  					<h1>Discord Server</h1>
	  					<p><?php echo $membersCount ?> members online</p>
	  				</div>
	  				<div class="r">
	  					<i class="fab fa-discord"></i>
	  				</div>
	  			</a>
	  			<div class="center">
	  				<img src="<?php echo $logo ?>">
	  				<p><?php echo $name ?></p>
	  			</div>
	  			<div class="right" onclick="copyText('.ip')">
	  				<div class="l">
	  					<i class="fas fa-play-circle"></i>
	  				</div>
	  				<div class="r">
	  					<h1 value="ip" class="ip"><?php echo $ip ?></h1>
	  					<p id="change">Click to copy IP</p>
	  					<input class="clipboard hidden" />
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	</section>
	<script>
		function copyText(e) {
		  	var textToCopy = document.querySelector(e);
		  	var textBox = document.querySelector(".clipboard");
		  	var changetext = document.getElementById("change");

		  	textBox.setAttribute('value', textToCopy.innerHTML);

		  	textBox.select();
		  	document.execCommand('copy');
		  	changetext.innerHTML = "IP copied";
  			setTimeout(function(){ 
  				changetext.innerHTML = "Click to copy IP";
  			}, 3000);
		}
		function dropDown() {
			var dropdown = document.getElementById("dropdown");
			var dropdownbtn = document.getElementById("dropdownbtn");
			var navbar = document.getElementById("navbar");
			var navbarleft = document.getElementById("navbarleft");

			dropdown.classList.toggle("dropdownshow");
			navbar.classList.toggle("navbarhidden");
			navbarleft.classList.toggle("navbarlefthidden");
			
			if (dropdown.classList.contains("dropdownshow")) {
				dropdownbtn.innerHTML = "<i class='fas fa-times'></i>";
			}

			else {
				dropdownbtn.innerHTML = "<i class='fas fa-bars'></i>";
			}
		}
	</script>
</body>
</html>
