<?php
function isCorrectPassword($password){
	return password_verify($password, file_get_contents(".password"));
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
	</header>
	<article>
		<header>
			<h2>First feature considerations</h2>
			<span>Published <time>2016-11-17 18:36</time></span>
			<span>Changes since last post: none.</span>
		</header>
		<div>
			<p>
				So far I have only written static html inside the base index.php file. 
				In the beginning writing the static html is fine, since it just means that there is no overhead at all. 
				But as time moves on this will not be feasible, and will prevent me from implementing all types of features that might come in handy, such as a way to actually write an article without having to edit this file every single time, or editing the templates of the articles without having to manually edit them, one by one.</p>
			<p>
				This is the time where I will consider how to implement the "write article" feature. What I want to have is a feature that is as simple as possible, that won't mean that I will have to change a lot of features in the future.
			</p>
			<p>Some different ways that you might do it is:</p>
			<dl>
				<dt>Storing the articles in a SQL database</dt>
				<dd>Whilst this probably is the destination that I will arrive at, sometime, I do not feel that it is necessary at this time. Having a database means that you need to actually have a database running (or use SQLite) and that requires a schema, having a database connection in the code, and actually writing SQL. Since I am a fan of the active record paradigm, I will probably use that sometime in the future, but at this moment this is just way to over engineered to be any useful for me.</dd>

				<dt>Storing the articles in some other database</dt>
				<dd>Like with the SQL database this is also too complicated for what I will be using it for. It also requires some kind of daemon running in the background, which is wholly unnecessary if I'm just going to store articles in them.</dd>

				<dt>Loading the articles from separate files</dt>
				<dd>Separate files feels way more compelling when compared to storing them in a database. This way it is very easy to add a new article, just create a new file in a folder somewhere, and it instantly gets rendered to the screen with all other articles. What I can see as a problem with this approach is that, how do you store data about the article, such as title, published date, changes since last article, and how long it took to write? If I am going to separate template and content from eachother, how will I map it out? On way would be to differentiate it based on lines, line 1 corresponds to the title and so on. That will however, bring a major problem if I every decide that I want to change something, like add an extra field, since old files will have to be edited for the lines to not be mixed up. Another way could be to store the content in a json object, so that it is as simple as <code>json_decode</code> to get the values that I need. This way I do not have to worry about ever adding a field.</dd>

				<dt>Loading the articles from a single file</dt>
				<dd>Piggybacking on the last line of the previous way, I could also store every article as a separate object in an json array. This means that everything is contained in a single file, and theoretically it could maybe be a little faster to do it this way than to use multiple files. However, the big problem I see with this is that it just doesn't feel like a nice solution. It is a very bad justification for not using this solution, but it is enough for me not to choose it at this time.</dd>
			</dl>
			
			<p>With that said, how will I actually implement the posting of articles?</p>
			<ol>
				<li>Add a form somewhere on the page, that is password protected of course.</li>
				<li>On post, the page will check that the password is correct (it will be a hardcoded password for now, stored in some .gitignored file), and then store the data from the form in a new file, with a json encoded object.</li>
				<li>Every time the page is rendered the page will fetch all articles and render them with a fixed template that is not bound to the article.</li>
			</ol>
		</div>
		<footer>
			<p>Time to write: 54 minutes.</p>
		</footer>
	</article>
	<article>
		<header>
			<h2>Added a changes since last post "tag"</h2>
			<span>Published <time>2016-11-16 20:08</time>.</span>
			<span>Changes since last post: miniscule.</span>
		</header>
		<div>
			<p>My intention is for all changes to be documented here. This means that even small or even miniscule changes will end up in a post, in it's own or in one documenting several such changes.</p>
			<p>With all changes being documented, there might be a need for them to be categorized some way. If you're only interested in the large ones, then a miniscule change might not be of interest. That's why I added the "Changes since last post" "tag" to the header of every post. It is a very subjective categorization, not based on anything other than what I think that it should be called, subjectivity is all around us, embrace it.</p>
			<p>I also changed the blog header, I added the "among other things" part. Sometime in the future, when it is necessary, this header might include more things, but this will suffice for now.</p>
		</div>
		<footer>
			<p>Time to write: 4 minutes.</p>
		</footer>
	</article>
	<article>
		<header>
			<h2>An update on the last post</h2>
			<span>Published <time>2016-11-16 19:54</time>.</span>
			<span>Changes since last post: small.</span>
		</header>
		<div>
			<p>I forgot to mention some things in the last post, that I think are important to this whole picture.</p>
			<p>Since this is <i>The Iterative Blog</i>, I will keep iterating on both blog posts, and the layout, structure and everything in between. I will try to improve on everything that I can improve on. To do this I will use different tools, such as the W3C HTML Validator, PageSpeed, and other tools to measure and quantify what there is to be improved, and what works well.</p>
			<p>In the beginning I will not include anything that isn't strictly necessary, no jQuery, no Foundation or Bootstrap, no Googly Analytics, nothing. However, some of these might come in handy later on, and I might use them if I deem them to be a net positive.</p>
			<p>Since the last post I ran the W3C Validator and have changed some tiny things that it did not agree on. This is to avoid all of the problems that improper markup can have on the page. If the goal is to have a great product, every part of it must be great, not just the visual, the content or the backend.</p>
			<p>This is the first blog that I have some kind of goal with, I've had other before but none of them save any kind of long lived commitment, so this time I might be able to keep this up a little longer. It will also be a great way to improve my written english.</p>
		</div>
		<footer>
			<p>Time to write: 12 minutes.</p>
		</footer>
	</article>
	<article>
		<header>
			<h2>Baby steps towards something new</h2>
			<span>Published <time>2016-11-16 19:22</time>.</span>
			<span>Changes since last post: groundbreaking.</span>
		</header>
		<div>
			<p>The intention with this blog is to document the development of a platform, or something of that effect, for blogging. 
				It will strive to be as close as possible to the MVP (Minimum Viable Product), without any bloat or feature creep. 
				What I mean with that is that no feature will be added, unless it is needed at that moment, nothing will be loaded, unless it is necessary for a better product, a better blogging experience or a better use experience.
			</p>
			<p>This project aims to be a challenge for me: limiting which features I include in my projects. As a developer it is very easy to let the features pile on, until you got something that is many many times greater than what you imagined from the beginning. I find that adding a lot of features to the todo list makes it a lot harder just to finish one of the items. So this will be a challenge to do the opposite, limit them as much as possible. <br>
				What I hope that this will mean for me in the long run is a better focus on the main problem that I am trying to solve, instead of growing the project in size and difficulty without any real use.
			</p>
			<p>
				At this moment, there is nothing but a very basic html page here. Nothing dynamic, no CSS, no Javascript, nothing like that. In the end, I hope to end up with a product; where I can easily publish a blogpost, where I do not have to write all the actual html by hand, that looks good, that is responsive, that loads fast and everything else that you would hope every page would have.
			</p>
			<p>I hope that I do not end up with bloat, slow loading or anything other negative.</p>
		</div>
		<footer>
			<p>Time to write: 28 minutes.</p>
		</footer>
	</article>
	<footer>
		<p>Want the code for this project? Please visit my Github-page at <a href="https://github.com/CCHolmgren/theiterativeblog">ccholmgren/theiterativeblog</a>.</p>
		<p>Want to know more about me? You can find my personal page at <a href="http://christofferholmgren.se/">http://christofferholmgren.se/</a>. It might be a little outdated, but it provides a decent overview over what I have accomplished so far!</p>
	</footer>
</body>
</html>