<?php


namespace App\Components\Grids\Users;


interface UsersGridFactory
{
	/** @return UsersGrid */
	public function create();
}