<?php
namespace App;

class Request {
	static function post($key = null) {
		if($key){
			return $_POST[$key];
		}
		return $_POST;
	}
	static function get($key = null) {
		if($key){
			return $_GET[$key];
		}
		return $_GET;
	}
	static function getMethod(){
		return $_SERVER["REQUEST_METHOD"];
	}
}