<?php declare(strict_types = 1);

/**
 * IPublisher.php
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

/**
 * Exchange publisher interface
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Publishers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
interface IPublisher
{

	/**
	 * @param MetadataTypes\ModuleOriginType $origin
	 * @param MetadataTypes\RoutingKeyType $routingKey
	 * @param Utils\ArrayHash|null $data
	 *
	 * @return void
	 */
	public function publish(
		MetadataTypes\ModuleOriginType $origin,
		MetadataTypes\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
	): void;

}
