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

/**
 * Application exchange publisher interface
 *
 * @package        FastyBird:ApplicationExchange!
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
