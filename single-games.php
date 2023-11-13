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
				<?php include "assets/blocks/single-games/info.php" ?>
				<?php include "assets/blocks/single-games/connection.php" ?>
				<?php include "assets/blocks/single-games/shots.php" ?>
				<?php include "assets/blocks/single-games//trailer.php" ?>
			<?php endwhile; else : ?>
				<p>Записей нет.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

