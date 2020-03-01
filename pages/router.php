<?php

class Router{

	private $request;

	public function __construct($request){
		$this->request = $request;
	}

	public function get($route, $file){

		$uri = trim( $this->request, "/" );

		$uri = explode("/", $uri);
		// var_dump($uri);
		$route = trim($route, "/");
		var_dump($route);
		if($uri[0] == trim($route, "/")){

			array_shift($uri);
var_dump($uri);
			// $args = $uri;

			require __DIR__ . $file . '.php';

		}

	}

}