<?php

class CtrlArticle extends Controller {

public function index(){    
    $this->info('Page Index','Listes des bons plans');
    $this->loadDao('Article');
    $this->loadDao('User');

  
        $tabArticles = $this->DaoArticle->readAll();

        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){

                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo())); 
             }
            
          }
       
        $d['tabArticles'] = $tabArticles;
       
        $this->set($d);
        $this->render('Article','index');
}


public function allArticles($current=null){ 
    $this->info('Administration','Listes articles signalés');
    if($_SESSION['statut'] == 1){
        $this->loadDao('Article');
        $this->loadDao('User');
        $this->loadDao('Report');
        $perPage = 15;
        $total = $this->DaoReport->countArticleReported();
        $nbPage = ceil($total/$perPage);
        if($current == null or $current > $nbPage){
            $current = 1;
        }
        $firstOfPage = ($current-1)*$perPage;
        $tabArticles = $this->DaoArticle->readByArticleReports($firstOfPage, $perPage);
        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){

                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));
                 
             }
            
          }
          $d['nbPage'] = $nbPage;
          $d['total'] = $total;
          $d['current'] = $current;
        $d['tabArticles'] = $tabArticles;
       
        $this->set($d);
        $this->render('Article','allArticles');
} else {
$d['log'] = "<font color=\"red\"> Seuls les administrateurs ont acces à cette page ! </font>";
$this->set($d);
$this->render('Article','allArticles');
}	


}



public function accueil(){
    $this->info('Accueil','Home');  
   
    $this->loadDao('Article');
    $this->loadDao('User');
   
        $tabArticles = $this->DaoArticle->readByThree();

        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){
            
                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));   
                // $count = $this->DaoVote->count($tabArticles[$key]->getId());
               
             }   
          } 

        $d['tabArticles'] = $tabArticles;
        
        
        $this->set($d);
        $this->render('Article','accueil');


}	

public function news($current=null){    
    $this->info('Nouveautés','Les bons plans les plus récents');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Vote');
    $perPage = 9;
    $total = $this->DaoArticle->countArticle();
    $nbPage = ceil($total/$perPage);
    if($current == null or $current > $nbPage){
        $current = 1;
    }
    $firstOfPage = ($current-1)*$perPage;
        $tabArticles = $this->DaoArticle->readByDate($firstOfPage,$perPage);

        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){          
                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));              
             }   
          } 
          $d['nbPage'] = $nbPage;
          $d['total'] = $total;
          $d['current'] = $current;
        $d['tabArticles'] = $tabArticles;
 
        $this->set($d);
        $this->render('Article','news');
    } 


public function cat($category=null,$current=null){   
    $this->info('Affichage selon la catégorie','Bons plans selon catégorie'); 
    $this->loadDao('Article');
    $this->loadDao('User');

    $perPage = 9;
    $total = $this->DaoArticle->countArticleCat($category);
    $nbPage = ceil($total/$perPage);

    if($current == null or $current > $nbPage){
        $current = 1;
    }
    $firstOfPage = ($current-1)*$perPage;

        $tabArticles = $this->DaoArticle->readByCat($firstOfPage,$perPage,$category);

        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){

                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));
                
             }
            
          }
        
          $d['nbPage'] = $nbPage;
          $d['total'] = $total;
          $d['current'] = $current;
        $d['tabArticles'] = $tabArticles;
       
        $this->set($d);
        $this->render('Article','cat', $category);
    }

    public function bestseller($current=null){
        $this->info('Bestseller','Les articles les plus appréciés');
        $this->loadDao('Article');
        $this->loadDao('User');
        $this->loadDao('Vote');

        $perPage = 9;
        $total = $this->DaoVote->countVote();
        $nbPage = ceil($total/$perPage);

        if($current == null or $current > $nbPage){
            $current = 1;
        }
        $firstOfPage = ($current-1)*$perPage;

        $tabArticles = $this->DaoArticle->readByVote($firstOfPage,$perPage); 
        
        if(!empty($tabArticles)) {
            foreach($tabArticles as $key => $article){

                $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));
                
             }
            
          }
          
          $d['nbPage'] = $nbPage;
          $d['total'] = $total;
          $d['current'] = $current;
        $d['tabArticles'] = $tabArticles;
       
        $this->set($d);
        $this->render('Article','bestseller');
    }

    // public function getIp(){
    //     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    //       $ip = $_SERVER['HTTP_CLIENT_IP'];
    //     }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    //       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     }else{
    //       $ip = $_SERVER['REMOTE_ADDR'];
    //     }
    //     return $ip;
    //   }


        // setcookie('consultation'.$id,$article->getTitle(),strtotime("+1 year"));
public function single($id){
    $this->info('Page détail','Détails du bon plans');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Comment');
    $this->loadDao('Vote');
         $article = $this->DaoArticle->read($id);
                   $user = $this->DaoUser->read($article->getUserPseudo());
                   $article->setUserPseudo($user);
                   $d['article'] = $article;
                  $d['note'] = $this->DaoVote->count($id);
       $d['tabComment'] = $this->DaoComment->readByArticle($article->getId());
        $this->set($d);
        $this->render('Article','single',$id);
    } 
 

public function create(){
    $this->info('Créations','Création de bons plans');
    if (isset($_SESSION['id'])) {
    if (!empty($this->input)) {
        $this->loadDao('Article');      
        $title = filter_var($this->input['title'], FILTER_SANITIZE_STRING);
        $urlseller = filter_var($this->input['urlseller'], FILTER_SANITIZE_URL);
        $title = filter_var($this->input['title'], FILTER_SANITIZE_STRING);
        $userpseudo = $_SESSION['id'];
        $cost = filter_var($this->input['cost'], FILTER_SANITIZE_NUMBER_INT);  
        $info = filter_var($this->input['info'], FILTER_SANITIZE_STRING);
        $category = filter_var($this->input['category'], FILTER_SANITIZE_STRING);
        $imageParDefaut =  "img/article/article.png";
        $article = new Article ($title, $userpseudo, $urlseller, $cost, $info, $category);
        $article = $this->DaoArticle->create($article);
        if(isset($this->files['img']) AND !empty($this->files['img']['name'])) {
            $tailleMax = 5097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($this->files['img']['size'] <= $tailleMax) {        
               $extensionUpload = strtolower(substr(strrchr($this->files['img']['name'], '.'), 1));
               if(in_array($extensionUpload, $extensionsValides)) {          
                  $chemin = "img/article/".$article->getId().".".$extensionUpload;
                  $resultat = move_uploaded_file($this->files['img']['tmp_name'], $chemin);
                  if($resultat) {               
                    $article->setImg($chemin);                
                  } else {
                    $d['log'] = "Erreur durant l'importation de votre photo de profil";
                  }
               } else {
                $d['log'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
               }
            } else {
                $d['log'] = "Votre photo de profil ne doit pas dépasser 2Mo";
            }
         } else {
            $article->setImg($imageParDefaut);
         }
        $this->DaoArticle->update($article);
        $this->single($article->getId());
    } else {
        $this->render('Article','create');
    }   
}else {
    $d['log'] = ' <font color="red"> Il faut vous connecté pour poster un article <font>';
    $this->set($d); 
$this->render('User','logIn');
}}

public function update($id){
    $this->info('Modification','Modification d\'un bons plans');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Comment');
    if (!empty($this->input)) {   
        if (isset($_SESSION['id'])) {      
            $article = $this->DaoArticle->read($id);
            $title = filter_var($this->input['title'], FILTER_SANITIZE_STRING);
            $urlseller = filter_var($this->input['urlseller'], FILTER_SANITIZE_URL);
            $cost = filter_var($this->input['cost'], FILTER_SANITIZE_NUMBER_INT);  
            $info = filter_var($this->input['info'], FILTER_SANITIZE_STRING);
            $category = filter_var($this->input['category'], FILTER_SANITIZE_STRING);      
            if(isset($this->files['img']) AND !empty($this->files['img']['name'])) {
                $tailleMax = 5097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if($this->files['img']['size'] <= $tailleMax) {        
                   $extensionUpload = strtolower(substr(strrchr($this->files['img']['name'], '.'), 1));
                   if(in_array($extensionUpload, $extensionsValides)) {
                       
                      $chemin = "img/article/".$article->getId().".".$extensionUpload;
                      $resultat = move_uploaded_file($this->files['img']['tmp_name'], $chemin);
                      if($resultat) {          
                        $article->setImg($chemin);                        
                      } else {
                        $d['log'] = "Erreur durant l'importation de votre photo de profil";
                      }
                   } else {
                    $d['log'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                   }
                } else {
                    $d['log'] = "Votre photo de profil ne doit pas dépasser 2Mo";
                }
             }
            $article->setTitle($title);
            $article->setUrlseller($urlseller);
            $article->setCost($cost);     
            $article->setInfo($info);
            $article->setCategory($category);
           
        $this->DaoArticle->update($article);

                $this->single($id);
        } 
                        
             } else {
                $d['article'] = $this->DaoArticle->read($id);
                $this->set($d);
                $this->render('Article','update',$id); 
             }
        }


public function delete($id){
    $this->info('Suppresion','Suppression d\'un bons plans');
$this->loadDao('Article');
$this->loadDao('User');
$this->DaoArticle->delete($id);
if($_SESSION['statut']==1){
    $this->allArticles();
}else{
    $this->news();
}
        }




        public function archive($id){
            $this->info('Désactivation article  ','article désactivé');
            $this->loadDao('Article');
            
            $this->DaoArticle->archive($id,'1');
            if($_SESSION['statut'] == 1){
            $this->news();
        }  else { $this->news();
    
        }
    }


    public function desarchive($id){
        $this->info('Désactivation article  ','article désactivé');
        $this->loadDao('Article');
        if($_SESSION['statut'] == 1){
        $this->DaoArticle->archive($id,'0');
	 
        $this->news();
    }  else { $this->news();

    }
}


public function like($articleId){
    $this->loadDao('Vote');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Comment');
 
    if (isset($_SESSION['id'])) {
        $verif = $this->DaoVote->verif($articleId,$_SESSION['id']);
        if(empty($verif)){
         
        $userId = $_SESSION['id'];  
        $vote = new Vote ($userId,$articleId, 1); 
        $tabVote = $this->DaoVote->vote($vote);
        $article = $this->DaoArticle->read($articleId);
                   $user = $this->DaoUser->read($article->getUserPseudo());
                   $article->setUserPseudo($user);

                  $d['article'] = $article;

       $d['tabComment'] = $this->DaoComment->readByArticle($article->getId());

    $d['log'] = '  Vote pris en compte';
    $count = $this->DaoVote->count($articleId);
    if(isset($note)){
        $d['note'] = $count;
    }
    $this->set($d);
    $this->render('Article','single',$articleId);
    }else{
        $article = $this->DaoArticle->read($articleId);
                   $user = $this->DaoUser->read($article->getUserPseudo());
                   $article->setUserPseudo($user);

                  $d['article'] = $article;

       $d['tabComment'] = $this->DaoComment->readByArticle($article->getId());

    $d['log'] = '  Vous avez déja voté';

    $this->set($d);
    $this->render('Article','single',$articleId);
}   
 } else {

    $d['log'] = ' <p class="blink"> Il faut vous connecté pour voter </p>';
    $this->set($d); 
    $this->render('User','logIn');
} }



public function reportArticle($articleId,$raison){
    $this->loadDao('Vote');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Comment');
    $this->loadDao('Report');
   
    if (isset($_SESSION['id'])) {
        $verif = $this->DaoReport->verifReportArticle($_SESSION['id'],$articleId);
        if(empty($verif)){
         $this->loadDao('Vote');  
        $userId = $_SESSION['id'];  
        $report = new Report ($userId,$articleId, $raison); 
        $tabReport = $this->DaoReport->reportArticle($report);
        $article = $this->DaoArticle->read($articleId);
                   $user = $this->DaoUser->read($article->getUserPseudo());
                   $article->setUserPseudo($user);
                  $d['article'] = $article;
       $d['tabComment'] = $this->DaoComment->readByArticle($article->getId());

    $d['log'] = '  Signalement pris en compte';
    $count = $this->DaoReport->count($articleId);
    if(isset($note)){
        $d['note'] = $count;
    }
    $this->set($d);
    $this->render('Article','single',$articleId);
        

    }else{
        $article = $this->DaoArticle->read($articleId);
                   $user = $this->DaoUser->read($article->getUserPseudo());
                   $article->setUserPseudo($user);

                  $d['article'] = $article;

       $d['tabComment'] = $this->DaoComment->readByArticle($article->getId());

    $d['log'] = '  Vous avez déja signalé cet article';

    $this->set($d);
    $this->render('Article','single',$articleId);
}   
 } else {

    $d['log'] = ' <p class="blink"> Il faut vous connecté pour signaler </p>';
    $this->set($d); 
    $this->render('User','logIn');
} }



public function reportUser($reportedUserId,$raison){
    $this->loadDao('Vote');
    $this->loadDao('Article');
    $this->loadDao('User');
    $this->loadDao('Comment');
    $this->loadDao('Report');
   
    if (isset($_SESSION['id'])) {
        $verif = $this->DaoReport->verifReportUser($_SESSION['id'],$reportedUserId);
        if(empty($verif)){  
        $userId = $_SESSION['id'];  
        $report = new Report ($userId,$reportedUserId, $raison); 
        $tabReport = $this->DaoReport->reportUser($report);
            $d['user'] = $this->DaoUser->read($reportedUserId);
            $d['log'] = ' <p class="blink"> Signalement pris en compte</p>';
            $this->set($d);
            $this->render('User','profilUser',$reportedUserId);    	
		}else{ 
            $d['user'] = $this->DaoUser->read($reportedUserId);
            $d['log'] = '<p class="blink">Vous avez déja signaler cet utilisateur</p>';
            $this->set($d);
            $this->render('User','profilUser',$reportedUserId);   }

    } else {

        $d['log'] = ' <p class="blink"> Il faut vous connecté pour signaler </p>';
        $this->set($d); 
        $this->render('User','logIn');
    } 
 }



public function commentCreate(){
    if (isset($_SESSION['id'])) {
    if (!empty($this->input)) {
        $this->loadDao('Comment');
        $this->loadDao('User');
        $this->loadDao('Article');
        $userId = $this->input['userId'];
        $articleId = $this->input['articleId'];
                 // Supprime les entités HTML
        $message =filter_var($this->input['message'], FILTER_SANITIZE_STRING);
        $comment = new Comment ($userId,$articleId, $message);
        // j'ai mis l'articleId en argument ici + dans la dao comment aussi pour pouvoir récuperer l'article Id dans la base de données 
        //changement ici aussi samedi
        $comment = $this->DaoComment->create($comment);
        // $this->render('Article','single',$articleId); 
       $this->single($articleId);
         // remettre le headerlocation (j'ai remis le render car ça m'afficher un message d'erreur, à la base vincent m'avait dis met un header location)
        // header('Location:'.WEBROOT. 'Article/single/'.$articleId);
    } else {
        $this->render('Article','single',$articleId);
    }   
}else {
    $d['log'] = ' <font color="red"> Il faut vous connecté pour poster un commentaire <font>';
    $this->set($d); 
    $this->render('User','logIn');
}}

public function commentDelete($id,$articleId){
$this->loadDao('Comment');
$this->loadDao('Article');
$this->loadDao('User');
$this->DaoComment->delete($id);
$d['log'] = "commentaire supprimé";
$this->single($articleId);
}



    public function allArchivedArticles($current=null){ 
        $this->info('Administration','Listes articles signalés');
        if($_SESSION['statut'] == 1){
            $this->loadDao('Article');
            $this->loadDao('User');
         
            $perPage = 15;
            $total = $this->DaoArticle->countArticleArchived();
            $nbPage = ceil($total/$perPage);
            if($current == null or $current > $nbPage){
                $current = 1;
            }
            $firstOfPage = ($current-1)*$perPage;
            $tabArticles = $this->DaoArticle->readByArchive($firstOfPage, $perPage);
            if(!empty($tabArticles)) {
                foreach($tabArticles as $key => $article){
    
                    $tabArticles[$key]->setUserPseudo($this->DaoUser->read($article->getUserPseudo()));
                     
                 }
                
              }
              $d['nbPage'] = $nbPage;
              $d['total'] = $total;
              $d['current'] = $current;
            $d['tabArticles'] = $tabArticles;
           
            $this->set($d);
            $this->render('Article','allArchivedArticles');
    } else {
    $d['log'] = "<font color=\"red\"> Seuls les administrateurs ont acces à cette page ! </font>";
    $this->set($d);
    $this->render('Article','news');
    }	
    
    
    }





}
?>