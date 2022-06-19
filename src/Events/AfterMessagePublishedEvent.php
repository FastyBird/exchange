<?php declare(strict_types = 1);

/**
 * AfterMessagePublishedEvent.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     Events
 * @since          0.45.0
 *
 * @date           19.06.22
 */

namespace FastyBird\Exchange\Events;

use FastyBird\Metadata\Entities as MetadataEntities;
use FastyBird\Metadata\Types as MetadataTypes;
use Symfony\Contracts\EventDispatcher;

/**
 * After message published event
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class AfterMessagePublishedEvent extends EventDispatcher\Event
{

	/** @var MetadataTypes\RoutingKeyType */
	private MetadataTypes\RoutingKeyType $routingKey;

	/** @var MetadataEntities\IEntity|null */
	private ?MetadataEntities\IEntity $entity;

	public function __construct(
		MetadataTypes\RoutingKeyType $routingKey,
		?MetadataEntities\IEntity $entity
	) {
		$this->routingKey = $routingKey;
		$this->entity = $entity;
	}

	/**
	 * @return MetadataTypes\RoutingKeyType
	 */
	public function getRoutingKey(): MetadataTypes\RoutingKeyType
	{
		return $this->routingKey;
	}

	/**
	 * @return MetadataEntities\IEntity|null
	 */
	public function getEntity(): ?MetadataEntities\IEntity
	{
		return $this->entity;
	}

}
