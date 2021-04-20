<?php
 	include("../config.php");
 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once "recaptchalib.php";
		$secret = $recaptchasecretkey;
		 
		$response = null;
		 
		$reCaptcha = new ReCaptcha($secret);

		if ($_POST["g-recaptcha-response"]) {
		    $response = $reCaptcha->verifyResponse(
		        $_SERVER["REMOTE_ADDR"],
		        $_POST["g-recaptcha-response"]
		    );
		}

		extract($_POST);

		if ($response != null && $response->success) {
	 		$namep = $_POST["name"];
	 		$email = $_POST["email"];
	 		$discord = $_POST["discord"];
	 		$age = $_POST["age"];
	 		$timezone = $_POST["timezone"];
	 		$department = $_POST["department"];

	 		if ($name == "" or null || $email == "" or null || $discord == "" or null || $age == "" or null || $timezone == "" or null || $department == "" or null) {
	 		}

	 		elseif ($name !== "" or null || $email !== "" or null || $discord !== "" or null || $age !== "" or null || $timezone !== "" or null || $department !== "" or null) {
				$timestamp = date("c", strtotime("now"));

				$json_data = json_encode([
				    // Text-to-speech
				    "tts" => false,

				    // Embeds Array
				    "embeds" => [
				        [
				            "title" => "New Application",
				            "type" => "rich",
				            "timestamp" => $timestamp,
				            "color" => hexdec(str_replace("#", "", $colorhex)),

				            "footer" => [
				                "text" => $name,
				                "icon_url" => $logo
				            ],

				            "author" => [
				                "name" => $namep,
				            ],

				            "fields" => [
				                [
				                    "name" => "Name",
				                    "value" => $namep,
				                    "inline" => true
				                ],
				                [
				                    "name" => "Email",
				                    "value" => $email,
				                    "inline" => true
				                ],
				                [
				                    "name" => "Discord",
				                    "value" => $discord,
				                    "inline" => true
				                ],
				                [
				                    "name" => "Age",
				                    "value" => $age,
				                    "inline" => true
				                ],
				                [
				                    "name" => "Timezone",
				                    "value" => $timezone,
				                    "inline" => true
				                ],
				                [
				                    "name" => "Department",
				                    "value" => $department,
				                    "inline" => true
				                ]
				            ]
				        ]
				    ]

				], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


				$ch = curl_init( $webhookurl );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt( $ch, CURLOPT_HEADER, 0);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
				curl_close( $ch );

				header('Location: ../redirect.php');
	 		}
	 	}

	 	else {
	 	}
 	}
?><!DOCTYPE html>
<html>
<head>
	<title>Application - <?php echo $name ?></title>
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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

		.body .screen .spacer .center form {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
		}

		.body .screen .spacer .center form input, .body .screen .spacer .center form select {
			-webkit-appearance: none;
			flex-basis: calc(50% - 3%);
			margin-left: 1.5%;
			margin-right: 1.5%;
			box-sizing: border-box;
			margin-bottom: 2vh;
			padding: .5vh .25%;
			outline: none;
			font-size: 1.75vh;
			border: .05vh solid #b5b5b5;
			border-radius: .5vh;
		}

		.body .screen .spacer .center form .bottom {
			text-align: center;
		}

		.body .screen .spacer .center form input[type=submit] {
			display: inline-block;
			margin-top: 2.5vh;
			flex-basis: auto;
			width: auto;
			padding: 1vh 5%;
			background-color: <?php echo $colorhex ?>;
			outline: none;
			border: none;
			color: #fff;
			cursor: pointer;
		}

		.body .screen .spacer .center form .g-recaptcha {
			display: block;
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
							if ($piece[0] == "Application") {
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
		  			<h1>Application</h1>
		  			<form method="POST">
		  				<input type="text" name="name" placeholder="Name">
		  				<input type="email" name="email" placeholder="Email">
		  				<input type="text" name="discord" placeholder="Discord">
		  				<input type="number" name="age" placeholder="Age">
		  				<input type="type" name="timezone" placeholder="Timezone"> 
		  				<select name="department">
		  					<option selected disabled>Select One</option>
		  					<?php 
			  					foreach ($departments as &$department) {
							?>
								<option value="<?php echo $department ?>"><?php echo $department ?></option>
							<?php }?>
		  				</select>
		  				<div class="bottom">
			  				<input type="submit" value="Submit">
			  				<div class="g-recaptcha" data-sitekey="<?php echo $recaptchasitekey ?>"></div>
			  			</div>
		  			</form>
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
