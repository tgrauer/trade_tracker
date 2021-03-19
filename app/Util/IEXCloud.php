<?php
namespace App\Util;

use GuzzleHttp\Client;

class IEXCloud
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function sendRequest($uri, $extra_params=null)
	{
		$extra_params = !empty($extra_params) ? '&'.$extra_params : '';
		$uri= env('IEXCLOUD_BASE_URL').$uri.'?token='.env('IEXCLOUD_API_KEY') . $extra_params;
		// return $uri;
		try {
			$response = $this->client->request('GET', $uri);
		} catch (\Exception $e) {
            return [];
		}

		return $this->response_handler($response->getBody()->getContents());
	}

	public function response_handler($response)
	{
		if ($response) {
			return json_decode($response, true);
		}
		
		return [];
	}
}