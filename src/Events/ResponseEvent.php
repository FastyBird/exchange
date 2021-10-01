<?php declare(strict_types = 1);

/**
 * ResponseEvent.php
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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Contracts\EventDispatcher;

/**
 * Http response event
 *
 * @package        FastyBird:ApplicationExchange!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ResponseEvent extends EventDispatcher\Event
{

	/** @var ServerRequestInterface */
	private ServerRequestInterface $request;

	/** @var ResponseInterface */
	private ResponseInterface $response;

	public function __construct(
		ServerRequestInterface $request,
		ResponseInterface $response
	) {
		$this->request = $request;
		$this->response = $response;
	}

	/**
	 * @return ServerRequestInterface
	 */
	public function getRequest(): ServerRequestInterface
	{
		return $this->request;
	}

	/**
	 * @return ResponseInterface
	 */
	public function getResponse(): ResponseInterface
	{
		return $this->response;
	}

}
