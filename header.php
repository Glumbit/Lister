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
	<header class="header">
		<div class="container">
			<nav class="navbar">
				<div class="logo">
					<img class="logo__img" src="<?php bloginfo('template_url')?> /assets/images/index/logo_img.png" alt="logo img">
					<a class="logo__brand" href="<?php echo home_url( )?>">Lister</a>
				</div>
				<button class="burger"type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list fc2" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
					</svg>
				</button>
				<div class="search">
					<form class="search__form" id="collapseExample">
						<input class="search__field" type="search" placeholder="Искать" aria-label="Search">
						<!-- <button class="btn btn-search" type="submit">Искать</button> -->
					</form>	
				</div>
				<ul class="nav">
					<?php wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'theme_location' => 'top',
							'items_wrap' => '%3$s',
							'container' => false,
						) )?>
				</ul>
			</nav>
		</div>
	</header>
<div class="spacer"></div>