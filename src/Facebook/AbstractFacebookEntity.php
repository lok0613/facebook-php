<?php

namespace Polyu\Crm\Facebook;

abstract class AbstractFacebookEntity
{
	/**
	 * @var Polyu\Crm\Facebook\Facebook
	 */
	protected $facebook;

	/**
	 * Class constructor
	 *
	 * @param \Polyu\Crm\Facebook\Facebook $facebook
	 */
	protected function __construct(\Polyu\Crm\Facebook\Facebook $facebook)
	{
		$this->facebook = $facebook;
	}

	/**
	 * Interface of the get api query
	 *
	 * @param string $url
	 * @param array|null $params
	 * @param int $noOfRecords
	 * @return array
	 */
	protected function get(string $url, array $params = [], int $noOfRecords): array
	{
		return array_map(function($item) {
			return $this->format($item->all());
		}, $this->getRecords($url, $params, $noOfRecords));
		// return $this->getRecords($url, $params, $noOfRecords);
	}

	/**
	 * Internal method for get api query
	 *
	 * @param string $url
	 * @param array|null $params
	 * @param int $noOfRecords
	 * @return \Facebook\GraphNodes\GraphNode[]
	 */
	private function getRecords(string $url, array $params = [], int $noOfRecords): array
	{
		$getUrl = $url . '?' . http_build_query($params);
		$items = $this->facebook->get($getUrl);
		if (count($items) < $noOfRecords) {
			$nextUrl = $this->getNextUrl($items);
			$nextItems = $this->getRecords($url, $this->getNextParams($nextUrl), $noOfRecords - count($items));
			return array_merge($items->all(), $nextItems);
		}
		return array_slice($items->all(), 0, $noOfRecords);
	}

	/**
	 * Get the next url from the meta data inside json return
	 *
	 * @param \Facebook\GraphNodes\GraphEdge $items
	 * @return string
	 */
	protected function getNextUrl(\Facebook\GraphNodes\GraphEdge $items): string
	{
		return $items->getMetaData()['paging']['next'];
	}

	/**
	 * Get next parameters for next query
	 *
	 * @param string $url
	 * @return array
	 */
	protected function getNextParams(string $url): array
	{
		parse_str(parse_url($url)['query'], $params);
		return $params;
	}

	/**
	 * Format the structure of array for the return of get method
	 *
	 * @param array $item
	 * @return array
	 */
	abstract protected function format(array $item): array;
}
