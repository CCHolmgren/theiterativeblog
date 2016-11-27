<?php
namespace App\Models;

class Article {
	protected $article;

	function __construct($article){
		$this->article = json_decode($article, true);
	}

	function __get($name){
		return $this->article[$name];
	}

	static function all(){
		$articles = [];
		$prefix = "./articles/";
		$ending = ".json";
		foreach(glob($prefix . "*") as $filename){
			$articles[str_replace([$ending, $prefix], "", $filename)] = file_get_contents($filename);
		}
		krsort($articles);
		$articles = array_map(function($article){
			return new static($article);
		}, $articles);

		return $articles;
	}

	static function save($data, $chosenid) {
		$name = $chosenid ?: time();
		$data["name"] = $name;
		file_put_contents("./articles/" . $name . ".json", json_encode($data));
	}

	function render() {
		extract(['article' => $this]);

		include("views/partials/article.php");
	}
}