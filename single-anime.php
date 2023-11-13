<?php
/*
Template Name: Single anime
*/
?>
<?php get_header();?>
<main>
	<section class="single-anime">
		<div class="single-anime__container container">
			<?php
				$currentSerial = get_field('serial');
				$querySingle = new WP_Query([
					'post_type' => 'anime',
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
				<?php include "assets/blocks/single-anime/info.php" ?>
				<?php include "assets/blocks/single-anime/connection.php" ?>
				<?php include "assets/blocks/single-anime/shots.php" ?>
				<?php include "assets/blocks/single-anime//trailer.php" ?>
			<?php endwhile; else : ?>
				<p>Записей нет.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

