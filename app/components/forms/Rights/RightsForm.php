<?php declare(strict_types = 1);


namespace App\Components\Forms\Rights;


use App\Components\Forms\BaseForm;
use App\Model\Database\Entity\Role;
use App\Model\Facade\RightModel;
use App\Model\Facade\RoleModel;
use Nette\Forms\Form;


class RightsForm extends BaseForm
{
	private $roleModel;

	private $rightModel;

	public function __construct(RoleModel $roleModel, RightModel $rightModel)
	{
		$this->roleModel = $roleModel;
		$this->rightModel = $rightModel;
	}

	public function render()
	{
		$this['rightForm']->setDefaults($this->roleModel->getRolesRights());
		$this->getTemplate()->roles = $this->roleModel->getPairs();
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentRightForm()
	{
		$roles = $this->roleModel->getPairs();
		$rights = $this->rightModel->getPairs();


		$form = $this->formFactory->create();

		/** @var Role $role */
		foreach ($roles as $id => $role) {
			$form->addCheckboxList($id, $role, $rights);
		}

		$form->onSuccess[] = [$this, 'rightsFormSucceed'];
		$form->addSubmit('submit', 'Save');

		return $form;
	}

	public function rightsFormSucceed(Form $form, array $values)
	{
		foreach ($values as $role => $rights) {
			$this->roleModel->setRoleRights($role, $rights);
		}
	}
}