<?php
	$image = get_field('tileimage');
?>
<div class="entry">
	<h2><?php the_title();?></h2>
	<figure>
		<img class="lazyload" src="<?php echo $image['sizes']['thumbnail']; ?>" data-src="<?php echo $image['sizes']['large']; ?>" data-srcset="<?php echo $image['sizes']['medium']; ?> 800w, <?php echo $image['sizes']['large']; ?> 1600w" data-sizes="(min-width: 800px) 22vw, 92vw" alt="<?php echo $image['alt']; ?>">
		<figcaption>
			<?php echo $image['caption']; ?>
		</figcaption>
	</figure>
</div>