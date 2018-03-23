<?php


namespace App\Lib;


use Throwable;


class AppException extends \Exception
{
	public function __construct($code = 0, $message = "", Throwable $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
	}
}