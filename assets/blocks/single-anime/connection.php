<div class="single-anime__block">
	<h2 class="title_line-bottom title">Связанное</h2>
	<div class="similar__items">
	<?php
	$similarPosts = $querySingle -> posts;
	if (count($similarPosts)) {
		for ($i=0; $i < count($similarPosts); $i++) {
		$similarPost = $similarPosts[$i];
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
	}
	else {
		?>
		<p class="similar__list-title_nothing">Нет связанного</p>
		<?php
	}
	?>
	</div>
</div>