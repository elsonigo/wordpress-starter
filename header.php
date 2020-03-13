<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="format-detection" content="telephone=no">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<header class="page-header">
			<h1><a href="<?php bloginfo('wpurl'); ?>"><?= get_bloginfo('name'); ?></a></h1>
			<nav class="main-nav">
				<ul>
					<?php wp_list_pages('&title_li='); ?>
				</ul>
			</nav>
		</header>
		<main>