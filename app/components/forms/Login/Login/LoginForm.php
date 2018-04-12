<?php declare(strict_types = 1);


namespace App\Components\Forms\Login;


use App\Components\Forms\BaseForm;
use App\Lib\AppException;
use App\Lib\ErrorCodes;
use Nette\Forms\Form;
use Nette\Security\User;


class LoginForm extends BaseForm
{
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

	public function loginFormSucceed(Form $form, $values)
	{
		try {
			$this->user->login($values['username'], $values['password']);
		} catch (AppException $e) {
			if ($e->getCode() === ErrorCodes::UNKNOWN_LOGIN) {
				$this->getPresenter()->flashMessage('Unknown login', 'danger');
				return;
			}

			throw $e;
		}

		$this->logger->channel('login');
		$this->logger->addInfo('User login', ['username' => $values['username']]);

		if ($this->getPresenter()->getParameter('backlink') !== NULL) {
			$this->getPresenter()->restoreRequest($this->getPresenter()->getParameter('backlink'));
		}

		$this->getPresenter()->redirect('Homepage:default');
	}
}