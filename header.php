<!DOCTYPE html>
<html lang="ru">

<head>
	<?php wp_head(); ?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Lists </title>
</head>
<body>
	<header class="header bg2 fixed-top">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
				<div class="container-fluid">
					<div class="logo">
						<img class="logo__img" src="<?php bloginfo('template_url')?> /assets/images/index/logo_img.png" alt="logo img">
						<a class="navbar-brand" href="<?php echo home_url( )?>">My List</a>
					</div>
					<button class="navbar-toggler bgs2" style="box-shadow: 0px 0px 0px 0px transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list fc2" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
						</svg>
					</button>
					<div class="collapse navbar-collapse flex-grow-1" id="navbarSupportedContent">
						<form class="d-flex flex-grow-1 mx-md-2 mx-lg-3 mx-xxl-5 search collapse" id="collapseExample">
							<input class="form-control bg1 me-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn" type="submit">Search</button>
						</form>	
						<?php wp_nav_menu( array(
								'theme_location' => 'top',
								'container' => 'null',
								'menu_class' => 'navbar-nav mb-2 mb-lg-0 ',
								'menu_id' => 'null',
							) )?>
					</div>
				</div>
			</nav>
		</div>
	</header>
<div class="spacer"></div>