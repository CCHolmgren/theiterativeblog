<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Iterative Blog</title>
	<link rel="stylesheet" href="/css/normalize.min.css">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<header>
		<h1 class="text-center">Iterative Blog</h1>	
		<?php if(\App\Session::isLoggedIn()){ ?>
			<p class="text-center">Logged in, you are!</p>
		<?php }?>
		<p class="text-center">The main focus of this is of the development of the blog itself, with the focus on good, usable, needed features. I do not want features that are just there for the sake of them being there. It might slowly go towards other things.</p>
	</header>
	<main>		
		<?php foreach($articles as $name => $article){
			$article->render($name);
		}?>
	</main>
	<aside class="sidebar lower-focus">
		<p>Want the code for this project? Please visit my Github-page at <a href="https://github.com/CCHolmgren/theiterativeblog">ccholmgren/theiterativeblog</a>.</p>
		<p>Want to know more about me? You can find my personal page at <a href="http://christofferholmgren.se/">http://christofferholmgren.se/</a>. It might be a little outdated, but it provides a decent overview over what I have accomplished so far!</p>
	</aside>
	<script src="/js/app.js"></script>
</body>
</html>