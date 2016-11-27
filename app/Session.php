<?php
namespace App;

class Session {
	static function start(){
		session_start();
	}
	static function login(){
		if(isCorrectPassword(Request::post("password")) && isCorrectUsername(Request::post("username"))){
			$_SESSION["password"] = file_get_contents(".password");
		} 
		Route::redirectToRoot();
	}
	static function logout() {
		$_SESSION = [];
		session_destroy();
		Route::redirectToRoot();
	}
	static function isLoggedIn(){
		return isset($_SESSION["password"]) && $_SESSION["password"] == file_get_contents(".password");
	}
}