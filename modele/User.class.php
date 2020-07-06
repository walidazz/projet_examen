<?php 
class User extends AbstractEntity {
	private $firstName = "Non renseigné";
	private $lastName = "Non renseigné";
	private $pseudo;
	private $email;
	private $password;
	private $sex = "Non renseigné";
	private $birthday;
	private $avatar = "img/avatar/avatar.png";
	private $statut = 0;
	private $archive = 2;
	private $token;

	public function __construct($pseudo,$email,$password){
		$this->pseudo = $pseudo;
		$this->email = $email;
		$this->password = $password;
	 }

	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	public function getPseudo() {
		return $this->pseudo;
	}
	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;
	}

	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}

	public function getSex() {
		return $this->sex;
	}
	public function setSex($sex) {
		$this->sex = $sex;
	}

	public function getBirthday() {
		return $this->birthday;
	}
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
	}

	public function getAvatar() {
		return $this->avatar;
	}
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
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
	
	public function getToken()
	{
		return $this->token;
	}

	
	public function setToken($token)
	{
		$this->token = $token;

		return $this;
	}
}
    
 ?>