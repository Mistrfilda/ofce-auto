<?php

namespace App\Presenters;

use App\Components\Forms\Group\EditGroupFormFactory;
use App\Components\Forms\Group\EditUserGroupFormFactory;
use App\Components\Forms\Login\LoginFormFactory;
use App\Components\Forms\Role\EditRoleFormFactory;
use App\Components\Forms\User\EditUserFormFactory;
use App\Components\Grids\AppGrid;
use App\Model\RightModel;
use Nette;


class HomepagePresenter extends SecurePresenter
{
	private $editUserGroupFormFactory;

	private $editUserFormFactory;

	private $editRoleFormFactory;

	private $loginFormFactory;

	public function __construct(EditUserGroupFormFactory $editUserGroupFormFactory, EditUserFormFactory $editUserFormFactory, EditRoleFormFactory $editRoleFormFactory, LoginFormFactory $loginFormFactory)
	{
		$this->editUserGroupFormFactory = $editUserGroupFormFactory;
		$this->editUserFormFactory = $editUserFormFactory;
		$this->editRoleFormFactory = $editRoleFormFactory;
		$this->loginFormFactory = $loginFormFactory;
	}

	public function createComponentEditUserForm($name)
	{
		$control = $this->editUserFormFactory->create();
		$control->setId($this->getParameter('id'));
		return $control;
	}

	public function createComponentEditGroupForm($name)
	{
		$control = $this->editUserGroupFormFactory->create();
		$control->setId($this->getParameter('id'));
		return $control;
	}

	public function createComponentEditRoleFormFactory($name)
	{
		$control = $this->editRoleFormFactory->create();
		$control->setId($this->getParameter('id'));
		return $control;
	}

	public function createComponentLoginForm($name)
	{
		return $this->loginFormFactory->create();
	}


	public function createComponentGrid($name)
	{
		$grid = new AppGrid();
		$grid->setPrimaryKey('id');
		$grid->setDataSource([['id' => 1, 'name' => 'karel'], ['id' => 2, 'name' => 'pepa']]);
		$grid->addColumnText('id', 'ID');
		$grid->addColumnText('name', 'Name');
		$grid->addFilterDate('id', 'test');
		return $grid;
	}


	public function renderEditGroup($id)
	{
	}
}
