<?php

namespace Polyu\Crm\Facebook;

class FacebookPost extends AbstractFacebookEntity
{
	/**
	 * @var String
	 */
	protected $pageId;

	/**
	 * Class constructor
	 *
	 * @param string $pageId
	 * @param \Polyu\Crm\Facebook\Facebook $facebook
	 */
	public function __construct(String $pageId, \Polyu\Crm\Facebook\Facebook $facebook)
	{
		$this->pageId = $pageId;
		parent::__construct($facebook);
	}

	/**
	 * get posts from facebook
	 *
	 * @param int $noOfPosts
	 * @return array
	 */
	public function getPosts(int $noOfPosts): array
	{
		return $this->get("/{$this->pageId}/posts", [], $noOfPosts);
	}

	/**
	 * @inheritDoc
	 */
	protected function format(array $item): array
	{
		return [
			'message' => $item['message'],
			'id' => $item['id'],
		];
	}

}
