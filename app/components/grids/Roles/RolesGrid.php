<?php


namespace App\Components\Grids\Roles;


use App\Components\Grids\AppGrid;
use App\Components\Grids\BaseGrid;
use App\Model\Facade\RoleModel;


class RolesGrid extends BaseGrid
{
	/** @var  RoleModel */
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

	public function createComponentRolesGrid($name) : AppGrid
	{
		$grid = $this->gridFactory->create();
		$grid->setDataSource($this->roleModel->getQueryBuilder());
		$grid->addColumnText('name', 'Name');
		$grid->addColumnText('description', 'Description');
		$grid->addColumnText('createdBy', 'Created by', 'createdBy.username');
		$grid->addAction('edit-role', 'Edit role', 'System:editRole', ['id' => 'id'])
			->setClass('btn btn-primary')
			->setIcon('arrow-right');
		return $grid;
	}

}