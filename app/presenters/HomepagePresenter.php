<?php

namespace App\Presenters;

use App\Components\Forms\Group\EditGroupFormFactory;
use App\Components\Forms\Group\EditUserGroupFormFactory;
use App\Components\Forms\User\EditUserFormFactory;
use App\Components\Grids\AppGrid;
use Nette;


class HomepagePresenter extends BasePresenter
{
	private $editUserGroupFormFactory;

	private $editUserFormFactory;

	public function __construct(EditUserGroupFormFactory $editUserGroupFormFactory, EditUserFormFactory $editUserFormFactory)
	{
		$this->editUserGroupFormFactory = $editUserGroupFormFactory;
		$this->editUserFormFactory = $editUserFormFactory;
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
