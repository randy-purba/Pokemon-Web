<?php

  require "config.php";
  require "common.php";
  
  $id = $_GET['id'];
  
  $connection = new PDO($dsn, $username, $password, $options);

	try  {
    
    $sql = "SELECT * FROM `pokemon` where id=" . $id;
    // $sql = "SELECT * FROM `pokemon` WHERE id in (SELECT pokemon_id FROM `pokemon_of_type` where type_id in (SELECT DISTINCT(weakness_of_type) FROM `weakness_of_type` WHERE weakness_of_type.type_id in (SELECT type_id FROM `pokemon_of_type` WHERE pokemon_id = " . $id. ")) and pokemon_of_type.pokemon_id != " . $id")";
		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
    foreach ($result as $row) { 
      $pokemon = $row;
    }
    
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
  }
  
  try  {
    $sql_pokemon_weakness = "SELECT * FROM `pokemon` WHERE id in (SELECT pokemon_id FROM `pokemon_of_type` where type_id in (SELECT DISTINCT(weakness_of_type) FROM `weakness_of_type` WHERE weakness_of_type.type_id in (SELECT type_id FROM `pokemon_of_type` WHERE pokemon_id = " . $id. "))) and pokemon.id != " . $id;
		$statement = $connection->prepare($sql_pokemon_weakness);
		$statement->execute();

    $result_list_counter = $statement->fetchAll();
    
	} catch(PDOException $error) {
		echo $sql_pokemon_weakness . "<br>" . $error->getMessage();
  }

  
  
  function getTypeOfPokemon($pokemon_id) {
    
    require "config.php";
    $connection = new PDO($dsn, $username, $password, $options);
    try  {
      $sql_pokemon_type = "SELECT type.name FROM `pokemon_of_type` join type on pokemon_of_type.type_id = type.id where pokemon_of_type.pokemon_id =" . $pokemon_id;
      $statement = $connection->prepare($sql_pokemon_type);
      $statement->execute();
  
      $result_type_of_pokemon = $statement->fetchAll();
      $type_of_pokemon = "";

      $numItems = count($result_type_of_pokemon);
      $i = 0;
      foreach ($result_type_of_pokemon as $row) { 
        $type_of_pokemon = $type_of_pokemon . $row["name"];
        if(++$i != $numItems) {
          $type_of_pokemon = $type_of_pokemon . ", ";
        }
      }
      return $type_of_pokemon;
      
    } catch(PDOException $error) {
      echo $sql_pokemon_weakness . "<br>" . $error->getMessage();
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
              <li class="nav-item">
                <a class="nav-link" href="add-pokemon.php">Add Pokemon</a>
              </li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>
<!--==================================
=            User Profile            =
===================================-->
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src=" <?php echo $pokemon["image"] ?>" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><b><?php echo $pokemon["name"] ?></b></h5>
						<b>Type: <?php echo getTypeOfPokemon($pokemon["id"]); ?></b>
					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li class="active">
								<a href="dashboard-my-ads.html"><i class="fa fa-user"></i> <?php echo $pokemon["name"] ?> Stats</a></li>
							<li>
								<a href=""><i class="fa fa-bookmark-o"></i>Max CP<span><?php echo $pokemon["max_cp"] ?></span></a>
							</li>
							<li>
								<a href=""><i class="fa fa-file-archive-o"></i>Attact<span><?php echo $pokemon["attact"] ?></span></a>
							</li>
							<li>
								<a href=""><i class="fa fa-bolt"></i>Defense<span><?php echo $pokemon["defense"] ?></span></a>
							</li>
							<li>
								<a href=""><i class="fa fa-bolt"></i>Stamina<span><?php echo $pokemon["stamina"] ?></span></a>
							</li>
						</ul>
					</div>

					<!-- delete-account modal -->
											  <!-- delete account popup modal start-->
                <!-- Modal -->
                <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center">
                        <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
                        <h6 class="py-2">Are you sure you want to delete your account?</h6>
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                        <textarea name="message" id="" cols="40" rows="4" class="w-100 rounded"></textarea>
                      </div>
                      <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- delete account popup modal end-->
					<!-- delete-account modal -->

				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
          <h3 class="widget-header">What counters <b> <?php echo $pokemon["name"] ?></b> ?</h3>
          <?php if(count($result_list_counter) > 0 ) { ?>
            <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Stats</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result_list_counter as $row) { ?>
                  
                  <tr>
                  <td class="product-thumb">
                    <img width="100px" height="auto" src="<?php echo $row["image"] ?>" alt="image description">
                  </td>
                  <td class="product-details">
                    <h3 class="title"><a href="detail-pokemon.php?id=<?php echo $row["id"] ?>"><?php echo $row["name"] ?></a></h3>
                    <span><strong>Max CP:</strong><?php echo $row["max_cp"] ?></span>
                    <span><strong>Attact:</strong><?php echo $row["attact"] ?></span>
                    <span><strong>Defense:</strong><?php echo $row["defense"] ?></span>
                    <span><strong>Stamina:</strong><?php echo $row["stamina"] ?></span>
                  </td>
                  <td class="product-category"><span class="categories"><b><?php echo getTypeOfPokemon($row["id"])?></b></span></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } else { ?>
            <b>No results found .</b>
          <?php } ?>
				</div>

				<!-- pagination -->
				<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item active"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<!-- pagination -->

			</div>
		</div>
		<!-- Row End -->
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