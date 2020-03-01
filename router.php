<?php

class Router{

	private $request;

	public function __construct($request){
		$this->request = $request;

	}

	public function get($route, $file){

		$uri = trim( $this->request);

		$uri = explode("/", $uri);
		
  		 $route = trim($route, "/");

		   array_shift($uri);

		if($uri[1] == $route) {
	
			 require __DIR__ . $file . '.php';
			} 
			
	}

}
?>
