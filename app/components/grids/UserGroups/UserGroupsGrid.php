<?php declare(strict_types = 1);


namespace App\Components\Grids\UserGroups;


use App\Components\Grids\AppGrid;
use App\Components\Grids\BaseGrid;
use App\Model\Facade\UserGroupModel;


class UserGroupsGrid extends BaseGrid
{
	private $userGroupModel;

	public function __construct(UserGroupModel $userGroupModel)
	{
		$this->userGroupModel = $userGroupModel;
	}

	public function render()
	{
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentUserGroupsGrid() : AppGrid
	{
		$grid = $this->gridFactory->create();
		$grid->setDataSource($this->userGroupModel->getQueryBuilder());
		$grid->addColumnText('name', 'Name');
		$grid->addColumnText('description', 'Description');
		$grid->addColumnText('createdBy', 'Created by', 'createdBy.username');
		$grid->addAction('edit-user', 'Edit user group', 'System:editUserGroup', ['id' => 'id'])
			->setClass('btn btn-primary')
			->setIcon('arrow-right');
		return $grid;
	}
}