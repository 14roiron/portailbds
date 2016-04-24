<?php
namespace BDS\SabreDavBundle;

use Sabre\HTTP\ResponseInterface;
use Sabre\HTTP\Sapi as SabreSapi;
use Symfony\Component\HttpFoundation\Response;
/**
 * @inheritdoc
 */
class Sapi extends SabreSapi
{
	/**
	 * @var Response
	 */
	static $response;
	/**
	 * @inheritdoc
	 */
	static function sendResponse(ResponseInterface $response)
	{
		$sfResponse = new Response($response->getBody(), $response->getStatus(), $response->getHeaders());
		$sfResponse->setProtocolVersion($response->getHttpVersion());
		self::$response = $response;
	}
	/**
	 * @return Response
	 */
	public static function getSfResponse()
	{
		return self::$response;
	}
}