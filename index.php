<?php

use App\Session;
use App\Route;
use App\Models\Article;
use App\Request;

chdir(__DIR__);

spl_autoload_register(function($name){
	$name = str_replace("\\", '/', $name);
	$name = str_replace("App/", "", $name);
	$name = "./app/$name.php";

	if(file_exists($name)){
		include($name);
	}
});

include("./helpers.php");

Session::start();
$routes = [
	"/login" => function(){
		if(Session::isLoggedIn()){
			Route::redirectToRoot();
		}
		if(Request::getMethod() == "POST"){
			Session::login();
		}
		return view("login.html");
	},
	"/logout" => function(){
		Session::logout();
	},
	"/delete/(?P<id>\d+)" => function($matches){
		if(!Session::isLoggedIn()){
			Route::redirectToRoot();
		}
		$id = $matches["id"];
		$articles = Article::all();
		$article = $articles[$id];
		if(Request::getMethod() == "POST"){	
			$article->delete();

			Route::redirectToRoot();	
		}
		return view("delete-article.html", ['article' => $article]);
	},
	"/edit/(?P<id>\d+)" => function($matches){
		if(!Session::isLoggedIn()){
			Route::redirectToRoot();
		}
		$id = $matches["id"];
		$articles = Article::all();
		$chosenData = new stdClass();
		$vals = Article::getDefaultValues();
		foreach($vals as $key => $val){
			$chosenData->$key = $val;
		}
		if(isset($id)){
			$chosenData = $articles[$id];
		}
		return view("new-article.html", ['chosenData' => $chosenData, 'chosenId' => $id]);
	},
	"/new-article" => function(){
		if(!Session::isLoggedIn()){
			Route::redirectToRoot();
		}
		if(Request::getMethod() == "POST"){
			if(Session::isLoggedIn()){
				Article::save(Request::post("data"), Request::post("chosenid"));
			}
			Route::redirectToRoot();
		}
		$vals = Article::getDefaultValues();

		return view("new-article.html", ['chosenData' => $vals, 'chosenId' => ""]);
	},
	"/" => function(){
		$articles = Article::all();
		$chosenId = "";
		$chosenData = new stdClass();
		$vals = Article::getDefaultValues();
		foreach($vals as $key => $val){
			$chosenData->$key = $val;
		}
		if(isset($_GET["edit"])){
			$edit = Request::get("edit");
			$chosenId = $edit;
			$chosen = $articles[$edit];
			$chosenData = $chosen;
		}
		return view("articles.html", ['articles' => $articles]);
	},
	"*" => function(){
		http_response_code(404);

		return view("errors/404.html");
	}
];
echo Route::handle($routes);