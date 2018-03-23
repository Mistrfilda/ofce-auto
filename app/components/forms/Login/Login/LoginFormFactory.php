<?php


namespace App\Components\Forms\Login;


interface LoginFormFactory
{
	/** @return LoginForm */
	public function create();
}