<?php 

class Base extends App
{
	protected $app;

	function __construct(){
		$this->app = parent::init()->run();
	}

	public function dashboard($value=''){
		echo $this::$app->render('dashboard.html', array('name' => 'Fabien'));
	}

	public function test($value='')
	{
		echo $this->app->render('test.html', array('name' => 'Fabien'));
	}
}