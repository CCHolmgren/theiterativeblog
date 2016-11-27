<article class="readable-width block-centered">
	<header>
		<h2><?= $article->title; ?></h2>
		<span>Published <time><?= $article->published; ?></time>.</span>
		<span>Changes since last post: <?= $article->changes; ?>.</span>
		<a href="?edit=<?= $article->name; ?>">Edit</a>
	</header>
	<div>
		<?= $article->content; ?>
	</div>
	<footer>
		<p>Time to write: <?= $article->write_time; ?>.</p>
	</footer>
</article>