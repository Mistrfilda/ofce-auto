<?php


namespace App\Model\Facade;


use App\Model\Database\Entity\Entity;


interface IModel
{
	public function update(array $data, int $id = NULL) : Entity;

	public function getData(int $id);
}