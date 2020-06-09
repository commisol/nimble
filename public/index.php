<?php


set_include_path("../");

# Vendors
require_once "vendor/autoload.php";


	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
# Core Classes
require_once "src/core/Router.php";
require_once "src/core/Loader.php";
require_once "src/core/App.php";

# Configuration
require_once "src/config/config.php";

# Autoload Classes
spl_autoload_register("Loader::load");

# Constants
const APPROOT = __DIR__."/../";

		//var_dump($config);

# Run Application
App::init($config);

# Start Router
Router::init();
/*
if($app->development()){
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
}*/

?>