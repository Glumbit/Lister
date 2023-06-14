<?php
/*
Template Name: Home
*/
?>

	<?php 
	get_header();
	?>
	<main>
		<section class="anime" id="anime">
			<div class="container">
				<div class="anime__wrapper">
					<p class="title-anime">
					Аниме
				</p>
				<div class="anime__blocks">
					<div class="anime__block">
						<h3 class="anime__title">Статистика</h3>
						<?php
						global $post;

						$myposts = get_posts([ 
							'numberposts' => -1,
							'post_type' => 'anime',
							'suppress_filters' => true,
						]);

						if( $myposts ){
							foreach( $myposts as $post ){
								setup_postdata( $post );
						?>
							<?php 
								$rating = get_field('rating');
							?>
						<?php } 
						$rating /= wp_count_posts('anime')->publish;
						} wp_reset_postdata(); ?>
						<ul class="stat">
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Количество аниме</p>
								</div>
								<div class="stat__back">
									<p class="stat__result"><?php echo wp_count_posts('anime')->publish;?></p>
								</div>
							</li>
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Средняя оценка</p>
								</div>
								<div class="stat__back">
									<p class="stat__result"><?php echo round($rating, 1);?></p>
								</div>
							</li>
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Средняя оценка</p>
								</div>
								<div class="stat__back">
									<p class="stat__result"><?php echo round($rating, 1);?></p>
								</div>
							</li>
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Средняя оценка</p>
								</div>
								<div class="stat__back">
									<p class="stat__result">Романтика</p>
								</div>
							</li>
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Средняя оценка</p>
								</div>
								<div class="stat__back">
									<p class="stat__result"><?php echo round($rating, 1);?></p>
								</div>
							</li>
							<li class="stat__item">
								<div class="stat__front">
									<div class="stat__img">
										<img src="<?php bloginfo('template_url')?>/assets/images/anime/star.png" alt="">
									</div>
									<p class="subtitle-stat">Средняя оценка</p>
								</div>
								<div class="stat__back">
									<p class="stat__result"><?php echo round($rating, 1);?></p>
								</div>
							</li>
						</ul>
					</div>
					<div class="anime__block">
						<h3 class="anime__title">Любимое аниме</h3>
						<?php
						global $post;

						$myposts = get_posts([ 
							'numberposts' => -1,
							'post_type' => 'anime',
							'suppress_filters' => true,
						]);

						if( $myposts ){
							foreach( $myposts as $post ){
								setup_postdata( $post );
						?>
							<?php 
								if (get_field('favorite')) {
									?>
									<div class="favorite">
										<div class="favorite__img">
											<img src="<?php the_field('image'); ?>" alt="favorite">
										</div>
										<p class="subtitle subtitle-favorite">
											<?php the_title();?>
										</p>
										<?php the_content();?>
										<p class="description">Описание: <?php the_field('description');?></p>
										<p class="genres"><span class="fw-semibold">Жанры:</span> <?php the_terms( get_the_ID(), "genres", '', ', ','' ); ?></p>
									</div>
									<?php
									break;
								}
							?>
						<?php } } wp_reset_postdata(); ?>
					</div>
				</div>
				
				</div>
				<div class="center">
					<a href="/lister/anime-list/" class="btn btn-stat mx-auto px-4 py-2 subtitle">Больше</a>
				</div>
			</div>
		</section>
	</main>
	<?php get_footer(); ?>