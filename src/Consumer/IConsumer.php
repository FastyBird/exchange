<?php declare(strict_types = 1);

/**
 * IConsumer.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Consumers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ApplicationExchange\Consumer;

use Nette\Utils;

/**
 * Exchange consumer interface
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Consumers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IConsumer
{

	/**
	 * @param string $origin
	 * @param string $routingKey
	 * @param Utils\ArrayHash $message
	 *
	 * @return void
	 */
	public function consume(string $origin, string $routingKey, Utils\ArrayHash $message): void;

}
