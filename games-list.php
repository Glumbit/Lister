<?php
/*
Template Name: Games List
*/
?>
	<?php 
	get_header();
	?>
	<main>
		<h1><?php 
		if(get_the_title() == "Games List"){
			echo 'awdadawd';
		}
		else {
			echo '12321312';
		} ?></h1>
	</main>
	<?php get_footer(); ?>