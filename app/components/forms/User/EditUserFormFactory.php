<?php


namespace App\Components\Forms\User;


interface EditUserFormFactory
{
	/** @return EditUserForm */
	public function create();
}