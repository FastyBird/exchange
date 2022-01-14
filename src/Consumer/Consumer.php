<?php declare(strict_types = 1);

/**
 * Consumer.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     Consumers
 * @since          0.5.0
 *
 * @date           09.01.22
 */

namespace FastyBird\Exchange\Consumer;

use FastyBird\Metadata\Types as MetadataTypes;
use Nette\Utils;
use SplObjectStorage;

/**
 * Exchange consumer proxy
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Consumers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class Consumer implements IConsumer
{

	/** @var SplObjectStorage<IConsumer, null> */
	private SplObjectStorage $consumers;

	public function __construct()
	{
		$this->consumers = new SplObjectStorage();
	}

	/**
	 * {@inheritDoc}
	 */
	public function consume(
		$origin,
		MetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
	): void {
		$this->consumers->rewind();

		/** @var IConsumer $consumer */
		foreach ($this->consumers as $consumer) {
			$consumer->consume($origin, $routingKey, $data);
		}
	}

	/**
	 * @param IConsumer $consumer
	 *
	 * @return void
	 */
	public function registerPublisher(IConsumer $consumer): void
	{
		if (!$this->consumers->contains($consumer)) {
			$this->consumers->attach($consumer);
		}
	}

}
