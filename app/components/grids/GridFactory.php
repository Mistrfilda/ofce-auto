<?php


namespace App\Components\Grids;


class GridFactory
{
	/**
	 * @return AppGrid
	 */
	public function create() : AppGrid
	{
		$grid = new AppGrid();
		return $grid;
	}
}