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
				<a href="<?php echo home_url( )?>" class="logo">
					<img class="logo__img" src="<?php bloginfo('template_url')?> /assets/images/index/logo_img.png" alt="logo img">
					<p class="logo__brand">Lister</p>
				</a>
				<div class="search">
					<form action="/search" method="post" class="search__form" id="collapseExample">
						<input class="search__field" type="search" name="myVar" placeholder="Искать" aria-label="Search">
						<?php
							$searchAnime = new WP_Query([
								'post_type' => 'anime'
							]);
							$searchGames = new WP_Query([
								'post_type' => 'games'
							]);
							$search = [];
							$search = array_merge($searchAnime -> posts, $searchGames -> posts);
						?>
					</form>	
					<div class="search__results search__results_disabled">
						<div class="search__item">
							<?php $posid = 8 ?>
							<div class="search__img"><a href="#"><img src="<?php echo wp_get_attachment_image_src( get_post_meta( $posid/*здесь ID*/, "image", true ), [300,300])[0];?>" alt=""></a></div>
							<div class="search__data">
								<a href="<?php the_permalink($posid/*здесь ID*/)?>" class="search__title_line-left title_line-left"><?php echo get_the_title($posid ) ?></a>
								<p><?php echo get_field_object( "type", $posid)["value"]["label"]; ?></p>
								<p><?php echo get_post_meta( $posid, "part", true );?></p>
								<p>Вышел: 
									<?php
										echo substr(get_post_meta( $posid, "date-create", true ),6, 2).".";
										echo substr(get_post_meta( $posid, "date-create", true ),4, 2).".";
										echo substr(get_post_meta( $posid, "date-create", true ),0, 4);
									?>
								</p>
							</div>
						</div>
						<div class="search__item">
							<?php $posid = 71 ?>
							<div class="search__img"><img src="<?php echo wp_get_attachment_image_src( get_post_meta( $posid/*здесь ID*/, "image", true ), [300,300])[0];?>" alt=""></div>
							<div class="search__data">
								<a href="<?php the_permalink($posid/*здесь ID*/)?>" class="search__title_line-left title_line-left" title="<?php echo get_the_title($posid ) ?>"><?php echo get_the_title($posid ) ?></a>
								<p><?php echo get_field_object( "type", $posid)["value"]["label"]; ?></p>
								<p><?php echo get_post_meta( $posid, "part", true );?></p>
								<p>Вышел: 
									<?php
										echo substr(get_post_meta( $posid, "date-create", true ),6, 2).".";
										echo substr(get_post_meta( $posid, "date-create", true ),4, 2).".";
										echo substr(get_post_meta( $posid, "date-create", true ),0, 4);
									?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<input type="checkbox" class="trigger header__trigger" id="navShow">
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
					<label class="burger_show" for="navShow"></label>
					<button class="burger__btn">
						<div class="burger__line"></div>
						<div class="burger__line"></div>
						<div class="burger__line"></div>
					</button>
				</div>
			</nav>
		</div>
	</header>
<div class="spacer"></div>