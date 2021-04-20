<?php
 	include("../config.php");
?><!DOCTYPE html>
<html>
<head>
	<title>About - <?php echo $name ?></title>
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
			align-items: center;
			justify-content: center;
		}

		.body .screen .spacer {
			margin-top: 11vh;
			padding: 5vh 2.5vw;
			width: 65vw;
			background-color: rgba(255, 255, 255, .2);
		}

		.body .screen .spacer .center {
			width: 100%;
			text-align: center;
		}

		.body .screen .spacer .center h1 {
			font-size: 3vh;
			color: #fff;
			margin: 0;
			margin-bottom: 4vh;
		}

		.body .screen p {
			font-size: 1.75vh;
			color: #fff;
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
			body {
				min-height: 100vh;
				overflow: auto;
			}

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
				min-height: 100vh;
				background-image: url(<?php echo $backgroundimg ?>);
				background-size: cover;
				background-repeat: none;
				background-position: center;
				overflow-y: show !important;
			}

			.body .screen {
				min-height: 100vh;
			}

			.body .bg-video #player {
				display: none;
			}

			.body .screen .spacer {
				width: 90vw;
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
							if ($piece[0] == "About") {
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
	  			<div class="center">
		  			<h1>About</h1>
		  			<p><?php echo $about ?></p>
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
