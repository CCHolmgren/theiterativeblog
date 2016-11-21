<?php
function get(&$index, $default = ""){
	return $index ?: $default;
}
function isCorrectPassword($password){
	return password_verify($password, file_get_contents(".password"));
}
function renderArticle($name, $article){
	$article = json_decode($article, true); 

	include("../views/article.php");
}
function getArticles(){
	$articles = [];
	$prefix = "../articles/";
	$ending = ".json";
	foreach(glob($prefix . "*") as $filename){
		$articles[str_replace([$ending, $prefix], "", $filename)] = file_get_contents($filename);
	}
	krsort($articles);
	return $articles;
}
function saveArticle($data, $chosenid){
	$name = $chosenid ?: time();
	file_put_contents("../articles/" . $name . ".json", json_encode($data));
}
function isPost(){
	return $_SERVER["REQUEST_METHOD"] === "POST";
}
if(isPost() && isCorrectPassword($_POST["password"])){
	saveArticle($_POST["data"], $_POST["chosenid"]);
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	
	exit;
}
$articles = getArticles();
$chosenId = "";
$chosenData = ['title' => '','published' => date('Y-m-d H:i'), 'changes' => 'miniscule', 'write_time' => '0 minutes', 'content' => ''];
if(isset($_GET["edit"])){
	$chosenId = $_GET["edit"];
	$chosen = $articles[$_GET["edit"]];
	$chosenData = json_decode($chosen, true);
}

include("../views/layouts/base.php");