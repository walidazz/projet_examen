<?php

class Article extends AbstractEntity {
	public $title;
	public $userpseudo;
	public $urlseller;
	public $cost;
	public $info;

	public $category;
	public $img;
    public $statut = 0;
    public $archive;
    

	public function __construct($title, $userpseudo, $urlseller, $cost, $info, $category) {
		$this->title = $title;
		$this->userpseudo = $userpseudo;
		$this->urlseller = $urlseller;
		$this->cost = $cost;
		$this->info = $info;
        $this->category = $category;
	}



	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}

	public function getUserPseudo() {
		return $this->userpseudo;
	}
	public function setUserPseudo($userpseudo) {
		$this->userpseudo = $userpseudo;
	}
	public function getUrlseller() {
		return $this->urlseller;
	}
	public function setUrlseller($urlseller) {
		$this->urlseller = $urlseller;
	}

	public function getCost() {
		return $this->cost;
	}
	public function setCost($cost) {
		$this->cost = $cost;
	}

	public function getInfo() {
		return $this->info;
	}
	public function setInfo($info) {
		$this->info = $info;
	}

	public function getCategory() {
		return $this->category;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getImg() {
		return $this->img;
	}

	public function setImg($img) {
		$this->img = $img;
	}

	public function getStatut() {
		return $this->statut;
	}

	public function setStatut($statut) {
		$this->statut = $statut;
    }
    public function getArchive() {
		return $this->archive;
	}

	public function setArchive($archive) {
		$this->archive = $archive;
	}


}

?>