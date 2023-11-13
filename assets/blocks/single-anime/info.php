<div class="single-anime__info info">
	<div class="single-anime__col col">
		<div class="single-anime__img">
			<img src="<?php the_field('image'); ?>" alt="">
		</div>
		<div class="single-anime__list">
			<div class="single-anime__genres">
				<p class="single-anime__list-title list-title">
					Жанры
				</p>
				<div class="genres">
					<?php
						$genresArr = get_the_terms(get_the_ID(),"genres-anime");
						if(is_array(get_the_terms(get_the_ID(),"genres-anime"))){
							for ($i=0; $i < count($genresArr); $i++) { 
							?>
								<a class="genres__item" href="<?php echo get_term_link($genresArr[$i] -> term_id, "genres-anime")?>">
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
	<div class="single-anime__col col">
		<div class="single-anime__list list">
			<div class="single-anime__header">
				<p class="title_line-left single-anime__title"> <?php echo get_the_title();?></p>
				<p class="single-anime__original" ><?php the_field('original');?></p>
			</div>
			<div class="list__item">
				<p class="single-anime__list-title list-title">
					Серия
				</p>
				<p class="list__data">
					<?php the_field('serial');?>
				</p>
			</div>
			<div class="list__item">
				<p class="single-anime__list-title list-title">
					Студия
				</p>
				<p class="list__data">
					<?php the_field('studio');?>
				</p>
			</div>
			<div class="list__item">
				<p class="single-anime__list-title list-title">
					Тип
				</p>
				<p class="list__data">
					<?php echo get_field_object( "type" )["value"]["label"];?>
				</p>
			</div>
			<?php
				if(get_field_object( "type" )["value"]["label"] == "Сериал"){
					?>
						<div class="list__item">
							<p class="single-anime__list-title list-title">
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
				if(get_field_object( "type" )["value"]["label"] =="Фильм"){
					?>
						<div class="list__item">
							<p class="single-anime__list-title list-title">
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
				<p class="single-anime__list-title list-title">
					Дата выхода
				</p>
				<p class="list__data">
					<?php the_field('date-create');?>
				</p>
			</div>
			<div class="list__item">
			<p class="single-anime__list-title list-title">
				Дата просмотра
			</p>
			<p class="list__data">
				<?php the_field('date-watch');?>
			</p>
			</div>
			<div class="list__item">
				<p class="single-anime__list-title list-title">
					Статус
				</p>
				<p class="list__data">
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
			<div class="list__item">
				<p class="single-anime__list-title list-title">
					Рейтинг
				</p>
				<p class="list__data">
					3 / <?php the_field('rating');?>
				</p>
			</div>
		</div>
	</div>
	<div class="single-anime__col-12">
		<div class="single-amime__description">
				<p class="single-anime__list-title list-title">
					Описание
				</p>
				<p class="">
					<?php the_field('description');?>
				</p>
			</div>
	</div>
</div>