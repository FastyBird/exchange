<?php declare(strict_types = 1);

/**
 * MessageReceivedEvent.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Events
 * @since          0.4.6
 *
 * @date           08.10.21
 */

namespace FastyBird\ExchangePlugin\Events;

use FastyBird\ModulesMetadata\Types as ModulesMetadataTypes;
use Nette\Utils;
use Symfony\Contracts\EventDispatcher;

/**
 * After message received by exchange event
 *
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class MessageReceivedEvent extends EventDispatcher\Event
{

	/** @var ModulesMetadataTypes\ModuleOriginType */
	private ModulesMetadataTypes\ModuleOriginType $origin;

	/** @var ModulesMetadataTypes\RoutingKeyType */
	private ModulesMetadataTypes\RoutingKeyType $routingKey;

	/** @var Utils\ArrayHash|null */
	private ?Utils\ArrayHash $data;

	public function __construct(
		ModulesMetadataTypes\ModuleOriginType $origin,
		ModulesMetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data = null
	) {
		$this->origin = $origin;
		$this->routingKey = $routingKey;
		$this->data = $data;
	}

	/**
	 * @return ModulesMetadataTypes\ModuleOriginType
	 */
	public function getOrigin(): ModulesMetadataTypes\ModuleOriginType
	{
		return $this->origin;
	}

	/**
	 * @return ModulesMetadataTypes\RoutingKeyType
	 */
	public function getRoutingKey(): ModulesMetadataTypes\RoutingKeyType
	{
		return $this->routingKey;
	}

	/**
	 * @return Utils\ArrayHash|null
	 */
	public function getData(): ?Utils\ArrayHash
	{
		return $this->data;
	}

}