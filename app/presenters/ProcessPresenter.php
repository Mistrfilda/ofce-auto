<?php


namespace App\Presenters;


use App\Lib\AppException;
use App\Lib\ErrorCodes;
use App\Model\Facade\RegistrationModel;
use Nette\Application\BadRequestException;


class ProcessPresenter extends BasePresenter
{
	private $registrationFacade;

	public function __construct(RegistrationModel $registrationFacade)
	{
		$this->registrationFacade = $registrationFacade;
	}


	public function actionValidateToken($token)
	{
		if ($token === NULL) {
			throw new BadRequestException();
		}

		try {
			$this->registrationFacade->validateToken($token);
		} catch (AppException $e) {
			if ($e->getCode() === ErrorCodes::UNKNOWN_ENTITY) {
				$this->getPresenter()->flashMessage('Invalid Token!');
				return;
			}

			throw $e;
		}

		if (!$this->getUser()->isLoggedIn()) {
			$this->getPresenter()->flashMessage('Please sign in using your username and password', 'info');
		}

		$this->redirect('Homepage:default');
	}
}