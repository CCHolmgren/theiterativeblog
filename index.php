<?php

chdir(__DIR__);

use App\Session;
use App\Route;
use App\Models\Article;
use App\Request;

include("./helpers.php");

spl_autoload_register(function($name){
	$name = str_replace("\\", '/', $name);
	$name = str_replace("App/", "", $name);
	$name = "./app/$name.php";

	if(file_exists($name)){
		include($name);
	}
});

Session::start();

function handleDefaultRoute(){
	$articles = Article::all();
	$chosenId = "";
	$chosenData = new stdClass();
	$vals = ['title' => '','published' => date('Y-m-d H:i'), 'changes' => 'miniscule', 'write_time' => '0 minutes', 'content' => ''];
	foreach($vals as $key => $val){
		$chosenData->$key = $val;
	}
	if(isset($_GET["edit"])){
		$edit = Request::get("edit");
		$chosenId = $edit;
		$chosen = $articles[$edit];
		$chosenData = $chosen;
	}
	return view("layouts/base", ['articles' => $articles, 'chosenData' => $chosenData, 'chosenId' => $chosenId]);
}
function handleNewArticle(){
	if(Session::isLoggedIn()){
		Article::save(Request::post("data"), Request::post("chosenid"));
	}
	Route::redirectToRoot();
}
$routes = [
	"/login" => function(){
		if(Request::getMethod() == "POST"){
			Session::login();
		}
		return view("login");
	},
	"/logout" => function(){
		Session::logout();
	},
	"/new-article" => function(){
		if(!Session::isLoggedIn()){
			Route::redirectToRoot();
		}
		if(Request::getMethod() == "POST"){
			handleNewArticle();
		}
		$articles = [];
		$chosenId = "";
		$chosenData = new stdClass();
		$vals = ['title' => '','published' => date('Y-m-d H:i'), 'changes' => 'miniscule', 'write_time' => '0 minutes', 'content' => ''];
		foreach($vals as $key => $val){
			$chosenData->$key = $val;
		}
		return view("new-article", ['articles' => $articles, 'chosenData' => $chosenData, 'chosenId' => $chosenId]);
	},
	"*" => "handleDefaultRoute"
];
Route::handle($routes);