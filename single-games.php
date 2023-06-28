<?php
/*
Template Name: Single games
*/
?>
<?php get_header();?>
<main>
	<section class="single-games">
		<div class="single-games__container container">
			<?php
				$currentSerial = get_field('serial');
				$querySingle = new WP_Query([
					'post_type' => 'games',
					'meta_query' => array(
						array(
								'key' => 'serial',
								'value' => $currentSerial,
								'compare' => '=',
						)
					),
					'post__not_in' => array(
						get_the_ID()
					)
				]);
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			?>
				<div class="single-games__info info">
					<div class="single-games__col col">
						<div class="single-games__img">
							<img src="<?php the_field('image'); ?>" alt="">
						</div>
						<div class="list__outside">
							<input type="checkbox" id="info__meta" class="input_hide">
							<div class="single-games__list list list_show">
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Оригинальное название
									</p>
									<p class="list__data">
										<?php the_field('original');?>
									</p>
								</div>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Серия
									</p>
									<p class="list__data">
										<?php the_field('serial');?>
									</p>
								</div>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Студия
									</p>
									<p class="list__data">
										<?php the_field('studio');?>
									</p>
								</div>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Тип
									</p>
									<p class="list__data">
										<?php $temp = get_field_object('type');
												echo $temp["value"]["label"];
										?>
									</p>
								</div>
								<?php
									if(get_post_meta( get_the_ID(), "type", true)=="Сериал"){
										?>
											<div class="list__item">
												<p class="single-games__list-title list-title">
													Количество серий
												</p>
												<p class="list__data">
													<?php
														the_field("duration");
													?>
												</p>
											</div>
										<?php
									}
									if(get_post_meta( get_the_ID(), "type", true)=="Фильм"){
										?>
											<div class="list__item">
												<p class="single-games__list-title list-title">
													Длительность
												</p>
												<p class="list__data">
													<?php
														the_field("duration");
													?>
												</p>
											</div>
										<?php
									}
								?>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Дата выхода
									</p>
									<p class="list__data">
										<?php the_field('date-create');?>
									</p>
								</div>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Дата прохождения
									</p>
									<p class="list__data">
										<?php the_field('date-watch');?>
									</p>
								</div>
								<div class="list__item">
									<p class="single-games__list-title list-title">
										Статус
									</p>
									<p class="list__data">
										<?php $temp = get_field_object('status');
												echo $temp["value"]["label"];
										?>
									</p>
								</div>
							</div>
							<div class="info__trigger">
								<label for="info__meta" class="info__label"></label>
							</div>
						</div>
					</div>
					<div class="single-games__col col">
						<div class="single-games__list list">
							<p class="title_line-left title"> <?php 
							echo get_the_title();
							?></p>
							<div class="list__item">
								<p class="single-games__list-title list-title">
									Описание
								</p>
								<p class="list__data list__data_description">
									<?php the_field('description');?>
								</p>
							</div>
							<div class="list__item">
								<p class="single-games__list-title list-title">
									Жанры
								</p>
								<div class="list__data genres">
									<?php
										$genresArr = get_the_terms(get_the_ID(),"genres-games");
										if(is_array(get_the_terms(get_the_ID(),"genres-games"))){
											for ($i=0; $i < count($genresArr); $i++) { 
											?>
												<a class="genres__item" href="<?php echo get_term_link($genresArr[$i] -> term_id, "genres-games")?>">
													<?php echo $genresArr[$i] -> name;?>
												</a>
											<?php
										}
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="games-single__rating">
						<div class="progress-bar progress-bar_<?php echo get_field('rating')?>">
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
				<div class="single-games__block">
					<h2 class="title_line-bottom title">Похожее</h2>
					<div class="similar__items">
						<?php
					$similarPosts = $querySingle -> posts;
					for ($i=0; $i < count($similarPosts); $i++) {
						$similarPost = $similarPosts[$i];
						get_post_meta( $similarPost -> ID, "image", true );
					?>
						<div class="similar__item">
							<div class="similar__img">
								<a href="<?php echo get_permalink( $similarPost -> ID)?>">
									<img src="<?php echo wp_get_attachment_image_src( get_post_meta( $similarPost -> ID, "image", true ), [300,300])[0];?>" alt="">
								</a>
							</div>
							<div class="similar__list list">
								<a href="<?php echo get_permalink( $similarPost -> ID)?>" class="similar__list-title" title="<?php echo $similarPost -> post_title;?>">
									<?php
										echo $similarPost -> post_title;
									?>	
								</a>
								<p class="similar__list-item similar__list-item_disabled">
									<?php
										echo get_post_meta( $similarPost -> ID, "type", true );
									?>
								</p>
								<p class="similar__list-item">
									<?php
										echo get_post_meta( $similarPost -> ID, "part", true );
									?>
								</p>
								<p class="similar__list-item">
									Вышел: 
									<?php
										echo substr(get_post_meta( $similarPost -> ID, "date-create", true ),6, 2).".";
										echo substr(get_post_meta( $similarPost -> ID, "date-create", true ),4, 2).".";
										echo substr(get_post_meta( $similarPost -> ID, "date-create", true ),0, 4);
									?>
								</p>
							</div>
						</div>
					<?php
					}
					?>
					</div>
				</div>
				<div class="single-games__block shots">
					<h2 class="title_line-bottom title">Кадры</h2>
					<div class="shots__items">
						<div class="single-games__shots-item shots-item">
							<img src="<?php the_field('galery1'); ?>" alt="">
						</div>
						<div class="single-games__shots-item shots-item">
							<img src="<?php the_field('galery2'); ?>" alt="">
						</div>
						<div class="single-games__shots-item shots-item">
							<img src="<?php the_field('galery3'); ?>" alt="">
						</div>
						<div class="single-games__shots-item shots-item">
							<img src="<?php the_field('galery4'); ?>" alt="">
						</div>
					</div>
				</div>
				<div class="single-games__block single-games__block_trailer">
					<h2 class="title_line-bottom title">Трейлер</h2>
					<div class="video-wrapper">
						<video controls="controls" src="<?php the_field('trailer');?>"></video>
					</div>
				</div>
			<?php endwhile; else : ?>
				<p>Записей нет.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

