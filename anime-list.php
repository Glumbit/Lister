<?php
/*
Template Name: Anime List
*/
?>
	<?php 
	get_header();
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
	?>
	<main>
		<section class="anime">
			<div class="anime__inner container">
				<div class="anime__list">
					<div class="anime__items">
					<?php 
						global $query;

						$query = new WP_Query( [
							'post_type' => 'anime',
							'posts_per_page' => 6,
							'paged' => get_query_var( 'paged' ),
							'type' => 'list',
						] );

						if (isset($_REQUEST['filter'])) {
							$genres = [];
							$status =[];
							if(isset($_REQUEST['filter']['genres'])){
								$genres = array(
								array(
								"taxonomy" => "genres",
								"field" => "id",
								"terms" => $_REQUEST['filter']['genres'],
								)
							);
							}
							if(isset($_REQUEST['filter']['watched'])){
								$status = array(
									array(
											'key' => 'status',
											'value' => true,
											'compare' => '=',
											'type' => 'bool',
									)
								);
							}
							
							$query = new WP_Query( [
								'post_type' => 'anime',
								'posts_per_page' => 6,
								'paged' => get_query_var( 'paged' ),
								'type' => 'list',
								'tax_query' => $genres,
								'meta_query' => $status,
							] );
							// echo "<pre>";
							// print_r($query -> query);
							// echo "</pre>";
						}
						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post();
								?>
									<div class="anime__item">
										<div class="preview <?php if(get_field('rating') == 3) {echo 'preview--great';}?>">
											<a href="<?php the_permalink( )?>" class="anime__link"></a>
											<img class="anime__background <?php if(!get_field('status')) {echo 'background--no';}?>" src="<?php the_field('image'); ?>" alt="">
											<div class="info">
												<a href="<?php the_permalink( )?>" class="info__name">
													<?php the_title(); ?>
												</a>
												<div class="rating <?php if (!get_field('status')) {	echo "rating--hide";
												}?>">
													<div class="rating__numbers">
														<p class="awwda">
															<?php the_field('rating');?>/3
														</p>
													</div>
													<div class="rating__visual">
														<?php 
															for ($i=0; $i < get_field('rating'); $i++) { 
																?>
																<div class="rating__star">
																	<img src="<?php bloginfo('template_url');?>/assets/images/anime/star.png">
																</div>
																<?php
															};
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="details">
											<p class="details__item details__title">
												<?php 
												the_title();?>
											</p>
											<p class="details__item different">
												<?php the_field('names');?>
											</p>
											<p class="details__item">
												<span class="fw-semibold">Серия:</span> <?php the_field('serial');?>
											</p>
											<p class="details__item">
												<span class="fw-semibold">Студия:</span> <?php the_field('studio');?>
											</p>
											<p class="details__item description">
												<span class="fw-semibold">Описание:</span> <?php the_field('description');?>
											</p>
											<p class="details__item genres"><span class="fw-semibold">Жанры:</span> <?php the_terms( get_the_ID(), "genres", '', ', ','' ); ?></p>
											<p class="details__item">
												<span class="fw-semibold">Дата выхода:</span> <?php the_field('date-create');?>
											</p>
											<p class="details__item">
												<span class="fw-semibold">Дата просмотра:</span> <?php the_field('date-watch');?>
											</p>
											<p class="details__item">
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
								<?php
							} wp_reset_postdata();
						}
					?>
					</div>
					<div class="pagination">
						<?php 
							echo paginate_links( [
								'current' => max( 1, get_query_var( 'paged' ) ),
								'total'   => $query->max_num_pages,
								'mid_size' => 0,
							] );
						?>
					</div>
				</div>
				<div class="filter filter-anime" id="anime__filter">
					<div class="filter__inner-anime">
						<h2 class="filter__title">Фильтры</h2>
						<form method="get">
							<div class="filter__labels filter__labels-anime">
								<h4 class="filter__category">
									Жанры
								</h4>
								<?php 
								$terms = get_terms( ['taxonomy' => 'genres',] );
								foreach( $terms as $term ) {
									?>
									<label class="label">
										<span class="label__text"><?php echo $term->name?>: </span>
										<input class="label__input" <?php
											if (isset($_REQUEST['filter']['genres'])) {
												for ($i=0; $i < count($_REQUEST['filter']['genres']); $i++) {
													$genreID = $_REQUEST['filter']['genres'][$i];
													if ($genreID == $term->term_id) {
														echo "checked";
													}
												}
											}
										?> name="filter[genres][]" type="checkbox" value="<?php echo $term->term_id ?>" id="">
										<div class="label__front"></div>
									</label>
									<?php
								}?>
							</div>
							<div class="filter__labels filter__labels-anime">
								<h4 class="filter__category">
									Прочее
								</h4>
								<label class="label">
										<span class="label__text">Просмотрено: </span>
										<input class="label__input" <?php if(isset($_REQUEST['filter']['watched'])){echo "checked";}?> name="filter[watched][]" type="checkbox" value="<?php echo true?>" id="">
										<div class="label__front"></div>
								</label>
							</div>
							<button type=submit class="btn btn-anime" id="filter__submit">Подтвердить</button>
						</form>
					</div>
				</div>
				<button class="filter__btn">Фильтры</button>
			</div>
			<!-- <div class="pagination">
				<?php 
					echo paginate_links( [
						'current' => max( 1, get_query_var( 'paged' ) ),
						'total'   => $query->max_num_pages,
					] );
				?>
			</div> -->
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
			<!-- <button class="btn-filter p-2 d-lg-none">
				<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-filter fc2" viewBox="0 0 16 16">
					<path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
				</svg>
			</button> -->
		</section>
	</main>
	<?php get_footer(); ?>