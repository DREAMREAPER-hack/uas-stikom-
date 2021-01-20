<?php
session_start();
	//initialize cart if not set or is unset
if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

	//unset qunatity
unset($_SESSION['qty_array']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SERVIS KENDARAAN</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</head>
<body>
	<!--loader -->
	<div class="bg-loader">
		<div class="loader"></div>			
	</div>

	<!--header-->
	<div class="medsos">
		<div class="container">
			<ul>
				<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				<li><a href="#"><i class="fab fa-facebook"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
			</ul>
		</div>
	</div>
	<header>
		<div class="container">
			<h1><a href="home.php">LAYANAN SERVICE</a></h1>
			<ul>
				<li><a href="home.php">HOME</a></li>
				<li class="active"><a href="layananservis.html">LAYANAN SERVIS</a></li>
				<li><a href="service.html">PANDUAN</a></li>
				<li><a href="logout.php">LOGOUT</a></li>
			</ul>
		</div>
	</header>

	<!--label-->
	<section class="label">
		<div class="container">
			<P>HOME / LAYANAN SERVIS</P>
		</div>
	</section>
    
	<br/>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Layanan Servis</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<!-- left nav here -->
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="view_cart.php"><span class="badge"><?php echo count($_SESSION['cart']); ?></span> Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add Product</button>
		<p/>
		<?php
		//info message
		if(isset($_SESSION['message'])){
			?>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-6">
					<div class="alert alert-info text-center">
						<?php echo $_SESSION['message']; ?>
					</div>
				</div>
			</div>
			<?php
			unset($_SESSION['message']);
		}


		//connection
		$conn = new mysqli('localhost', 'root', '', 'database');

		$sql = "SELECT * FROM products";
		$query = $conn->query($sql);
		$inc = 4;
		while($row = $query->fetch_assoc()){
			$inc = ($inc == 4) ? 1 : $inc + 1; 
			if($inc == 1) echo "<div class='row text-center'>";  
			?>
			<div class="col-sm-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row product_image">
							<img src="<?php echo $row['photo'] ?>" width="80%" height="auto">
						</div>
						<div class="row product_name">
							<h4><?php echo $row['name']; ?></h4>
						</div>
						<div class="row product_footer">
							<p class="pull-left"><b><?php echo $row['price']; ?></b></p>
							<span class="pull-right"><a href="add_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Cart</a></span>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		if($inc == 1) echo "<div></div><div></div><div></div></div>"; 
		if($inc == 2) echo "<div></div><div></div></div>"; 
		if($inc == 3) echo "<div></div></div>";
		
		//end product row 
		?>

	</div>

			<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="save_query.php" method="POST" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Product Name</label>
								<input class="form-control" type="text" name="name">
							</div>
							<div class="form-group">
								<label>Product Price</label>
								<input class="form-control" type="number" name="price">
							</div>
							<div class="form-group">
								<label>Product Photo</label>
								<input class="form-control" type="file" name="photo">
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>


	<!-- footer -->
	<footer>
		<div class="container">
			<small>copyright &copy; 2021 -servis kendaraan. All Rights Reserved </small>
		</div>
	</footer>

	><script type="text/javascript">
		$(document).ready(function () {
			$(".bg-loader").hide();		
		})
	</script>

</body>
</html>