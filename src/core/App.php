<?php 
use \Twig\Environment AS TwigEnvironment;
use \Twig\Loader\FilesystemLoader;

class App {
	
	const DEVELOPMENT = "development";
	const PRODUCTION = "production";

	private static $app = null;
	
	private $config;
	protected $twig;

	function __construct($config){
		$this->config = $config;
		$loader = new FilesystemLoader('../src/views');
		$this->twig = new TwigEnvironment($loader, array(
		    'cache' => '../src/cache',
		    'debug' => $config->environment === self::DEVELOPMENT
		));
		$this->twig->addGlobal("url", $config->url);
	}

	function run($value=''){
		return $this->twig;
	}

	static function init($config = null){

		if(self::$app == null){
			self::$app = new App($config);
		}
		return self::$app;
	}

	function configure(mixed $value){
		if(is_object($value)){
			$this->config = $value;
			return $this;
		}
		return $this->config->value ?? null;
	}

	static function development(){
		return self::$config->environment === self::DEVELOPMENT;
	}
}