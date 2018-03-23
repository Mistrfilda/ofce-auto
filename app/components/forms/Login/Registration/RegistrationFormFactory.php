<?php


namespace App\Components\Forms\Login;


interface RegistrationFormFactory
{
	/** @return RegistrationForm */
	public function create();
}