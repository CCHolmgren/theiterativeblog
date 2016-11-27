<?php
namespace App;

class Route {
	static function redirectToRoot(){
		header("Location: " . "http://" . $_SERVER['HTTP_HOST']);	
		exit;
	}
	static function handle($routes){
		foreach($routes as $route => $handler){
			$route = str_replace("/", "\/", $route);
			$route = str_replace("*", "(.*)", $route);
			$route = "/" . $route . "/";
			if(preg_match($route, $_SERVER["REQUEST_URI"])){
				$handler();
				exit;
			}
		}
	}
	static function isPost(){
		return $_SERVER["REQUEST_METHOD"] === "POST";
	}
}