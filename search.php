<?php
/*
Template Name: Search
*/
?>
<?php 
get_header();
?>
<main>
	<section class="search-results">
		<div class="search-results__inner container">
			<h2 class="title_line-bottom">Результаты поиска по запросу: <?php echo $_REQUEST['myVar'] ?></h2>
				<div class="search-results__list">
					<?php
						global $query;
						$query = new WP_Query( [
							'post_type' => 'any',
							's' => $_REQUEST['myVar'],
							'posts_per_page' => 30,
							'paged' => get_query_var( 'paged' ),
							'type' => 'list',
						] );
						if (isset($_REQUEST['filter'])) {
							$genres = [];
							$meta =[];
							if(isset($_REQUEST['filter']['genres'])){
								$genres = array(
								array(
								"taxonomy" => "genres",
								"field" => "id",
								"terms" => $_REQUEST['filter']['genres'],
								)
							);
							}

							$meta = array();

							if(isset($_REQUEST['filter']['watched'])){
								$watched = 
									array(
											'key' => 'status',
											'value' => true,
											'compare' => '=',
											'type' => 'bool',
									);
								array_push($meta, $watched);
							}

							if(isset($_REQUEST['filter']['type'])){
								$type = 
									array(
											'key' => 'type',
											'value' => $_REQUEST['filter']['type'],
									);

								array_push($meta, $type);
							}
							
							$query = new WP_Query( [
								'post_type' => 'anime',
								'posts_per_page' => 30,
								'paged' => get_query_var( 'paged' ),
								'type' => 'list',
								'tax_query' => $genres,
								'meta_query' => $meta,
							] );
						}
						if ($query->have_posts()) {
							echo '<div class="search-results__items">';
							while ($query->have_posts()) {
								$query->the_post();
								?>
									<div class="search-results__item">
										<div class="preview <?php if(get_field('rating') == 3) {echo 'preview--great';}?>">
											<a href="<?php the_permalink( )?>" class="search-results__link"></a>
											<img class="search-results__background <?php if(!get_field('status')) {echo 'background--no';}?>" src="<?php the_field('image'); ?>" alt="">
											<div class="search-results__info">
												<a href="<?php the_permalink( )?>" class="info__name" rows="1">
													<?php the_title() ?>
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
												<?php the_field('original');?>
											</p>
											<p class="details__item">
												<span class="details__title">Серия:</span> <?php the_field('serial');?>
											</p>
											<p class="details__item">
												<span class="details__title">Тип:</span> 
												<?php 
												$temp = get_field_object('type');
												echo $temp["value"]["label"];?>
											</p>
											<p class="details__item">
												<span class="details__title">Часть:</span> <?php the_field('part');?>
											</p>
											<p class="details__item">
												<span class="details__title">Студия:</span> <?php the_field('studio');?>
											</p>
											<p class="details__item description">
												<span class="details__title">Описание:</span> <?php the_field('description');?>
											</p>
											<p class="details__item genres"><span class="details__title">Жанры:</span> <?php the_terms( get_the_ID(), "genres-anime", '', ', ','' ); ?></p>
											<p class="details__item">
												<span class="details__title">Дата выхода:</span> <?php the_field('date-create');?>
											</p>
											<p class="details__item">
												<span class="details__title">Дата просмотра:</span> <?php the_field('date-watch');?>
											</p>
											<p class="details__item">
												<span class="details__title">Статус:</span> 
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
							echo '</div>';
						}
						else{
							?>
								<h2>Нет результатов удовлетворяющих ваш запрос</h2>
							<?php
						}
					?>
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
		</div>
	</section>
</main>
<?php get_footer(); ?>