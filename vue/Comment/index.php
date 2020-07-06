<main>
<?php 
if(isset($log)) {
	echo $log;
} else {
	echo 'pas de log';
}

if(isset($tabComment)){

	foreach ($tabComment as $key => $comment) {

		  echo '<ul>';
		  echo '<img height="50px" width="50px" alt="image commentaire" src="'.WEBROOT.'img/article/'.$comment->getUserAvatar().'">';
		//   echo "<li>Article posté par : " .$article->getUserPseudo(). '<br>';
		  echo '<li><a href="'.WEBROOT. 'Article/single/'.$article->getId().'"> Voir l\'article </a> <br>';
		  echo "<li>Message: " . $comment->getMessage(). '<br>';
		
		  echo "<li>Pseudo : " .$comment->getUserAvatar(). '<br>';
		
		  if($_SESSION['statut'] == 1 ){
			echo '<a href="'.WEBROOT.'Comment/delete/'. $comment->getId().'"><button>Supprimer</Button></a>';
		  }
		
	}




}
?>


</main>