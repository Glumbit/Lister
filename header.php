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
				<div class="search">
					<form class="search__form" id="collapseExample">
						<input class="search__field" type="search" placeholder="Искать" aria-label="Search">
					</form>	
				</div>
				<nav class="nav">
					<h2 class="nav__title">Меню</h2>
					<ul class="nav__list">
						<?php wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'theme_location' => 'top',
							'items_wrap' => '%3$s',
							'container' => false,
						) )?>
					</ul>
				</nav>
				<div class="burger">
					<button class="burger__btn">
						<div class="burger__line"></div>
						<div class="burger__line"></div>
						<div class="burger__line"></div>
						<!-- <svg>
							<use xlink:href="assets/svg/intro.svg#gemini"></use>
						</svg> -->
					</button>
				</div>
			</nav>
		</div>
	</header>
<div class="spacer"></div>