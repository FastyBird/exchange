<?php declare(strict_types = 1);

/**
 * IPublisher.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     Publishers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\Exchange\Publisher;

use FastyBird\Metadata\Entities as MetadataEntities;
use FastyBird\Metadata\Types as MetadataTypes;

/**
 * Exchange publisher interface
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IPublisher
{

	/**
	 * @param MetadataTypes\ModuleSourceType|MetadataTypes\PluginSourceType|MetadataTypes\ConnectorSourceType $source
	 * @param MetadataTypes\RoutingKeyType $routingKey
	 * @param MetadataEntities\IEntity|null $entity
	 *
	 * @return void
	 */
	public function publish(
		$source,
		MetadataTypes\RoutingKeyType $routingKey,
		?MetadataEntities\IEntity $entity
	): void;

}
