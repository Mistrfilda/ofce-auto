<?php


namespace App\Components\Grids\UserGroups;


interface UserGroupsGridFactory
{
	/** @return UserGroupsGrid */
	public function create();
}