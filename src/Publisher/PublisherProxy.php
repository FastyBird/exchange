<?php declare(strict_types = 1);

/**
 * IPublisher.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Publishers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ApplicationExchange\Publisher;

use FastyBird\ApplicationExchange\Events;
use SplObjectStorage;
use Symfony\Contracts\EventDispatcher;

/**
 * Application exchange publisher proxy
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class PublisherProxy implements IPublisher
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
	public function publish(string $routingKey, array $data): void
	{
		$this->publishers->rewind();

		/** @var IPublisher $publisher */
		foreach ($this->publishers as $publisher) {
			$publisher->publish($routingKey, $data);
		}

		$this->dispatcher->dispatch(new Events\MessagePublishedEvent($routingKey, $data));
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
