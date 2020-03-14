<?php get_header(); ?>

<section class="p-2">

	<?php
	if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<h1 class="text-4xl">
				<?php echo the_title(); ?>
			</h1>
	<?php endwhile;
	endif;  ?>

	<p class="text-xl max-w-md">
		<?php echo get_field('main_content'); ?>
	</p>

</section>

<?php get_footer(); ?>