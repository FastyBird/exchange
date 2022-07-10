<?php declare(strict_types = 1);

/**
 * ExchangeExtension.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     DI
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\Exchange\DI;

use FastyBird\Exchange\Consumer;
use FastyBird\Exchange\Entities;
use FastyBird\Exchange\Publisher;
use Nette;
use Nette\DI;

/**
 * Exchange plugin extension container
 *
 * @package        FastyBird:Exchange!
 * @subpackage     DI
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ExchangeExtension extends DI\CompilerExtension
{

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 *
	 * @return void
	 */
	public static function register(
		Nette\Configurator $config,
		string $extensionName = 'fbExchange'
	): void {
		$config->onCompile[] = function (
			Nette\Configurator $config,
			DI\Compiler $compiler
		) use ($extensionName): void {
			$compiler->addExtension($extensionName, new ExchangeExtension());
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('consumer'), new DI\Definitions\ServiceDefinition())
			->setType(Consumer\Consumer::class);

		$builder->addDefinition($this->prefix('publisher'), new DI\Definitions\ServiceDefinition())
			->setType(Publisher\Publisher::class);

		$builder->addDefinition($this->prefix('entityFactory'), new DI\Definitions\ServiceDefinition())
			->setType(Entities\EntityFactory::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function beforeCompile(): void
	{
		parent::beforeCompile();

		$builder = $this->getContainerBuilder();

		/**
		 * CONSUMERS PROXY
		 */

		$consumerServices = $builder->findByType(Consumer\IConsumer::class);

		foreach ($consumerServices as $consumerService) {
			if ($consumerService->getType() !== Consumer\Consumer::class) {
				// Consumer is not allowed to be autowired
				$consumerService->setAutowired(false);
			}
		}

		/**
		 * PUBLISHERS PROXY
		 */

		$publisherServices = $builder->findByType(Publisher\IPublisher::class);

		foreach ($publisherServices as $publisherService) {
			if ($publisherService->getType() !== Publisher\Publisher::class) {
				// Publisher is not allowed to be autowired
				$publisherService->setAutowired(false);
			}
		}
	}

}
