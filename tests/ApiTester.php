<?php

use Faker\Faker as Faker;

class ApiTester extends TestCase{
	protected $faker;

	function __construct(){
		$this->faker = Faker::create();
	}

}