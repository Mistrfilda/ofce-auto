<?php


namespace App\Components\Forms\Role;


use App\Components\Forms\BaseForm;
use App\Model\RoleModel;


class EditRoleForm extends BaseForm
{
	private $roleModel;

	public function __construct(RoleModel $roleModel)
	{
		$this->roleModel = $roleModel;
	}

	public function render()
	{
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentEditRoleForm($name)
	{
		$form = $this->formFactory->create();
		$form->addText('name', 'Name')->setRequired();
		$form->addTextArea('description', 'Description');
		$form->onSuccess[] = [$this, 'editRoleFormSucceed'];
		$form->addSubmit('submit', 'Save');
		return $form;
	}

	public function editRoleFormSucceed($form, $values)
	{
		$this->roleModel->update((array)$values, $this->id);
	}
}