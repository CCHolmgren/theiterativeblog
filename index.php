<?php
function get(&$index, $default = ""){
	return $index ?: $default;
}
function isCorrectPassword($password){
	return password_verify($password, file_get_contents(".password"));
}
function renderArticle($article){
	$article = json_decode($article, true); ?>
<article>
	<header>
		<h2><?= get($article["title"], "No title"); ?></h2>
		<span>Published <time><?= get($article["published"], ""); ?></time>.</span>
		<span>Changes since last post: <?= get($article["changes"], "none"); ?>.</span>
	</header>
	<div>
		<?= get($article["content"], "No content"); ?>
	</div>
	<footer>
		<p>Time to write: <?= get($article["write_time"], "0 minutes"); ?>.</p>
	</footer>
</article>
<?php 
}
function getArticles(){
	$articles = [];
	$prefix = "articles/";
	$ending = ".json";
	foreach(glob($prefix . "*") as $filename){
		$articles[str_replace([$ending, $prefix], "", $filename)] = file_get_contents($filename);
	}
	ksort($articles);
	return array_reverse($articles);
}
function saveArticle($data){
	file_put_contents("articles/" . time() . ".json", json_encode($data));
}
function isPost(){
	return $_SERVER["REQUEST_METHOD"] === "POST";
}
if(isPost() && isCorrectPassword($_POST["password"])){
	saveArticle($_POST["data"]);
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	
	exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Test</title>
</head>
<body>
	<header>
		<h1>The Iterative Blog</h1>	
		<p>This is a blog about the development of this blog, among other things.</p>
		<form method="post">
			<input type="password" name="password" placeholder="Password">
			<input type="text" name="data[title]" placeholder="Title">
			<input type="text" name="data[published]" placeholder="Published">
			<input type="text" name="data[changes]" placeholder="Changes">
			<input type="text" name="data[write_time]" placeholder="Time to write">
			<textarea name="data[content]" placeholder="Content"></textarea>
			<input type="submit">
		</form>
	</header>
	
	<?php foreach(getArticles() as $article){
		renderArticle($article);
	}?>
	<footer>
		<p>Want the code for this project? Please visit my Github-page at <a href="https://github.com/CCHolmgren/theiterativeblog">ccholmgren/theiterativeblog</a>.</p>
		<p>Want to know more about me? You can find my personal page at <a href="http://christofferholmgren.se/">http://christofferholmgren.se/</a>. It might be a little outdated, but it provides a decent overview over what I have accomplished so far!</p>
	</footer>
</body>
</html>