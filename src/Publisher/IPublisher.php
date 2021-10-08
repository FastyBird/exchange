<?php declare(strict_types = 1);

/**
 * IPublisher.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Publishers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ExchangePlugin\Publisher;

use FastyBird\ModulesMetadata\Types as ModulesMetadataTypes;
use Nette\Utils;

/**
 * Exchange publisher interface
 *
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IPublisher
{

	/**
	 * @param ModulesMetadataTypes\ModuleOriginType $origin
	 * @param ModulesMetadataTypes\RoutingKeyType $routingKey
	 * @param Utils\ArrayHash|null $data
	 *
	 * @return void
	 */
	public function publish(
		ModulesMetadataTypes\ModuleOriginType $origin,
		ModulesMetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
	): void;

}
