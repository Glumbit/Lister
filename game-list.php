<?php
/*
Template Name: games List
*/
?>
	<?php 
	get_header();
	?>
	<main>
		<section class="games">
			<div class="games__inner container">
				<div class="games__list">
					<?php 
						global $query;
						$query = new WP_Query( [
							'post_type' => 'games',
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
							if(isset($_REQUEST['filter']['status'])){
								$status = array(
									'key' => 'status',
									'value' => $_REQUEST['filter']['status'],
								);
								array_push($meta, $status);
							}
							
							$query = new WP_Query( [
								'post_type' => 'games',
								'posts_per_page' => 30,
								'paged' => get_query_var( 'paged' ),
								'type' => 'list',
								'tax_query' => $genres,
								'meta_query' => $meta,
							] );
						}
						if ($query->have_posts()) {
							echo '<div class="games__items">';
							while ($query->have_posts()) {
								$query->the_post();
								?>
									<div class="games__item">
										<div class="preview <?php if(get_field('rating') == 3) {echo 'preview--great';}?>">
											<a href="<?php the_permalink( )?>" class="games__link"></a>
											<img class="games__background <?php if(get_field('status')["value"] == "not-finished") {echo 'background--no';}?>" src="<?php the_field('image'); ?>" alt="">
											<div class="games__info">
												<a href="<?php the_permalink( )?>" class="games__title title">
													<?php the_title(); ?>
												</a>
												<div class="rating <?php if (!get_field('rating')) {	echo "rating--hide";
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
												<span class="details__title">Студия:</span> <?php the_field('studio');?>
											</p>
											<p class="details__item description">
												<span class="details__title">Описание:</span> <?php the_field('description');?>
											</p>
											<p class="details__item"><span class="details__title">Жанры:</span> <?php the_terms( get_the_ID(), "genres-games", '', ', ','' ); ?></p>
											<p class="details__item">
												<span class="details__title">Дата выхода:</span> <?php the_field('date-create');?>
											</p>
											<p class="details__item">
												<span class="details__title">Дата прохождения:</span> <?php the_field('date-watch');?>
											</p>
											<p class="details__item">
												<span class="details__title">Статус:</span> 

												<?php
													$temp = get_field_object('status');
													echo $temp["value"]["label"];
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
				<div class="filter filter-games" id="games__filter">
					<div class="filter__inner-games">
						<h2 class="title-filter">Фильтры</h2>
						<form method="get" action="/games-list">
							<div class="filter__body filter__body-games">
								<div class="filter__header">
									<label for="filter__show1" class="filter__trigger"></label>
									<h4 class="filter__type">
										Жанры
									</h4>
								</div>
								<input class="filter__show" type="checkbox" id="filter__show1">
								<div class="filter__labels">
									<?php 
									$terms = get_terms( ['taxonomy' => 'genres-games',] );
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
							</div>
							<div class="filter__body filter__body-games">
								<?php
									// Проверка на соответствие чекбоксов
									function formMetaValidation($neededStr, $currentArr) {
										if(isset($_REQUEST['filter'][$currentArr])){
											if(gettype(array_search($neededStr, $_REQUEST['filter'][$currentArr]))=="integer")
											return "checked";
										}
									}
								?>
								<div class="filter__header">
									<label for="filter__show2" class="filter__trigger"></label>
									<h4 class="filter__type">
										Статус
									</h4>
								</div>
								<input class="filter__show" type="checkbox" id="filter__show2">
								<div class="filter__labels">
									<label class="label">
											<span class="label__text">Прошёл: </span>
											<input class="label__input" <?php echo formMetaValidation("finished","status");?> name="filter[status][]" type="checkbox" value="<?php echo "finished"?>" id="">
											<div class="label__front"></div>
									</label>
									<label class="label">
											<span class="label__text">Не прошёл: </span>
											<input class="label__input" <?php echo formMetaValidation("not-finished","status");?> name="filter[status][]" type="checkbox" value="<?php echo "not-finished"?>" id="">
											<div class="label__front"></div>
									</label>
									<label class="label">
											<span class="label__text">Прошёл на YouTube: </span>
											<input class="label__input" <?php echo formMetaValidation("finished-by-yt","status");?> name="filter[status][]" type="checkbox" value="<?php echo "finished-by-yt"?>" id="">
											<div class="label__front"></div>
									</label>
									<label class="label">
											<span class="label__text">Нельзя пройти: </span>
											<input class="label__input" <?php echo formMetaValidation("imposible-tofinish","status");?> name="filter[status][]" type="checkbox" value="<?php echo "imposible-tofinish"?>" id="">
											<div class="label__front"></div>
									</label>
								</div>
							</div>
							<button type=submit class="btn btn-games" id="filter__submit">Подтвердить</button>
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