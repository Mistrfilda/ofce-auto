<?php


namespace App\Presenters;


use App\Components\Forms\Login\LoginFormFactory;
use App\Components\Forms\Login\RegistrationFormFactory;


class LoginPresenter extends BasePresenter
{
	/** @persistent */
	public $backlink = '';

	private $loginFormFactory;

	private $registrationFormFactory;

	public function __construct(LoginFormFactory $loginFormFactory, RegistrationFormFactory $registrationFormFactory)
	{
		$this->loginFormFactory = $loginFormFactory;
		$this->registrationFormFactory = $registrationFormFactory;
	}

	public function createComponentLoginForm()
	{
		return $this->loginFormFactory->create();
	}

	public function createComponentRegistrationForm($name)
	{
		return $this->registrationFormFactory->create();
	}
}