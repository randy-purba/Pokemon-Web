<?php

    require "config.php";
    require "common.php";
    $connection = new PDO($dsn, $username, $password, $options);

    try  {
        $sql_get_type_of_pokemon = "SELECT * FROM `type`";
        $statement = $connection->prepare($sql_get_type_of_pokemon);
        $statement->execute();

        $result_pokemon_type = $statement->fetchAll();
        
    } catch(PDOException $error) {
        echo $sql_get_type_of_pokemon . "<br>" . $error->getMessage();
    }

    if(isset($_POST['submit'])){
        
        if($_POST['type']) {
            $temp_type = $_POST['type'];
            if(!empty($_POST['weakness_of_type'])){
                foreach($_POST['weakness_of_type'] as $selected){
                    saveWeaknessOfType($temp_type, $selected);
                }
                header('Location: http://localhost/pokemon_web/');
            }
        }
    }    

    function saveWeaknessOfType($id_type, $id_weakness_of_type) {
        try  {
            $sql_save_weakness_of_type = "INSERT INTO `weakness_of_type`(`type_id`, `weakness_of_type`) VALUES (" . $id_type  . "," .  $id_weakness_of_type . ")";
            $statement = $GLOBALS['connection']->prepare($sql_save_weakness_of_type);
            $statement->execute();
        } catch(PDOException $error) {
            echo $sql_save_weakness_of_type . "<br>" . $error->getMessage();
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
						<a class="navbar-brand" href="index.php">
							<img src="images/pokemon_logo.png" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto main-nav ">
                            <li class="nav-item">
									<a class="nav-link" href="index.php">Home</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="add-pokemon.php">Add Pokemon</a>
								</li>
								<li class="nav-item active">
									<a class="nav-link" href="weakness-of-type.php">Set Weakness of Type</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</section>

<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Add New Pokémon</h3>
                    <form method="post">
                        <fieldset class="p-4">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    Type
                                </div>
                                <div class="form-group col-md-10">
                                    <select name="type">
                                        <?php foreach ($result_pokemon_type as $row) { ?>
                                            <option value="<?php echo $row["id"]?>"> <?php echo $row["name"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                   Weakness of Type
                                </div>
                                <div class="form-group col-md-10">
                                    <?php foreach ($result_pokemon_type as $row) { ?>
                                        <input type="checkbox" name="weakness_of_type[]" value="<?php echo $row["id"]?>"> <?php echo $row["name"]?><br>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" name="submit"  class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
          <p>Copyright © <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com" target="_blank">themefisher.com</a></p>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>
<script src="js/script.js"></script>

</body>

</html>