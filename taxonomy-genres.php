<?php
/*
Template Name: Genres List
*/
?>
<?php get_header();?>
<main>
		<section class="anime">
			<div class="container">
				<div class="anime__inner p-5">
					<div class="row">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<!-- Цикл WordPress -->
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-5 position-relative anime__item">
								<div class="preview">
									<img class="background" src="<?php the_field('image'); ?>" alt="">
									<div class="info p-2">
										<p class="overflow-hidden fs-6 m-0 mb-2">
											<?php 
												the_title();?>
										</p>
										<div class="row align-items-center px-3 rating">
											<div class="col-3 px-2">
												<p class="fs-6 m-0 fw-bold">
													<?php the_field('rating');?>/3
												</p>
											</div>
											<div class="col-8">
												<div class="row">
													<?php 
														for ($i=0; $i < get_field('rating'); $i++) { 
															?>
															<div class="col-4 px-2">
																<img src="<?php bloginfo('template_url');?>/assets/images/anime/star.png">
															</div>
															<?php
														};
													?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="details  overflow-hidden">
									<p class="subtitle overflow-hidden m-0">
										<?php 
										the_title();?>
									</p>
									<p class="different mb-1">
										<?php the_field('names');?>
									</p>
									<p class="serial mb-1">
										<span class="fw-semibold">Серия:</span> <?php the_field('serial');?>
									</p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold">Описание:</span> <?php the_field('description');?>
									</p>
									<p class="genres mb-1 text-break"><span class="fw-semibold">Жанры:</span> <?php the_terms( get_the_ID(), "genres", '', ', ','' ); ?></p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold">Дата выхода:</span> <?php the_field('date-create');?>
									</p>
									<p class="description overflow-hidden mb-1">
										<span class="fw-semibold">Дата просмотра:</span> <?php the_field('date-watch');?>
									</p>
								</div>
							</div>
						<?php endwhile; else : ?>
							<p>Записей нет.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>