<?php declare(strict_types = 1);

/**
 * IConsumer.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     Consumers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\Exchange\Consumer;

use FastyBird\Metadata\Entities as MetadataEntities;
use FastyBird\Metadata\Types as MetadataTypes;

/**
 * Exchange consumer interface
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Consumers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IConsumer
{

	/**
	 * @param MetadataTypes\ModuleSourceType|MetadataTypes\PluginSourceType|MetadataTypes\ConnectorSourceType $source
	 * @param MetadataTypes\RoutingKeyType $routingKey
	 * @param MetadataEntities\IEntity|null $entity
	 *
	 * @return void
	 */
	public function consume(
		$source,
		MetadataTypes\RoutingKeyType $routingKey,
		?MetadataEntities\IEntity $entity
	): void;

}
