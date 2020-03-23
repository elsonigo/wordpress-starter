<?php get_header(); ?>

<section class="p-2">
	<h1 class="text-4xl">
		<?php echo the_title(); ?>
	</h1>
	<p class="text-xl max-w-md">
		Content
	</p>
	<div id="app" class="mt-4">
		<Notification />
	</div>
</section>

<?php get_footer(); ?>