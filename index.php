<?php get_header(); ?>

<section>
	<h1>Index</h1>
	<div x-data="{ open: false }">
		<button @click="open = true"
		class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
			Button
		</button>
		<ul x-show="open" @click.away="open = false">
			Dropdown Body
		</ul>
	</div>
</section>

<?php get_footer(); ?>