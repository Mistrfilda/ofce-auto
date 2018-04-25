<?php

namespace App\Tests\Model;

use App\Tests\BaseTest;
use Tester\Assert;


$container = require __DIR__ . '/../bootstrap.php';

/**
 * Class UserTest
 * @testCase
 */
class UserTest extends BaseTest
{
	public function testUser(): void
	{
	}
}

(new UserTest($container))->run();