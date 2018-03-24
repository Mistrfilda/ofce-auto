<?php


namespace App\Components\Forms\UserGroup;


use App\Components\Forms\BaseForm;
use App\Model\UserGroupModel;
use Nette\Application\UI\Form;


class EditUserGroupForm extends BaseForm
{
	private $groupModel;

	public function __construct(UserGroupModel $groupModel)
	{
		$this->groupModel = $groupModel;
	}

	public function render()
	{
		if ($this->id !== NULL) {
			$this['editGroupForm']->setDefaults($this->groupModel->getData($this->id));
		}

		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentEditGroupForm()
	{
		$form = $this->formFactory->create();
		$form->addText('name', 'Name')->setRequired();
		$form->addTextArea('description', 'Description')->setRequired();
		$form->onSuccess[] = [$this, 'editGroupFormSucceed'];
		$form->addSubmit('submit', 'Save');
		return $form;
	}

	public function editGroupFormSucceed($form, $values)
	{
		$values['createdBy'] = $this->user->getId();
		$this->groupModel->update((array)$values, $this->id);
		$this->getPresenter()->redirect('users');
	}
}