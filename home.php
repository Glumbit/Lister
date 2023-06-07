<?php
/*
Template Name: Home
*/
?>

	<?php 
	get_header();
	?>
	<main>
		<div class="stat" id="anime">
			<div class="container">
				<p class="title-stat">
					Anime
				</p>
				<div class="stat__inner">
					<div class="stat__block">
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
								$rating += get_field('rating');
							?>
						<?php } 
						$rating /= wp_count_posts('anime')->publish;
						} wp_reset_postdata(); ?>
						<ul class="d-flex flex-column justify-content-between height-100">
							<li class="stat-group-item d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Количество аниме</p>
								<p class="col-4"><?php echo wp_count_posts('anime')->publish;?></p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Средняя оценка</p>
								<p class="col-4"><?php echo round($rating, 1);?></p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Любимый жанр</p>
								<p class="col-4"><?php echo round($rating, 1);?></p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Далеко-далеко.</p>
								<p class="col-4">'[aiodpjka</p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Далеко-далеко.</p>
								<p class="col-4">'[aiodpjka</p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Далеко-далеко.</p>
								<p class="col-4">'[aiodpjka</p>
							</li>
							<li class="d-flex row align-items-center">
								<p class="col-8 subtitle fw-bold">Далеко-далеко.</p>
								<p class="col-4">'[aiodpjka</p>
							</li>
						</ul>
					</div>
					<div class="stat__block">
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
										<div class="row p-3">
											<p class="text-center mb-3 subtitle">
												Любимое аниме
											</p>
											<div class="stat__img mb-3 mx-auto">
												<img src="<?php the_field('image'); ?>" alt="favorite">
											</div>
											<p class="text-center subtitle">
												<?php the_title();?>
											</p>
											<?php the_content();?>
											<p class="description">Описание: <?php the_field('description');?></p>
											<p class="genres mb-1 text-break"><span class="fw-semibold">Жанры:</span> <?php the_terms( get_the_ID(), "genres", '', ', ','' ); ?></p>
										</div>
									<?php
									break;
								}
							?>
						<?php } } wp_reset_postdata(); ?>
					</div>
				</div>
				<div class="row">
					<a href="/lister/anime-list/" class="btn text-white btn-skew mx-auto px-4 py-2 subtitle"><span>Больше</span></a>
				</div>
			</div>
		</div>
	</main>
	<?php get_footer(); ?>