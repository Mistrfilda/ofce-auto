<?php


namespace App\Console;


use App\Model\RightModel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdateRightsCommand extends BaseCommand
{
	private $rightModel;

	public function __construct(RightModel $rightModel, $name = NULL)
	{
		parent::__construct($name);
		$this->rightModel = $rightModel;
	}


	/**
	 * @return void
	 */
	protected function configure()
	{
		$this->setName('rights:update');
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('Updating rights');
		$this->rightModel->updateRights();
		$output->writeln('Rights successfully updated');

	}
}