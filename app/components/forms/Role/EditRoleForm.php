<?php declare(strict_types = 1);


namespace App\Components\Forms\Role;


use App\Components\Forms\BaseForm;
use App\Model\Facade\RoleModel;


class EditRoleForm extends BaseForm
{
	private $roleModel;

	public function __construct(RoleModel $roleModel)
	{
		$this->roleModel = $roleModel;
	}

	public function render()
	{
		if ($this->id !== NULL) {
			$this->setEntityToForm($this->roleModel->getData($this->id), $this['editRoleForm']);
		}

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
		$values['createdBy'] = $this->user->getId();
		$this->roleModel->update((array)$values, $this->id);
		$this->getPresenter()->redirect('users');
	}
}