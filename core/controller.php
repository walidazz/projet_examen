<?php 
class Controller {
	public $input;
	public $files;
	private $vars = array();

	public function __construct() {
		// Si le controlleur reçois un $_POST
		if (isset($_POST)) {
			// Affectation de $_POST à l'attribut $input
			$this->input = $_POST;
		}
		if (isset($_FILES)) {
			$this->files = $_FILES;
		}
	}

	function loadDao($name) {
		require_once('dao/'.$name.'.dao.php');
		$daoClass = 'Dao'.$name;
		$this->$daoClass = new $daoClass();
	}

	function set($d) {
		
		$this->vars = array_merge($this->vars, $d);
	}

	function render($entity, $viewFile,$param = null) {
		
			// Extraction de $vars
			// permet le passage de $d['maVar'] = value (côté controlleur) à $maVar = value (côté vue)
			extract($this->vars);
			// Démarrage de la mémoire tempon
			ob_start();
		
			require_once('vue/'.$entity.'/'.$viewFile.'.php');
			// Vide la mémoire tempon et affecte le contenue dans $content
			$content = ob_get_clean();

			echo $content;
			// Execution de saveUrl 
			$this->saveUrl($entity, $viewFile,$param);
	}

	function saveUrl($ctrl,$vue,$param = null) {
		// Affectation a la variable de session url, l'url à sauvegarder
		$_SESSION['url'] = $ctrl.'/'.$vue.'/'.$param;
	}

	function info($title,$description) {
		$info = json_encode(array(
	 		"title" => $title,
	 		"description" => $description
	 	));
	 	file_put_contents(ROOT.'js/info.json', $info);
	}

}

 ?>