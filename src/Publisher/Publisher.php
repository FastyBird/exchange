<?php declare(strict_types = 1);

/**
 * Publisher.php
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

use FastyBird\ExchangePlugin\Events;
use FastyBird\ModulesMetadata\Types as ModulesMetadataTypes;
use Nette\Utils;
use SplObjectStorage;
use Symfony\Contracts\EventDispatcher;

/**
 * Exchange publishers proxy
 *
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class Publisher implements IPublisher
{

	/** @var SplObjectStorage<IPublisher, null> */
	private SplObjectStorage $publishers;

	/** @var EventDispatcher\EventDispatcherInterface */
	private EventDispatcher\EventDispatcherInterface $dispatcher;

	public function __construct(
		EventDispatcher\EventDispatcherInterface $dispatcher
	) {
		$this->dispatcher = $dispatcher;

		$this->publishers = new SplObjectStorage();
	}

	/**
	 * {@inheritDoc}
	 */
	public function publish(
		ModulesMetadataTypes\ModuleOriginType $origin,
		ModulesMetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
	): void {
		$this->publishers->rewind();

		/** @var IPublisher $publisher */
		foreach ($this->publishers as $publisher) {
			$publisher->publish($origin, $routingKey, $data);
		}

		$this->dispatcher->dispatch(new Events\MessagePublishedEvent($origin, $routingKey, $data));
	}

	/**
	 * @param IPublisher $publisher
	 *
	 * @return void
	 */
	public function registerPublisher(IPublisher $publisher): void
	{
		if (!$this->publishers->contains($publisher)) {
			$this->publishers->attach($publisher);
		}
	}

}
