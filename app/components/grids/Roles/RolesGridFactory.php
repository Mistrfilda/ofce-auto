<?php


namespace App\Components\Grids\Roles;


interface RolesGridFactory
{
	/** @return RolesGrid */
	public function create();
}