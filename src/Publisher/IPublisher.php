<?php declare(strict_types = 1);

/**
 * IPublisher.php
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

/**
 * Exchange publisher interface
 *
 * @package        FastyBird:ExchangePlugin!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IPublisher
{

	/**
	 * @param string $origin
	 * @param string $routingKey
	 * @param mixed[] $data
	 *
	 * @return void
	 */
	public function publish(string $origin, string $routingKey, array $data): void;

}
