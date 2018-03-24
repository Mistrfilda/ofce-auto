<?php


namespace App\Components\Grids\Users;


use App\Components\Grids\BaseGrid;
use App\Model\UserModel;


class UsersGrid extends BaseGrid
{
	private $userModel;

	public function __construct(UserModel $userModel)
	{
		$this->userModel = $userModel;
	}

	public function render()
	{
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}

	public function createComponentUsersGrid($name)
	{
		$grid = $this->gridFactory->create();
		$grid->setDataSource($this->userModel->getQueryBuilder());
		$grid->addColumnText('username', 'Username');
		$grid->addColumnText('name', 'Name');
		$grid->addColumnText('email', 'Email');
		$grid->addColumnText('role', 'Role', 'role.name');
		$grid->addAction('edit-user', 'Edit user', 'System:editUser', ['id' => 'id'])
			->setClass('btn btn-primary')
			->setIcon('arrow-right');
		return $grid;
	}

}