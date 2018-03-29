<?php


namespace App\Components\Forms\Login;


use App\Components\Forms\BaseForm;
use App\Model\Database\Entity\User;
use App\Model\Facade\RegistrationModel;
use Nette\Forms\Form;


class RegistrationForm extends BaseForm
{
	private $registrationFacade;

	public function __construct(RegistrationModel $registrationFacade)
	{
		$this->registrationFacade = $registrationFacade;
	}

	public function render()
	{
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentRegistrationForm($name)
	{
		$form = $this->formFactory->create();
		$form->addText('name', 'Name')->setRequired();
		$form->addText('username', 'Username')->setRequired();
		$form->addText('email', 'Email')->setRequired()->addRule(Form::EMAIL);
		$form->addPassword('password', 'Password')->setRequired();
		$form->onSuccess[] = [$this, 'registrationFormSucceed'];
		$form->addSubmit('submit', 'Submit');
		return $form;
	}

	public function registrationFormSucceed($form, $values)
	{
		$this->registrationFacade->register((array)$values);
		$this->getPresenter()->redirect('Homepage:default');
	}

}