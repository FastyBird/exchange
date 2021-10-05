<?php declare(strict_types = 1);

/**
 * IConsumer.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Consumers
 * @since          0.1.0
 *
 * @date           19.12.20
 */

namespace FastyBird\ExchangePlugin\Consumer;

use Nette\Utils;

/**
 * Exchange consumer interface
 *
 * @package        FastyBird:ExchangePlugin!
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
