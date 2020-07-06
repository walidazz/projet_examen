<?php

class Vote extends AbstractEntity {
	public $userId;
	public $articleId;
	public $vote;



	public function __construct($userId,$articleId,$vote) {
		$this->userId = $userId;
		$this->articleId = $articleId;
		$this->vote = $vote;



	}

	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getArticleId() {
		return $this->articleId;
	}
	public function setArticleId($articleId) {
		$this->articleId = $articleId;
	}

	public function getVote() {
		return $this->vote;
	}
	public function setVote($vote) {
		$this->vote = $vote;
	}


}

?>