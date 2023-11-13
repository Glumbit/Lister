<div class="single-games__info info">
	<div class="single-games__col col">
		<div class="single-games__img">
			<img src="<?php the_field('image'); ?>" alt="">
		</div>
		<div class="single-games__list">
			<div class="single-games__genres">
				<p class="single-games__list-title list-title">
					Жанры
				</p>
				<div class="genres">
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
	<div class="single-games__col col">
		<div class="single-games__list list">
			<div class="single-games__header">
				<p class="title_line-left single-games__title"> <?php echo get_the_title();?></p>
				<p class="single-games__original" ><?php the_field('original');?></p>
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
					<?php echo get_field_object( "type" )["value"]["label"];?>
				</p>
			</div>
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
					<?php echo get_field_object( "status" )["value"]["label"];?>
				</p>
			</div>
			<div class="list__item">
				<p class="single-games__list-title list-title">
					Рейтинг
				</p>
				<p class="list__data">
					3 / <?php the_field('rating');?>
				</p>
			</div>
		</div>
	</div>
	<div class="single-games__col-12">
		<div class="single-amime__description">
				<p class="single-games__list-title list-title">
					Описание
				</p>
				<p class="">
					<?php the_field('description');?>
				</p>
			</div>
	</div>
</div>