<?php declare(strict_types = 1);

/**
 * Publisher.php
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

use FastyBird\Exchange\Events;
use FastyBird\Metadata\Entities as MetadataEntities;
use FastyBird\Metadata\Types as MetadataTypes;
use Psr\EventDispatcher as PsrEventDispatcher;
use SplObjectStorage;

/**
 * Exchange publishers proxy
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class Publisher implements IPublisher
{

	/** @var SplObjectStorage<IPublisher, null> */
	private SplObjectStorage $publishers;

	/** @var PsrEventDispatcher\EventDispatcherInterface|null */
	private ?PsrEventDispatcher\EventDispatcherInterface $dispatcher;

	public function __construct(
		?PsrEventDispatcher\EventDispatcherInterface $dispatcher = null
	) {
		$this->dispatcher = $dispatcher;

		$this->publishers = new SplObjectStorage();
	}

	/**
	 * {@inheritDoc}
	 */
	public function publish(
		MetadataTypes\ModuleSourceType|MetadataTypes\PluginSourceType|MetadataTypes\ConnectorSourceType $source,
		MetadataTypes\RoutingKeyType $routingKey,
		?MetadataEntities\IEntity $entity
	): void {
		$this->dispatcher?->dispatch(new Events\BeforeMessagePublishedEvent($routingKey, $entity));

		$this->publishers->rewind();

		/** @var IPublisher $publisher */
		foreach ($this->publishers as $publisher) {
			$publisher->publish($source, $routingKey, $entity);
		}

		$this->dispatcher?->dispatch(new Events\AfterMessagePublishedEvent($routingKey, $entity));
	}

	/**
	 * @param IPublisher $publisher
	 *
	 * @return void
	 */
	public function register(IPublisher $publisher): void
	{
		if (!$this->publishers->contains($publisher)) {
			$this->publishers->attach($publisher);
		}
	}

	/**
	 * @return void
	 */
	public function reset(): void
	{
		$this->publishers = new SplObjectStorage();
	}

}
