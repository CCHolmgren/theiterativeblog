<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>The Iterative Blog</title>
</head>
<body>
	<header>
		<h1>The Iterative Blog</h1>	
		<p>This is a blog about the development of this blog, among other things.</p>
		<?php if(\App\Session::isLoggedIn()){ ?>
			<form method="post" id="new-article" action="/new-article">
				<input type="hidden" value="<?= $chosenId; ?>" name="chosenid">
				<input type="text" name="data[title]" placeholder="Title" value="<?= $chosenData->title; ?>">
				<input type="text" name="data[published]" placeholder="Published" value="<?= $chosenData->published; ?>">
				<input type="text" name="data[changes]" placeholder="Changes" value="<?= $chosenData->changes; ?>">
				<input type="text" name="data[write_time]" placeholder="Time to write" value="<?= $chosenData->write_time; ?>">
				<textarea name="data[content]" placeholder="Content"><?= $chosenData->content; ?></textarea>
				<?php if($chosenId) { ?><a href="/">Stop editing</a><?php }?>
				<input type="submit">
			</form>
			<form method="post" action="/logout">
				<input type="submit" value="Logout">
			</form>
		<?php } else { ?>
			<form method="post" action="/login">
				<input type="text" placeholder="Username" name="username">
				<input type="password" placeholder="Password" name="password">
				<input type="submit" value="Login">
			</form>
		<?php } ?>
	</header>
	
	<?php foreach($articles as $name => $article){
		$article->render($name);
	}?>
	<footer>
		<p>Want the code for this project? Please visit my Github-page at <a href="https://github.com/CCHolmgren/theiterativeblog">ccholmgren/theiterativeblog</a>.</p>
		<p>Want to know more about me? You can find my personal page at <a href="http://christofferholmgren.se/">http://christofferholmgren.se/</a>. It might be a little outdated, but it provides a decent overview over what I have accomplished so far!</p>
	</footer>
	<script src="/js/app.js"></script>
</body>
</html>