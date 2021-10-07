<?php declare(strict_types = 1);

/**
 * ExchangePluginExtension.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     DI
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ExchangePlugin\DI;

use FastyBird\ExchangePlugin\Publisher;
use Nette;
use Nette\DI;

/**
 * Exchange plugin extension container
 *
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     DI
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ExchangePluginExtension extends DI\CompilerExtension
{

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 *
	 * @return void
	 */
	public static function register(
		Nette\Configurator $config,
		string $extensionName = 'fbExchangePlugin'
	): void {
		$config->onCompile[] = function (
			Nette\Configurator $config,
			DI\Compiler $compiler
		) use ($extensionName): void {
			$compiler->addExtension($extensionName, new ExchangePluginExtension());
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('publisher'), new DI\Definitions\ServiceDefinition())
			->setType(Publisher\Publisher::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function beforeCompile(): void
	{
		parent::beforeCompile();

		$builder = $this->getContainerBuilder();

		/**
		 * PUBLISHERS PROXY
		 */

		$publisherProxyServiceName = $builder->getByType(Publisher\Publisher::class);

		if ($publisherProxyServiceName !== null) {
			/** @var DI\Definitions\ServiceDefinition $publisherProxyService */
			$publisherProxyService = $builder->getDefinition($publisherProxyServiceName);

			$publisherServices = $builder->findByType(Publisher\IPublisher::class);

			foreach ($publisherServices as $publisherService) {
				if ($publisherService->getType() !== Publisher\Publisher::class) {
					// Publisher is not allowed to be autowired
					$publisherService->setAutowired(false);

					$publisherProxyService->addSetup('?->registerPublisher(?)', [
						'@self',
						$publisherService,
					]);
				}
			}
		}
	}

}
