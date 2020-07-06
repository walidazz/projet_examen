<?php

class Comment extends AbstractEntity {
	public $userId;
	public $articleId;
	public $message;
	public $userPseudo;
	public $userAvatar;


	public function __construct($userId,$articleId,$message) {
		$this->userId = $userId;
		$this->articleId = $articleId;
		$this->message = $message;



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

	public function getMessage() {
		return $this->message;
	}
	public function setMessage($message) {
		$this->message = $message;
	}

	public function getUserPseudo() {
		return $this->userPseudo;
	}
	public function setUserPseudo($userPseudo) {
		$this->userPseudo = $userPseudo;
	}

	public function getUserAvatar() {
		return $this->userAvatar;
	}
	public function setUserAvatar($userAvatar) {
		$this->userAvatar = $userAvatar;
	}


}

?>