<?php
/*
Template Name: Anime List
*/
?>
	<?php 
	get_header();
	?>
	<main>
		<section class="anime">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-lg-9 pe-lg-4">
						<div class="row bg2 py-4 rounded">
							<?php 


								global $query;
								$query = new WP_Query( [
									'post_type' => 'anime',
									'posts_per_page' => 5,
									'paged' => get_query_var( 'paged' ),
									'type' => 'list',
								] );

								if ($query->have_posts()) {
									while ($query->have_posts()) {
										$query->the_post();
										?>
											<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 position-relative anime__item">
												<div class="wrapper-anime">
													<a href="<?php the_permalink( )?>" class="link-anime"></a>
													<div class="preview <?php if(get_field('rating') == 3) {echo 'nice';}?>">
														<img class="background <?php if(!get_field('status')) {echo 'grey';}?>" src="<?php the_field('image'); ?>" alt="">
														<div class="info p-2">
															<p class="overflow-hidden fs-6 m-0 mb-2">
																<?php the_title(); ?>
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
														<p class="studio mb-1">
															<span class="fw-semibold">Студия:</span> <?php the_field('studio');?>
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
														<p class="description overflow-hidden mb-1">
															<span class="fw-semibold">Статус:</span> 
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
										<?php
									} wp_reset_postdata();
								}
							?>
						</div>
						<div class="pagination justify-content-center">
								<?php 
									echo paginate_links( [
										'current' => max( 1, get_query_var( 'paged' ) ),
										'total'   => $query->max_num_pages,
									] );
								?>
						</div>
					</div>
					<div class="col-sm-12 col-lg-3 ps-lg-4" >
						<div class="row">
							<div class="anime__filter pt-4 rounded" id="anime__filter">
								<form method="get">
									<?php 
									$terms = get_terms( ['taxonomy' => 'genres',] );
									foreach( $terms as $term ) {
										echo 
										'<label class="label d-flex justify-content-between p-2 rounded">
											<span class="label__text">'.$term->name.': </span>
											<input class="form-check-input" name type="checkbox" value="" id="'.$term->name.'">
										</label>';
									}?>
									<div class="d-flex justify-content-center filter__show">
										<button type=submit class="btn d-block" id="filter__submit">Подтвердить</button>
								</div>
								</form>
							</div>
						</div>
							
					</div>
				</div>
			</div>
			<!-- <?php
			if (isset($_REQUEST[$terms])) {
				global $wp_query;
				$filter = [
					'tax_query' => [
						'relation' => 'AND',
					],
				] ;
				
			}
			?> -->
			<button class="btn-filter p-2 d-lg-none">
				<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-filter fc2" viewBox="0 0 16 16">
					<path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
				</svg>
			</button>
		</section>
	</main>
	<?php get_footer(); ?>