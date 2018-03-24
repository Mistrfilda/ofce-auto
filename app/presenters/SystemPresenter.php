<?php


namespace App\Presenters;


use App\Components\Forms\Group\EditUserGroupFormFactory;
use App\Components\Forms\Rights\RightsFormFactory;
use App\Components\Forms\User\EditUserFormFactory;
use App\Components\Grids\UserGroups\UserGroupsGridFactory;
use App\Components\Grids\Users\UsersGridFactory;
use App\Lib\Rights;
use Tracy\Debugger;


class SystemPresenter extends SecurePresenter
{
	private $rightsFormFactory;

	private $usersGridFactory;

	private $editUserFormFactory;

	private $userGroupsGridFactory;

	private $editUserGroupFormFactory;

	public function __construct(RightsFormFactory $rightsFormFactory, UsersGridFactory $usersGridFactory, EditUserFormFactory $editUserFormFactory, UserGroupsGridFactory $userGroupsGridFactory, EditUserGroupFormFactory $editUserGroupFormFactory)
	{
		$this->rightsFormFactory = $rightsFormFactory;
		$this->usersGridFactory = $usersGridFactory;
		$this->editUserFormFactory = $editUserFormFactory;
		$this->userGroupsGridFactory = $userGroupsGridFactory;
		$this->editUserGroupFormFactory = $editUserGroupFormFactory;
	}


	public function renderRights()
	{
//		if ($this->getUser()->isAllowed(Rights::SYSTEM)) {
//			dump('bbb');
//			die();
//		}
	}

	public function createComponentRightsForm()
	{
		return $this->rightsFormFactory->create();
	}

	public function createComponentUsersGrid()
	{
		return $this->usersGridFactory->create();
	}

	public function createComponentEditUserForm()
	{
		$control = $this->editUserFormFactory->create();
		$control->setId($this->getParameter('id'));
		return $control;
	}

	public function createComponentUserGroupsGrid()
	{
		return $this->userGroupsGridFactory->create();
	}

	public function createComponentEditUserGroupForm()
	{
		$control = $this->editUserGroupFormFactory->create();
		$control->setId($this->getParameter('id'));
		return $control;
	}

	public function renderEditUser(?int $id)
	{

	}

	public function renderEditUserGroup(?int $id)
	{
	}
}