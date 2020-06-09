<?php 

class App {
	
	const DEVELOPMENT = "development";
	const PRODUCTION = "production";

	protected $app;
	protected $config;

	function __construct(){
		$loader = new Twig_Loader_Filesystem('../src/views');
		$this->app = new Twig_Environment($loader, array(
		    'cache' => '../src/cache',
		));
	}

	function run($config){
		$this->config = $config;
		$this->app->addGlobal("url", $config->url);
	}

	function config(mixed $value){
		if(is_object($value)){
			$this->config = $value;
			return $this;
		}
		return $this->config->value ?? null;
	}

	function development(){
		return $this->config->environment === self::DEVELOPMENT;
	}
}