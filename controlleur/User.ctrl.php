<?php 
class CtrlUser extends Controller {
	
	public function index() {
		$this->info('Page de profil ','information utilisateur');
		$this->loadDao('User');

		if (isset($_SESSION['id'])) {
			$d['user'] = $this->DaoUser->read($_SESSION['id']);
			$this->set($d);
			$this->render('User','profilUser',$_SESSION['id']);
		} else {
			$d['log'] = '<p class="blink"> Veuillez vous connecter avant d\'acceder à votre compte </p>';
			$this->set($d); 
			$this->render('User','logIn');
		}

	}


	public function allUsers($current=null){   
		$this->info('Administration ','liste des utilisateurs signalés'); 
		if($_SESSION['statut'] == 1){
			$this->loadDao('User');
			$this->loadDao('Report');
			
		$total = $this->DaoReport->countUserReported();
		$perPage = 25;
        $nbPage = ceil($total/$perPage);
        if($current == null or $current > $nbPage){
            $current = 1;
        }
        $firstOfPage = ($current-1)*$perPage;
	
			$tabUsers = $this->DaoUser->readByUsersReports($firstOfPage,$perPage);

			$d['nbPage'] = $nbPage;
			$d['total'] = $total;
			$d['current'] = $current;
			$d['tabUsers'] = $tabUsers;
		   
			$this->set($d);
			$this->render('User','allUsers');
} else {
	$d['log'] = "<font color=\"red\"> Seuls les administrateurs ont acces à cette page ! </font>";
	$this->set($d);
	$this->render('Article','news');
}	
	
	
	}

	public function profilUser($id) {
		$this->loadDao('User');
		$this->info('Page de profil ','information utilisateur');
		if (isset($_SESSION['id'])) {
			$d['user'] = $this->DaoUser->read($id);
			$this->set($d);
			$this->render('User','profilUser',$id);
		} else {
			$d['log'] = '<font style="red">Il faut être connecté pour consulter un profil </font>';
			$this->set($d); 
			$this->render('User','logIn');
		}

	}
	

		// $email = htmlentities($this->input['email']);
			// $password = htmlentities($this->input['password']);
			// $passwordConfirm =  htmlentities($this->input['passwordConfirm']);
	public function signIn() { 
		$this->info('Inscription','Inscription d\'un utilisateur');
		$this->loadDao('User');
		if (isset($_SESSION['id'])) {
			$d['log'] = '<p class="blink"> Vous etes déja connecté </p>';
			$this->set($d); 
			$this->render('User','logIn');
		} else{

		if (!empty($this->input) ) {	
			$pseudo = filter_var($this->input['pseudo'], FILTER_SANITIZE_STRING);
			$email = filter_var($this->input['email'], FILTER_SANITIZE_EMAIL);
			$password = filter_var($this->input['password'], FILTER_SANITIZE_STRING);
			$passwordConfirm = filter_var($this->input['passwordConfirm'], FILTER_SANITIZE_STRING);
			$isGood = 0;
			// j'ai crée une variable "isGood" que j'ai mis à 0, en cas d'erreur la variable sera incrementé de 1
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $password)) {
				$isGood++;
				$d['log'] = '<p class="blink">Le mot de passe doit contenir au moins 6 lettres et un chiffre</p>
				';
				$this->set($d);
				$this->render('User','signIn'); die;
			// sinon le mot de passe est au bon format, si le le mot de passe ne correspond pas au pass de confirmation
			}
			if ($password == $passwordConfirm) {
				$password = password_hash($password, PASSWORD_DEFAULT);
				// password_hash — Crée une clé de hachage pour un mot de passe
				} else {
					$d['log'] = '<p class="blink">les mots de passe ne correspondent pas </p>';
					$this->set($d);
					$this->render('User','signIn'); die;
				}
			if (!preg_match('`^([a-zA-Z0-9-_]{2,36})$`', $pseudo)) {
							$isGood++;
							$d['log'] = '<p class="blink">• Pseudo incorrect, il doit contenir que des lettres et chiffres</p>';
							$this->set($d);
							$this->render('User','signIn'); die;
						}
		if (!preg_match("/^[a-zA-Z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/", $email)) {
			$isGood++;
			$d['log'] .= '<p class="blink">Email incorrect, il doit être au format d<\'adresse email><p class="blink"><br>';
			$this->set($d);
			$this->render('User','signIn'); die;
		} 
			$isUser = $this->DaoUser->readByEmail($email);
			if ($isUser != null) {
				$d['log'] = '<p class="blink">Email déjà inscrit !</p>';
				$this->set($d);
				$this->render('User','signIn'); die;
			} 
			
			if($isGood == 0) {
				

			$user = new User($pseudo,$email, $password);	
			$this->DaoUser->create($user);
			$token = bin2hex(openssl_random_pseudo_bytes('8'));
			$user->setToken($token);
			$this->DaoUser->update($user);
			$link = 'http://localhost/zonefantome/User/valid/'.$user->getId().'/'.$token.'/'.time();

			mail($user->getEmail(), 'Votre lien d\'activation ZoneFantome', '
			                    Bonjour '.$user->getPseudo().', 
			                    Bienvenue sur ZoneFantome! Veuillez confirmer votre adresse mail en cliquant sur le lien suivant:
			                    '.$link.'
			                   ');
			$d['log'] = '<font color="green">Email de confirmation envoyé </p>';
					}
	
	        $this->set($d);
			$this->render('User','logIn');
			} else {
			$this->render('User','signIn');
					}
				}
			}
public function logIn() {
	$this->info('Connexion','Connexion d\'un utilisateur');
	if (isset($_SESSION['id'])) {
		$d['log'] = '<font color="green"> Vous etes  connecté </p>';
		$this->set($d); 
		$this->render('User','logIn');
	} else {
		if (!empty($this->input)) {
			$this->loadDao('User');
			// $pseudo = filter_var($this->input['pseudo'], FILTER_SANITIZE_STRING);
			$user = $this->DaoUser->readByEmail(filter_var($this->input['email'], FILTER_SANITIZE_STRING));			
			if ($user != null ) {
				if($user->getArchive() == 0){			
					$passInput = filter_var($this->input['password'], FILTER_SANITIZE_STRING);
					$passUser = $user->getPassword();					
					if (password_verify($passInput, $passUser)) {
						$_SESSION['id'] = $user->getId();
						$_SESSION['email'] = $user->getEmail();
						$_SESSION['pseudo'] = $user->getPseudo();
						$_SESSION['statut'] = $user->getStatut();
						// header location appele directement l'action du controller et non la vue
						header('Location:'.WEBROOT.'Article/news/');
					} else {
						$d['log'] = '<p class="blink">Email ou mot de passe incorrect </p>';
						$this->set($d);
						$this->render('User','logIn');
					}
				} elseif ($user->getArchive() == 1){
					$d['log'] = '<p class="blink"> Votre compte a été désactivé !</p>';
					$this->set($d);
					$this->render('User','logIn');
				} else {
					$d['log'] = '<p class="blink"> Veuillez confirmer votre adresse mail !</p>';
					$this->set($d);
					$this->render('User','logIn');
				}
			} else {
				$d['log'] = '<p class="blink">Compte inexistant</p>';
				$this->set($d);
				$this->render('User','logIn');
			}

		} else {
			$this->render('User','logIn');
		} 
	}
}

	public function logOut() {
	
		session_unset();
		session_destroy();
		
		// ob_get_clean();
		//faire gaffe y avait un header location ici !!!!!!!!!!!
		header('Location:'.WEBROOT.'Article/news');
	}

public function contactForm(){
	
	$this->info('Page de contact','Formulaire de contact');
	if(!empty($this->input) ) {
	$postNom = htmlentities($_POST['nom']);

	$postEmail = htmlentities($_POST['email']);
	$postPhone = htmlentities($_POST['phone']);
	$postMessage = htmlentities($_POST['message']);
		
	$nom = filter_var($postNom,FILTER_SANITIZE_STRING);
	$email = filter_var($postEmail,FILTER_SANITIZE_STRING);
	$phone = filter_var($postPhone,FILTER_SANITIZE_STRING);
	$contenu = filter_var($postMessage,FILTER_SANITIZE_STRING);
	$date = date('d/m/Y - H:i');
	
	$secret_key ='6LdZGNIUAAAAAB0kz0L09vS_AJiOIsoazHjzcjeR';
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response'].'');

    $response_data = json_decode($response);
	
if($response_data->success == true && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message'])){

	// 
	$to = "walidazzimani@gmail.com";
	$subject = "Demande d'aide";
	
	$message="<html><head></head><body>Nom:  $nom <br> <br> Adresse mail: $email<br> <br> Téléphone : $phone <br> <br> Message : $contenu<br><br> message émis le $date</body></html>";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	mail($to, $subject, $message, $headers);
$d['log']= '<font color="green"> Message envoyé avec succès ! </font>';
$this->set($d);
$this->render('User','contactForm');
	} else { 
		$d['log'] = '<font color="red"> Veuillez remplir tous les champs! </font>';
		$this->set($d);
	$this->render('User','contactForm');

	}
}$this->render('User','contactForm');}

	public function update($id){
		$this->info('Modification','Modification d\'un utilisateur');
		$this->loadDao('User');
		if (!empty($this->input)) {
			
			if (isset($_SESSION['id'])) {
				$user = $this->DaoUser->read($id);

				$firstname = filter_var($this->input['firstname'], FILTER_SANITIZE_STRING);
				$lastname = filter_var($this->input['lastname'], FILTER_SANITIZE_STRING);
				$pseudo = filter_var($this->input['pseudo'], FILTER_SANITIZE_STRING);
				$email = filter_var($this->input['email'], FILTER_SANITIZE_EMAIL);
				$sex = filter_var($this->input['sex'], FILTER_SANITIZE_STRING);
				$birthday = filter_var($this->input['birthday'], FILTER_SANITIZE_STRING);

				$imageParDefaut =  "img/avatar/avatar.png";
				if(isset($this->files['avatar']) AND !empty($this->files['avatar']['name'])) {
					$tailleMax = 5097152;
					$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
					if($this->files['avatar']['size'] <= $tailleMax) {
					   $extensionUpload = strtolower(substr(strrchr($this->files['avatar']['name'], '.'), 1));
					   if(in_array($extensionUpload, $extensionsValides)) {
						  $chemin = "img/avatar/".$_SESSION['id'].".".$extensionUpload;
						  $resultat = move_uploaded_file($this->files['avatar']['tmp_name'], $chemin);
						  if($resultat) {
								$user->setAvatar($chemin);
							 
						  } else {
							$d['log'] = '<font style=" color:red">Erreur durant l\'importation de votre photo de profil </font>';
						  }
					   } else {
						$d['log'] = '<font style=" color:red">Votre photo de profil doit être au format jpg, jpeg, gif ou png </font>';
					   }
					} else {
						$d['log'] = '<font style=" color:red">Votre photo de profil ne doit pas dépasser 2Mo </font>';
					}
				 } 
			
				$user->setFirstName($firstname);
				$user->setLastName($lastname);
				$user->setPseudo($pseudo);
				$user->setEmail($email);
				$user->setSex($sex);
				$user->setBirthday($birthday);

		$this->DaoUser->update($user);	

		$user = $this->DaoUser->read($id);	
		$d['user'] = $user;

		$this->set($d);

			$this->render('User','profilUser',$_SESSION['id']);
							}
					 } else {
					$d['user'] = $this->DaoUser->read($_SESSION['id']);
					$this->set($d);
					$this->render('User','update');
					 }
				}

	public function archive($id){
		$this->info('Désactivation  ','Compte désactivé');
		$this->loadDao('User');
		$this->DaoUser->archive($id,'1');
	if($_SESSION['statut'] == 1){	 
		$this->allUsers();
	}  else { $this->logOut();

	}
}

public function welcomeAdmin($id){
	$this->loadDao('User');
	$this->DaoUser->admin($id,'1');
	$this->allUsers();
}

public function GoodbyeAdmin($id){
	$this->loadDao('User');
	$this->DaoUser->admin($id,'0');
	$this->allUsers();
}


public function deban($id){
	$this->info('Activation ','Compte activé');
	$this->loadDao('User');
	$this->DaoUser->archive($id,'0');
	 
	$this->allUsers();

}



				public function valid($id,$token,$time) {
					$this->loadDao('User');
					// Affectation à $user de l'objet retourné par la DaoUser read 
					$user = $this->DaoUser->read($id);
					// Définition du temps impartie pour la validité du token
					$maxTime = 86400;
					// Temps actuel
					$currentTime = time();
					// Calcul du temps restant entre le temps actuel et le temps donnée dans l'url
					$pastTime = $currentTime - $time;
					// Si le temps restant est inférieur ou égal au temps impartie du token
					if ($pastTime <= $maxTime) {
						// Si le token de l'utilisateur dans la bdd est égal au token fourni par l'url
						if ($user->getToken() == $token) {
							// Vide l'atrribut token dans l'objet $user
							$user->setToken(null);
							// Passe le statut à actif dans l'objet $user
							// Envoie de l'objet $user à la méthode update de la DaoUser
							$user->setArchive(0);
							$this->DaoUser->update($user);	
							// log pour l'utilisateur
							$d['log'] = '<font color="green">Félicitation ! Votre compte est désormais actif !</font>';
							// Envoie des données à la vue
							$this->set($d);
							// Chargement de la vue create de Personnage
							$this->render('User','logIn');
						// Sinon Token non valide
						} else {
							// log pour l'utilisateur
							$d['log'] = 'Clé de validation erronée ! (espece de pirate, je te vois)<br>';
							// Envoie des données à la vue
							$this->set($d);
							// Chargement de la vue signIn de User
							$this->render('User','signIn');
						}
					// Sinon validité du token expirée
					} else {
						// log pour l'utilisateur
						$d['log'] = 'Expiration de la valadité de votre inscription, veuillez recommencer<br>';
						// Suppression de l'utilisateur
						$this->DaoUser->delete($user->getId());
						// Envoie des données à la vue
						$this->set($d);
						// Chargement de la vue signIn de User
						$this->render('User','signIn');
					}
				}

				public function delete($id){
					$this->info('Suppression','Suppression du compte d\'un utilisateur');
					$this->loadDao('User');
					$this->DaoUser->delete($id);
					$this->allUsers();
					}
					
					



}
?>