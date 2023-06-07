<?php
/*
Template Name: Single anime
*/
?>
<?php get_header();?>
<main>
	<section class="single-anime">
		<div class="container">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<!-- Цикл WordPress -->
						<div class="single-anime__inner">
							<div class="row bg2 p-3 rounded mb-4">
								<p class="text-center subtitle m-0 fs-2 fw-semibold"> <?php the_title()?></p>
							</div>
							<div class="row bg2 p-5 rounded justify-content-between">
								<div class="col-sm-12 col-lg-4 overflow-hidden rounded p-0 mb-4 mb-sm-0">
									<img src="<?php the_field('image'); ?>" alt="">
								</div>
								<div class="col-sm-12 col-lg-8 ps-sm-5">
									<p class="different mb-1">
										<span class="fw-semibold fc2">Альтернативные названия:</span> <?php the_field('names');?>
									</p>
									<p class="serial mb-1">
										<span class="fw-semibold fc2">Серия:</span> <?php the_field('serial');?>
									</p>
									<p class="studio mb-1">
										<span class="fw-semibold fc2">Студия:</span> <?php the_field('studio');?>
									</p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold fc2">Описание:</span> <?php the_field('description');?>
									</p>
									<p class="genres mb-1 text-break"><span class="fw-semibold">Жанры:</span> <?php the_terms( get_the_ID(), "genres", '', ', ','' ); ?></p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold fc2">Дата выхода:</span> <?php the_field('date-create');?>
									</p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold fc2">Дата просмотра:</span> <?php the_field('date-watch');?>
									</p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold fc2">Статус:</span> 
										<?php 
											if (get_field('status')) {
												echo 'Просмотренно';
											}
											else {
												echo 'Не просмотренно';
											}
										?>
									</p>
								</div>
							</div>
						</div>
			<?php endwhile; else : ?>
				<p>Записей нет.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

