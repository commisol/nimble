<?php 

class Loader{
	
	static function load($class){
		if(include_once APPROOT.'src/controllers/' . $class . '.php')
			return new $class;
	}
}