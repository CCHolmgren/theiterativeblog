<?php

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
	extract($variables);
	include("views/" . $route . ".php");
	exit;
}