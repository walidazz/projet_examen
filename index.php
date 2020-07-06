<?php session_start();
// WEBROOT => dossier du projet de la racine serveur
define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
// ROOT => dossier du projet de la racine du disque dur
define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
// $info = json_decode(file_get_contents(ROOT.'js/info.json'));
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Zone Fantôme - Site communautaire de partage de bons plans </title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="<?= WEBROOT ?>css/style.css">
	<link rel="canonical" href="http://localhost/zonefantome"/>



	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link rel="stylesheet" href="<?= WEBROOT ?>css/modules/bootstrap.css">
	<link rel="stylesheet" href="<?= WEBROOT ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= WEBROOT ?>css/mdb.min.css">
	<link href="https://fonts.googleapis.com/css?family=Girassol&display=swap" rel="stylesheet"> 
	<link rel="icon" type="image/png" href="<?= WEBROOT ?>img/logo.png"/>
	<meta charset="UTF-8">
    <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body class="pt-0">
	<!-- HEADER -->
	<header>
	<?php
	require 'vue/header.php';
	?>
	</header>
	<main >

	<?php 
		// Init 
		require_once('core/bdd.php');
		require_once('core/controller.php');
		require_once('core/abstractEntity.php');
		/*ROUTAGE*/
		// Page par default
		if (isset($_GET['p'])) {
			if ($_GET['p'] == "") {
				$_GET['p'] = "Article/news";
				// plus tard il faudra mettre Article/readAll
			}
		} else {
			$_GET['p'] = "Article/news";
		}
		// Chargement du controleur
		// $tabEntity est le tableau contenant tout les nom de controlleurs accepté par l'appli	
		$param = explode("/",$_GET['p']);	
		// Si le nom de controlleur venant de l'url est dans le $tabControlleur
		// Mettre les nouveaux controller dans le tableau
		$tabEntity = array("User","Article");
		if (in_array($param[0], $tabEntity)) {
			$controller = $param[0];
			if (isset($param[1])) {
				$action = $param[1];
			} else {
				$action = 'index';
			}
			// Chargement du controlleur
			require_once('controlleur/'.$controller.'.ctrl.php');
			// Nomage de la classe du controlleur
			$controller = 'Ctrl'.$controller;
			// Intanciation du controlleur
			$controller = new $controller();		
			// Execution de l' $action du $controller avec les $param supplementaire si existant
			// Si $action existe dans $controller j'execute le code, sinon j'affiche un page error 404
			if (method_exists($controller,$action)) {
				// On enlève les indices 0 et 1 du tableau $param			
				unset($param[0]);
				unset($param[1]);
				// On execute $action de $controller avec $param en paramètre
				call_user_func_array(array($controller,$action), $param);
			// Sinon $action non présente dans $controller
			} else {
				// Page 404
				// j'ai mis ici mauvais action pour m'aider pour le debuggage
				echo 'erreur 404 (mauvaise action)';
			}
		} else {
			// j'ai préciser ici mauvais controller pour m'aider lors du debuggage
			echo 'erreur 404 (mauvais controlleur)';
		}


		
	 ?>

</main>
<!-- <div class="container-fluid cookies1">
        <div class="container">
            <span>We collect and use cookies to give you the best and most relevant website experience. Kindly accept the cookies.<a href="/privacy-policy" class="">Privacy Policy</a></span>
            <span class="accept"><a href="" class="btn btn-primary" onclick="setCookies();">Accept</a></span>
            <span class=""><a href="#" class="close-div accept btn btn-primary" onclick="setCookies();">Accept</a></span>
        </div>
    </div> -->
<footer>

<?php
	require 'vue/footer.php';
?>

</footer>


	 <script src="<?= WEBROOT ?>js/script.js"></script>
	 <script>
	 	var url = "<?php echo $_SESSION['url']?>";
	 </script>
	<script>window.onload = changeUrl(url);</script>
	<script src="<?= WEBROOT ?>js/info.js"></script>
	<script type="text/javascript" src="<?= WEBROOT ?>js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?= WEBROOT ?>js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?= WEBROOT ?>js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?= WEBROOT ?>js/mdb.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script>
        new WOW().init();
    </script>
</body>
</html>