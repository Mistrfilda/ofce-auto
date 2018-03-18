<?php


namespace App\Components\Forms\User;


use App\Components\Forms\BaseForm;
use App\Model\UserGroupModel;
use App\Model\UserModel;


class EditUserForm extends BaseForm
{
	private $userModel;

	private $userGroupModel;

	public function __construct(UserModel $userModel, UserGroupModel $userGroupModel)
	{
		$this->userModel = $userModel;
		$this->userGroupModel = $userGroupModel;
	}

	public function render()
	{
		if ($this->id !== NULL) {
			$this->setEntityToForm($this->userModel->getData($this->id), $this['editUserForm'], ['password']);
		}

		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentEditUserForm($name)
	{
		$form = $this->formFactory->create();
		$form->addText('name', 'Name');
		$form->addText('email', 'Email');
		$form->addPassword('password', 'Password');
		$form->addMultiSelect('user_groups', 'User groups', $this->userGroupModel->getPairs());
		$form->onSuccess[] = [$this, 'editUserFormSucceed'];
		$form->addSubmit('save', 'Save');
		return $form;
	}

	public function editUserFormSucceed($form, $values)
	{
		$this->userModel->update((array)$values, $this->id);
	}
}