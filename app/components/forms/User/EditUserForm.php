<?php


namespace App\Components\Forms\User;


use App\Components\Forms\BaseForm;
use App\Model\RoleModel;
use App\Model\UserGroupModel;
use App\Model\UserModel;


class EditUserForm extends BaseForm
{
	private $userModel;

	private $userGroupModel;

	private $roleModel;

	public function __construct(UserModel $userModel, UserGroupModel $userGroupModel, RoleModel $roleModel)
	{
		$this->userModel = $userModel;
		$this->userGroupModel = $userGroupModel;
		$this->roleModel = $roleModel;
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
		$form->addText('name', 'Name')->setRequired();
		$form->addText('username', 'Username')->setRequired();
		$form->addText('email', 'Email')->setRequired();
		$form->addPassword('password', 'Password')->setNullable();
		$form->addMultiSelect('user_groups', 'User groups', $this->userGroupModel->getPairs());
		$form->addSelect('role', 'User role', $this->roleModel->getPairs())->setRequired();
		$form->onSuccess[] = [$this, 'editUserFormSucceed'];
		$form->addSubmit('save', 'Save');
		return $form;
	}

	public function editUserFormSucceed($form, $values)
	{
		if ($values['password'] === NULL) {
			unset($values['password']);
		}
		$this->userModel->update((array)$values, $this->id);
		$this->getPresenter()->redirect('System:users');
	}
}