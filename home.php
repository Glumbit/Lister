<?php
/*
Template Name: Home
*/
?>

	<?php 
	get_header();
	?>
	<main>
		<section class="statistics">
			<div class="container">
				<div class="statistics__category">
					<a href="/lister/anime-list/" class="statistics__title title_line-left"><span>Аниме</span></a>
					<div class="statistics__body">
						<div class="statistics__block">
							<p class="title_line-bottom">Статистика</p>
							<div class="statistics__cards cards">
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество аниме</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('anime')->publish;?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="statistics__block statistics__block_favorite">
							<?php
								$game = new WP_Query([
									'post_type' => 'anime',
									'meta_query' => [
										[
											'key' => 'favorite',
											'value' => true,
											'type' => "bool"
										]
									],
								]);
								$gameFav = $game -> posts[0];
							?>
							<p class="title_line-bottom">Любимое аниме</p>
							<div class="statistics__favorite-img">
								<a href="<?php echo $gameFav -> guid?>">
									<img src="<?php	echo wp_get_attachment_image_src( get_post_meta( $gameFav -> ID, "image", true ), [300,300])[0];?>" alt="">
								</a>
							</div>
							<a href="<?php echo $gameFav -> guid?>" class="title_line-left statistics__title_line-left" title="<?php echo $gameFav -> post_title;?>"><span>
								<?php echo $gameFav -> post_title;?>
								</span>
							</a>
							<p class="description"> <?php echo get_post_meta( $gameFav -> ID, "description", true );?></p>
							<div class="genres"> <?php
									$genres = get_the_terms($gameFav -> ID,"genres-anime");
									for ($i=0; $i < count($genres); $i++) { 
										?>
											<div class="genres-item" title="<?php echo $genres[$i]->name;?>">
												<a href="<?php echo get_term_link( $genres[$i]->term_id, "genres-anime" );?>" title="<?php echo $genres[$i]->name;?>"><?php echo $genres[$i]->name;?></a>
											</div>
										<?php
									}
									
								?>
							</div>
						</div>
					</div>
					<a href="/lister/anime-list/" class="statistics__link btn">Список</a>
				</div>
				<div class="statistics__category">
					<a href="/lister/games-list/" class="statistics__title title_line-left"><span>Игры</span></a>
					<div class="statistics__body">
						<div class="statistics__block">
							<p class="title_line-bottom">Статистика</p>
							<div class="statistics__cards cards">
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
								<div class="cards__item-rotate-right">
									<div class="cards__front">
										<div class="statistics__cards-img cards-img">
											<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
										</div>
										<p class="cards__title">Количество игр</p>
									</div>
									<div class="cards__back">
										<p class="cards__title"><?php echo wp_count_posts('games')->publish;?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="statistics__block statistics__block_favorite">
							<?php
								$game = new WP_Query([
									'post_type' => 'games',
									'meta_query' => [
										[
											'key' => 'favorite',
											'value' => true,
											'type' => "bool"
										]
									],
								]);
								$gameFav = $game -> posts[0];
							?>
							<p class="title_line-bottom">Любимая игра</p>
							<div class="statistics__favorite-img">
								<a href="<?php echo $gameFav -> guid?>">
									<img src="<?php	echo wp_get_attachment_image_src( get_post_meta( $gameFav -> ID, "image", true ), [300,300])[0];?>" alt="">
								</a>
							</div>
							<a href="<?php echo $gameFav -> guid?>" class="title_line-left statistics__title_line-left" title="<?php echo $gameFav -> post_title;?>"><span>
								<?php echo $gameFav -> post_title;?>
								</span>
							</a>
							<p class="description"> <?php echo get_post_meta( $gameFav -> ID, "description", true );?></p>
							<div class="genres"> <?php
									$genres = get_the_terms($gameFav -> ID,"genres-games");
									for ($i=0; $i < count($genres); $i++) { 
										?>
											<div class="genres-item" title="<?php echo $genres[$i]->name;?>">
												<a href="<?php echo get_term_link( $genres[$i]->term_id, "genres-games" );?>" title="<?php echo $genres[$i]->name;?>"><?php echo $genres[$i]->name;?></a>
											</div>
										<?php
									}
									
								?>
							</div>
						</div>
					</div>
					<a href="/lister/games-list/" class="statistics__link btn">Список</a>
				</div>
			</div>
		</section>
	</main>
	<?php get_footer(); ?>