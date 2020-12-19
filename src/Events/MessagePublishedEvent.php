<?php declare(strict_types = 1);

/**
 * MessagePublishedEvent.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ApplicationExchange\Events;

use Symfony\Contracts\EventDispatcher;

/**
 * After message published event
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class MessagePublishedEvent extends EventDispatcher\Event
{

	/** @var string */
	private string $routingKey;

	/** @var mixed[] */
	private array $data;

	/**
	 * @param string $routingKey
	 * @param mixed[] $data
	 */
	public function __construct(
		string $routingKey,
		array $data
	) {
		$this->routingKey = $routingKey;
		$this->data = $data;
	}

	/**
	 * @return string
	 */
	public function getRoutingKey(): string
	{
		return $this->routingKey;
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return $this->data;
	}

}
