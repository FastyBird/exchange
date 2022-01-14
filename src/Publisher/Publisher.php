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

use FastyBird\Metadata\Types as MetadataTypes;
use Nette\Utils;
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

	public function __construct()
	{
		$this->publishers = new SplObjectStorage();
	}

	/**
	 * {@inheritDoc}
	 */
	public function publish(
		MetadataTypes\ModuleOriginType $origin,
		MetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
	): void {
		$this->publishers->rewind();

		/** @var IPublisher $publisher */
		foreach ($this->publishers as $publisher) {
			$publisher->publish($origin, $routingKey, $data);
		}
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
