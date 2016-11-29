<?php
use App\Session;

require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

function isLoggedIn(){
	return Session::isLoggedIn();
}

function twig() {
	static $twig;
	$loader = new Twig_Loader_Filesystem('./views');
	$twig = new Twig_Environment($loader, [
		'debug' => true
	]);
	$twig->addExtension(new Twig_Extension_Debug());

	$twig->addGlobal("Session", new Session);
	return $twig;
}
function get(&$index, $default = ""){
	return $index ?: $default;
}

function isCorrectUsername($username){
	return $username == file_get_contents(".username");
}
function isCorrectPassword($password){
	return password_verify($password, file_get_contents(".password"));
}
function view($route, $variables = []){
	return twig()->render($route, $variables);
}