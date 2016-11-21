<article>
	<header>
		<h2><?= get($article["title"], "No title"); ?></h2>
		<span>Published <time><?= get($article["published"], ""); ?></time>.</span>
		<span>Changes since last post: <?= get($article["changes"], "none"); ?>.</span>
		<a href="?edit=<?= $name; ?>">Edit</a>
	</header>
	<div>
		<?= get($article["content"], "No content"); ?>
	</div>
	<footer>
		<p>Time to write: <?= get($article["write_time"], "0 minutes"); ?>.</p>
	</footer>
</article>