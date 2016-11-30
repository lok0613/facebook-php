<?php

namespace Polyu\Crm\Facebook;

class FacebookComment extends AbstractFacebookEntity
{
	/**
	 * @var String
	 */
	protected $postId;

	/**
	 * Class constructor
	 *
	 * @param string $postId
	 * @param \Polyu\Crm\Facebook\Facebook $facebook
	 */
	public function __construct(String $postId, \Polyu\Crm\Facebook\Facebook $facebook)
	{
		$this->postId = $postId;
		parent::__construct($facebook);
	}

	/**
	 * get posts from facebook
	 *
	 * @param int $noOfComments
	 * @return array
	 */
	public function getComments(int $noOfComments): array
	{
		return $this->get("/{$this->postId}/comments", [], $noOfComments);
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
