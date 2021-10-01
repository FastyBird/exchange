<?php declare(strict_types = 1);

/**
 * ApplicationInitializeEvent.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 * @since          0.1.0
 *
 * @date           01.10.21
 */

namespace FastyBird\ApplicationExchange\Events;

use React\Socket\ServerInterface;
use Symfony\Contracts\EventDispatcher;

/**
 * Application initialized event
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ApplicationInitializeEvent extends EventDispatcher\Event
{

	/** @var ServerInterface */
	private ServerInterface $server;

	public function __construct(
		ServerInterface $server
	) {
		$this->server = $server;
	}

	/**
	 * @return ServerInterface
	 */
	public function getServer(): ServerInterface
	{
		return $this->server;
	}

}
