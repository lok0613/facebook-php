<?php

namespace Polyu\Crm\Facebook;

// use Facebook\Facebook;

class Facebook
{
	/**
	 * @var Facebook\Facebook
	 */
	protected $client;

	/**
	 * @var String
	 */
	protected $accessToken;

	/**
	 * Class Constructor
	 *
	 * @param String $appId
	 * @param String $appSecret
	 * @param String|Optional $graphVersion
	 */
	public function __construct($appId, $appSecret, $graphVersion = 'v2.5')
	{
		$this->client = new \Facebook\Facebook([
		  'app_id' => $appId,
		  'app_secret' => $appSecret,
		  'default_graph_version' => $graphVersion,
		]);

		$this->accessToken = $appId . '|' . $appSecret;
	}

	/**
	 * Graph Api Get Method
	 *
	 * @param String $endpoint
	 * @return Facebook\GraphNodes\GraphEdge
	 */
	public function get(string $endpoint): \Facebook\GraphNodes\GraphEdge
	{
		$response = $this->client->get($endpoint, $this->accessToken , null, null);
		return $response->getGraphEdge();
	}

	/**
	 * Getter of access_token
	 *
	 * @return String
	 */
	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

}
