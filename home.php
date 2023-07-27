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
					<?php 
						$averageAnime = [
							'genre'=>[],
							'rating'=>[],
							'not-viewed' => 0,
							'viewed' => 0,
							'serial' => 0,
							'films' => 0,
							'last-update' => 0,
						];
						$genresArr = get_terms( ['taxonomy' => 'genres-anime','hide_empty' => false,] );
						$max = ['term_name' => "", 'term_count' => -1,];
						foreach ($genresArr as $genreItem) {
							if ($genreItem->count >= $max['term_count']) {
								$max['term_name']=$genreItem->name;
								$max['term_count']=$genreItem->count;
							}
						}
						$averageAnime['genre']=$max['term_name'];

						$statAnime = new WP_Query([
							'post_type' => 'anime',
						]);
						if ($statAnime->have_posts()) {
							while ($statAnime->have_posts()) {
								$statAnime->the_post();
								if (get_field("rating") !== null) {
									array_push($averageAnime['rating'], get_field("rating"));
								}
								if (get_field("status") == null) {
									++$averageAnime['not-viewed'];
								}
								if (get_field("status") == 1) {
									++$averageAnime['viewed'];
								}
								$temp = get_field_object('type');
								if (get_field("type") !== null && $temp['value']['label'] == "Сериал") {
									++$averageAnime['serial'];
								}
								if (get_field("type") !== null && $temp['value']['label'] == "Фильм") {
									++$averageAnime['films'];
								}
								if (get_field("date-watch") > $averageAnime['last-update']) {
									$averageAnime['last-update'] = get_field("date-watch");
								}
							} wp_reset_postdata();
						}
						$averageAnime['rating'] = avarageFind($averageAnime['rating']);
						function avarageFind($averageAnime) {
							$similar = array_count_values($averageAnime);
							$most=[
								'name' => "",
								'value' => 0,
							];
							foreach ($similar as $value) {
								if ($most['value'] <= $value) {
									$most['name'] = key($similar);
									$most['value'] = $value;
								}
								next($similar);
							}
							return $most['name'];
						}
					?>
					<a href="/lister/anime-list/" class="statistics__title title_line-left"><span>Аниме</span></a>
					<div class="statistics__body">
						<div class="statistics__block">
							<p class="title_line-bottom">Статистика</p>
							<div class="statistics__cards cards">
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество игр</h3>
									<p class="statistics__card-text card-text"><?php echo wp_count_posts('anime')->publish;?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Любимый жанр</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['genre'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Средний рейтинг</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['rating'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Досмотрено</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['viewed'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Не досмотрено</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['not-viewed'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество сериалов</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['serial'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество фильмов</h3>
									<p class="statistics__card-text card-text"><?php echo $averageAnime['films'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Последнее обновление</h3>
									<p class="statistics__card-text card-text"><?php 
										echo substr($averageAnime['last-update'],6, 2).".";
										echo substr($averageAnime['last-update'],4, 2).".";
										echo substr($averageAnime['last-update'],0, 4);
										?></p>
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
					<?php 
						$averageGames = [
							'genre'=>[],
							'rating'=>[],
							'not-finished' => 0,
							'finished' => 0,
							'finished-by-yt' => 0,
							'imposible-to-finish' => 0,
							'multiplayer' => 0,
							'singleplayer' => 0,
							'last-update' => 0,
						];
						$genresArr = get_terms( ['taxonomy' => 'genres-games','hide_empty' => false,] );
						$max = ['term_name' => "", 'term_count' => -1,];
						foreach ($genresArr as $genreItem) {
							if ($genreItem->count >= $max['term_count']) {
								$max['term_name']=$genreItem->name;
								$max['term_count']=$genreItem->count;
							}
						}
						$averageGames['genre']=$max['term_name'];

						$statGames = new WP_Query([
							'post_type' => 'games',
						]);
						if ($statGames->have_posts()) {
							while ($statGames->have_posts()) {
								$statGames->the_post();
								if (get_field("rating") !== null) {
									array_push($averageGames['rating'], get_field("rating"));
								}
								$temp = get_field_object('status');
								if (get_field("status") !== null && $temp['value']['label'] == "Не прощёл") {
									++$averageGames['not-finished'];
								}
								if (get_field("status") !== null && $temp['value']['label'] == "Прошёл") {
									++$averageGames['finished'];
								}
								if (get_field("status") !== null && $temp['value']['label'] == "Прощёл на YouTube") {
									++$averageGames['finished-by-yt'];
								}
								if (get_field("status") !== null && $temp['value']['label'] == "Нельзя пройти") {
									++$averageGames['imposible-to-finish'];
								}
								$temp = get_field_object('type');
								if (get_field("type") !== null && $temp['value']['label'] == "Мультиплеер") {
									++$averageGames['multiplayer'];
								}
								if (get_field("type") !== null && $temp['value']['label'] == "Синглплейер") {
									++$averageGames['singleplayer'];
								}
								if (get_field("date-watch") > $averageGames['last-update']) {
									$averageGames['last-update'] = get_field("date-watch");
								}
							} wp_reset_postdata();
						}
						$averageGames['rating'] = avarageFind($averageGames['rating']);
					?>
					<a href="/lister/games-list/" class="statistics__title title_line-left"><span>Игры</span></a>
					<div class="statistics__body">
						<div class="statistics__block">
							<p class="title_line-bottom">Статистика</p>
							<div class="statistics__cards cards">
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество игр</h3>
									<p class="statistics__card-text card-text"><?php echo wp_count_posts('anime')->publish;?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Любимый жанр</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['genre'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Средний рейтинг</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['rating'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Не прошёл</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['not-finished'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Прошёл на YouTube</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['finished-by-yt'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Нельзя пройти</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['imposible-to-finish'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество мультиплеерных игр</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['multiplayer'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Количество синглплеерных игр</h3>
									<p class="statistics__card-text card-text"><?php echo $averageGames['singleplayer'];?></p>
								</div>
								<div class="statistics__cards__item cards__item">
									<h3 class="statistics__card-title card-title">Последнее обновление</h3>
									<p class="statistics__card-text card-text"><?php 
										echo substr($averageGames['last-update'],6, 2).".";
										echo substr($averageGames['last-update'],4, 2).".";
										echo substr($averageGames['last-update'],0, 4);
										?></p>
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