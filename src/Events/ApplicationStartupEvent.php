<?php declare(strict_types = 1);

/**
 * ApplicationStartupEvent.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 * @since          0.1.0
 *
 * @date           01.10.21
 */

namespace FastyBird\ApplicationExchange\Events;

use Symfony\Contracts\EventDispatcher;

/**
 * After application started event
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ApplicationStartupEvent extends EventDispatcher\Event
{

}
