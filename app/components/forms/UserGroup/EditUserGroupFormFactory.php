<?php


namespace App\Components\Forms\Group;


use App\Components\Forms\UserGroup\EditUserGroupForm;


interface EditUserGroupFormFactory
{
	/** @return EditUserGroupForm */
	public function create();
}