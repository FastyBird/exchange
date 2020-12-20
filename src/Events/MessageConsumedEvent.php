<?php declare(strict_types = 1);

/**
 * MessageConsumedEvent.php
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

use Nette\Utils;
use Symfony\Contracts\EventDispatcher;

/**
 * After message consumed event
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class MessageConsumedEvent extends EventDispatcher\Event
{

	/** @var string */
	private string $origin;

	/** @var string */
	private string $routingKey;

	/** @var Utils\ArrayHash */
	private Utils\ArrayHash $data;

	public function __construct(
		string $origin,
		string $routingKey,
		Utils\ArrayHash $data
	) {
		$this->origin = $origin;
		$this->routingKey = $routingKey;
		$this->data = $data;
	}

	/**
	 * @return string
	 */
	public function getOrigin(): string
	{
		return $this->origin;
	}

	/**
	 * @return string
	 */
	public function getRoutingKey(): string
	{
		return $this->routingKey;
	}

	/**
	 * @return Utils\ArrayHash
	 */
	public function getData(): Utils\ArrayHash
	{
		return $this->data;
	}

}
