<?php declare(strict_types = 1);

namespace Tests\Cases;

use FastyBird\ExchangePlugin\Publisher;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../BaseTestCase.php';

/**
 * @testCase
 */
final class ExtensionTest extends BaseTestCase
{

	public function testServicesRegistration(): void
	{
		$container = $this->createContainer();

		Assert::notNull($container->getByType(Publisher\Publisher::class));
	}

}

$test_case = new ExtensionTest();
$test_case->run();
