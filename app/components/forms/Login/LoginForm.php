<?php


namespace App\Components\Forms\Login;


use App\Components\Forms\BaseForm;
use Nette\Security\User;


class LoginForm extends BaseForm
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function render()
	{
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentLoginForm($name)
	{
		$form = $this->formFactory->create();
		$form->addText('username', 'Username')->setRequired();
		$form->addPassword('password', 'Password')->setRequired();
		$form->onSuccess[] = [$this, 'loginFormSucceed'];
		$form->addSubmit('submit', 'Login');
		return $form;
	}

	public function loginFormSucceed($form, $values)
	{
		dump($values);
		$this->user->login($values['username'], $values['password']);
		die();
	}
}