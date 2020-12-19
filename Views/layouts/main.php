<?php
 use \app\core\Application;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>uset test</title>
	<?php linkCss('assest/css/bootstrap.min.css');?>
</head>
<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
					<a class="navbar-brand" href="#">Navbar</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
		
					<div class="collapse navbar-collapse" id="navbarsExampleDefault">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
								<a class="nav-link" href="<?php echo baseUrl;?>/">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Contact</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">About</a>
							</li>

						</ul>
						<?php if(Application::$app->isGuest()):?>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo baseUrl;?>/register">Register</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo baseUrl;?>/login">Signin</a>
							</li>
						</ul>

					<?php else: ?>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo baseUrl;?>/logout">
									Welcome <?php echo Application::$app->user->UserDisplayName() ;?> (Logout)

								</a>
							</li>

					<?php endif; ?>
					</div>
				</nav><br><br><br>

				<div class="container mt-5">
					<?php if(Application::$app->session->getFlashMsg('success') ): ;?>
					<div class="alert alert-success">
						<?php echo Application::$app->session->getFlashMsg('success');?>
					</div>
				<?php endif; ?>
					{{content}}
				</div>
		
		
</body>
</html>