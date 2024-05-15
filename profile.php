<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

if (
  isset($_POST["nom"]) &&
  isset($_POST["prenom"]) &&
  isset($_POST["email"]) &&
  isset($_POST["phone"]) &&
  isset($_POST["pass"]) 
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST["prenom"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["phone"]) &&
    !empty($_POST["pass"]) 
  ) {
    $newEmail = $_POST['email'];

	
        $etudiant = new Utilisateur(
          $_SESSION["id"],
          $_POST['nom'],
          $_POST['prenom'],
          $_POST['email'],
          $_POST['phone'],
          $_POST['pass'],
          $_SESSION['role']
        );

        $userC->modifierUser($condidat);
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['pass'] = $_POST["pass"];
        $_SESSION['fname'] = $_POST["nom"];
        $_SESSION['lname'] = $_POST["prenom"];
        $_SESSION['phone'] = $_POST["phone"];
        header('Location:profile.php');
    
  } else {
    echo 'Missing information.';
  }
}
?>

<!-- Add the following HTML to display the error message -->
<?php if (!empty($error)): ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php endif; ?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title>creativity-crew.</title>
		
		<!-- Favicon -->
        <link rel="icon" href="">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
		
    </head>
    <body>
	
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
		
	<!-- Header Area -->
	<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="#">About</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+216 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:@gmail.com">creativity-crew@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.php"><img src="img/huhu.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li class="active"><a href="#">Acceuil <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="index.php">Acceuil Page 1</a></li>
												</ul>
											</li>
											<li><a href="#">societe </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="404.html">404 Error</a></li>
												</ul>
											</li>
											<li><a href="contact.html">Contact Nous</a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<?php if (empty($_SESSION)) {?>

										<a href="signin.php" class="btn">Log In | Sign Up</a>

											<?php } else {?>
												<a href="profile.php" class="btn"><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></a>
												<a href="logout.php">Log Out</a>
											<?php }?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		
		
				
			</div>
		</section>
		<!--/ End Slider Area -->
		
		
		<!-- Start Appointment -->
		<section class="appointment">
			<div class="container">
				
				<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						<form class="form" method="POST">
							
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<input name="nom" type="text" placeholder="Nom" value="<?php echo $_SESSION['fname']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<input name="prenom" type="text" placeholder="prenom"value="<?php echo $_SESSION['lname']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
										<input name="email" type="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>">
									</div>
									
								</div>
								<div class="col-lg-6 col-md-6 col-12">
								
									<div class="form-group">
										<input name="phone" type="text" placeholder="Phone"value="<?php echo $_SESSION['phone']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
								
									<div class="form-group">
										<input name="pass" type="password" placeholder="Password" value="<?php echo $_SESSION['pass']; ?>">
									</div>
								</div>
								
								<?php if($_SESSION['role']=="condidat") {?>
									<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<input name="address" type="text"  value="<?php echo $_SESSION['add']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
								
									<div class="form-group">
										<input name="mat" type="text"  value="<?php echo $_SESSION['mat']; ?>">
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if($_SESSION['role']=="societe") {?>
							
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<input name="wadd" type="text" value="<?php echo $_SESSION['wadd']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<input name="cv" type="file" value="<?php echo $_SESSION['cv']; ?>">									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<select class="nice-select form-control wide" type="text" name="spec">
										<option value="option1">technologie</option>
              						    <option value="option2"> finance</option>
                                        <option value="option3"> business</option>
                                        <option value="option4"> marketing</option>
                                        <option value="option4">art</option>
            							</select>
										
									</div>
								</div>
							
							<?php } ?>
							<div class="row">
								<div class="col-lg-5 col-md-4 col-12">
									<div class="form-group">
										<div class="button">
											<button type="submit" class="btn">Update</button>
											<?php $id=$_SESSION['id']; echo "<a href='delete.php?id=$id'>Delete</a>";?>
										</div>
									</div>
								</div>
								
							</div>
							
						</form>
					</div>
					
			</div>
			</div>
		</section>
		<!-- End Appointment -->
		
		<!-- Start Newsletter Area -->
		<section class="newsletter section">
			<div class="container">
				<div class="row ">
					<div class="col-lg-6  col-12">
						<!-- Start Newsletter Form -->
						<div class="subscribe-text ">
							<h6>S'inscrire dans creativity-crew</h6>
							<p class="">Cu qui soleat partiendo urbanitas. Eum aperiri indoctum eu,<br> homero alterum.</p>
						</div>
						<!-- End Newsletter Form -->
					</div>
					<div class="col-lg-6  col-12">
						<!-- Start Newsletter Form -->
						<div class="subscribe-form ">
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" class="common-input" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'Your email address'" required="" type="email">
								<button class="btn">Envoyer</button>
							</form>
						</div>
						<!-- End Newsletter Form -->
					</div>
				</div>
			</div>
		</section>
		<!-- /End Newsletter Area -->
		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>À propos de nous</h2>
								<p>Voici notre Social Media Lien.</p>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Liens rapides</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Acceuil</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>à propos de nous</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Nos cas</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Autre Liens</a></li>	
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contacter Nous</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Bulletin</h2>
								<p>abonnez-vous à notre newsletter pour recevoir toutes nos actualités dans votre boîte de réception. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Your email address'" required="" type="email">
									<button class="button"><i class="icofont icofont-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			
		</footer>
		<!--/ End Footer Area -->
		
		<!-- jquery Min JS -->
        <script src="js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="js/easing.js"></script>
		<!-- Color JS -->
		<script src="js/colors.js"></script>
		<!-- Popper JS -->
		<script src="js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="js/main.js"></script>
    </body>
</html>