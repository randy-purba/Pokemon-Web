<?php
			
	require "config.php";
	require "common.php";

	$connection = new PDO($dsn, $username, $password, $options);

	try  {

		$sql = "SELECT * FROM `pokemon`";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}

	if (isset($_POST['submit'])) {
		try  {

			$name_pokemon = $_POST['name_pokemon'];

			if($name_pokemon) {
				$sql = "SELECT * FROM `pokemon` WHERE `name` LIKE '%" . $name_pokemon . "%'";
			} else {
				$sql = "SELECT * FROM `pokemon`";
			}

	
			$statement = $connection->prepare($sql);
			$statement->execute();
	
			$result = $statement->fetchAll();

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- SITE TITTLE -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pokémon</title>

	<!-- FAVICON -->
	<link href="img/favicon.png" rel="shortcut icon">
	<!-- PLUGINS CSS STYLE -->
	<!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-slider.css">
	<!-- Font Awesome -->
	<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Owl Carousel -->
	<link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
	<link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
	<!-- Fancy Box -->
	<link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
	<link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<!-- CUSTOM CSS -->
	<link href="css/style.css" rel="stylesheet">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-expand-lg navbar-light navigation">
						<a class="navbar-brand" href="index.html">
							<img src="images/pokemon_logo.png" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto main-nav ">
								<li class="nav-item active">
									<a class="nav-link" href="index.php">Home</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="add-pokemon.php">Add Pokemon</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="weakness-of-type.php">Set Weakness of Type</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</section>

<!--===============================
=            Hero Area            =
================================-->

	<section class="hero-area bg-1 text-center overly">
		<!-- Container Start -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Advance Search -->
					<div class="advance-search">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-12 col-md-12 align-content-center">
									<form method="post">
										<div class="form-row">
											<div class="form-group col-md-10">
												<input type="text" class="form-control my-2 my-lg-1" id="name_pokemon" name="name_pokemon"
													placeholder="What pokémon are you looking for">
											</div>
											<div class="form-group col-md-2 align-self-center">
												<button type="submit" name="submit"  class="btn btn-primary">Search Now</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container End -->
	</section>

<!--==========================================
=            All Category Section            =
===========================================-->

	<section class=" section">
		<!-- Container Start -->
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Section title -->
					<div class="section-title">
						<h2>List of Pokémon</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
					</div>
					<div class="row">
						<!-- Category list -->
						<?php foreach ($result as $row) { ?>
							<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
								<div class="category-block">
									<div class="header">
										<img width="100px" height="auto" src="<?php echo $row["image"] ?>" alt="image description">
										<h4 class="title"><a href="detail-pokemon.php?id=<?php echo $row["id"] ?>"><?php echo $row["name"] ?></a></h4>
									</div>
									<ul class="category-list">
										<li><a href="">Max CP <span><?php echo $row["max_cp"] ?></span></a></li>
										<li><a href="">Attact <span><?php echo $row["attact"] ?></span></a></li>
										<li><a href="">Defense <span><?php echo $row["defense"] ?></span></a></li>
										<li><a href="">Monitors <span><?php echo $row["stamina"] ?></span></a></li>
									</ul>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<!-- Container End -->
	</section>

<!--============================
=            Footer            =
=============================-->

	<!-- Footer Bottom -->
	<footer class="footer-bottom">
		<!-- Container Start -->
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-12">
					<!-- Copyright -->
					<div class="copyright">
						<p>Copyright ©
							<script>
								var CurrentYear = new Date().getFullYear()
								document.write(CurrentYear)
							</script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com"
								target="_blank">themefisher.com</a></p>
					</div>
				</div>
				<div class="col-sm-6 col-12">
					<!-- Social Icons -->
					<ul class="social-media-icons text-right">
						<li><a class="fa fa-facebook" href="https://www.facebook.com/themefisher" target="_blank"></a></li>
						<li><a class="fa fa-twitter" href="https://www.twitter.com/themefisher" target="_blank"></a></li>
						<li><a class="fa fa-pinterest-p" href="https://www.pinterest.com/themefisher" target="_blank"></a></li>
						<li><a class="fa fa-vimeo" href=""></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Container End -->
		<!-- To Top -->
		<div class="top-to">
			<a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
		</div>
	</footer>

	<!-- JAVASCRIPTS -->
	<script src="plugins/jQuery/jquery.min.js"></script>
	<script src="plugins/bootstrap/js/popper.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap-slider.js"></script>
	<!-- tether js -->
	<script src="plugins/tether/js/tether.min.js"></script>
	<script src="plugins/raty/jquery.raty-fa.js"></script>
	<script src="plugins/slick-carousel/slick/slick.min.js"></script>
	<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	<script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
	<script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
	<!-- google map -->
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
	<script src="plugins/google-map/gmap.js"></script>
	<script src="js/script.js"></script>

</body>

</html>