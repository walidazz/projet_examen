<?php
require_once('modele/Article.class.php');

class DaoArticle {


public function create($article){
    
DB::request('INSERT INTO article (title, user_id, urlseller, cost, info, category) VALUES (?,?,?,?,?,?)', array($article->getTitle(),$article->getUserPseudo(), $article->getUrlseller(), $article->getCost(), $article->getInfo(),$article->getCategory()));
$article->setId(DB::lastId());
return $article;
}

public function read($id){
    $donnees = DB::request('SELECT * FROM article WHERE id = ? AND archive = 0 ', array($id));
    if (!empty($donnees)) {
foreach ($donnees as $key => $donnee){
    $article = new Article(htmlentities($donnee['title'],ENT_COMPAT),htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT),htmlentities($donnee['category'],ENT_COMPAT));
$article->setId(htmlentities($donnee['id'],ENT_COMPAT));
$article->setImg(htmlentities($donnee['img'],ENT_COMPAT));
$article->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
$article->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
}
return $article;
    }else{
            return null;
    }
}


public function readAll(){
    $donnees = DB::request('SELECT * FROM article WHERE archive = 0 LIMIT 100');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT),htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  
 }

 public function readByThree(){

    $donnees = DB::request('SELECT * FROM article WHERE archive = 0 ORDER BY date_time_publication DESC LIMIT 3');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
  
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  
 }









 public function readByDate($firstOfPage,$perPage){

    $donnees = DB::request('SELECT * FROM article WHERE archive = 0 ORDER BY date_time_publication DESC LIMIT '.$firstOfPage.','.$perPage.'');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article( htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT));   
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  }

public function readByVote($firstOfPage,$perPage){
    $donnees = DB::request('SELECT COUNT(vote.id) as nbVote, article.id, article.title,article.user_id,article.cost,article.info,article.category,article.img,article.statut,article.urlseller,article.archive
    FROM vote
    left JOIN article ON vote.article_id = article.id

    WHERE vote.vote > 0 AND archive = 0 
       GROUP BY  article.id ORDER BY nbVote DESC LIMIT '.$firstOfPage.','.$perPage.'');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article( htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory( htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  }
    
  
public function readByArticleReports($firstOfPage,$perPage){
    $donnees = DB::request('SELECT COUNT(report.reportMessage) as nbReport, article.id, article.title,article.user_id ,article.cost,article.info,article.category,article.img,article.statut,article.urlseller,article.archive
    FROM report
    left JOIN article ON report.reported_article_id = article.id

    WHERE article.id IS NOT NULL AND archive = 0
       GROUP BY  article.id ORDER BY nbReport DESC LIMIT '.$firstOfPage.','.$perPage.'');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
   
         }
        return $tabArticle;
     } else {
         return null;
     }  }
    






public function readByCat($firstOfPage,$perPage,$category){

    $donnees = DB::request('SELECT * FROM article WHERE category = ? AND archive = 0 ORDER BY date_time_publication DESC LIMIT '.$firstOfPage.','.$perPage.'', [
        $category
    ]);
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  }



 public function update($article){
    DB::request('UPDATE article SET title = ?, urlseller = ?, cost = ?, info = ? , category = ?, img = ?  WHERE id = ?', array(
        $article->getTitle(),
        $article->getUrlseller(),
        $article->getCost(),
        $article->getInfo(),
        $article->getCategory(),
        $article->getImg(),
        $article->getId()
     )
    );
}
  

   public function archive($id,$archive) {
    DB::request('UPDATE article SET archive = ? WHERE id = ?', array($archive, $id));
}

public function delete($id) {
    DB::request('DELETE FROM article WHERE id = ?', array($id));
}


public function countArticle(){
    $donnees = DB::request('SELECT COUNT(id) FROM article');
    if(!empty($donnees)) {
        return $donnees[0]['COUNT(id)'];
     } else {
         return null;
     }
 }
 

 public function countArticleCat($cat){
    $donnees = DB::request('SELECT COUNT(id) FROM article WHERE category = "'.$cat.'"');
    if(!empty($donnees)) {
        return $donnees[0]['COUNT(id)'];
     } else {
         return null;
     }
 }

 
 public function countArticleArchived(){
    $donnees = DB::request('SELECT COUNT(id) FROM article WHERE archive = 1');
    if(!empty($donnees)) {
        return $donnees[0]['COUNT(id)'];
     } else {
         return null;
     }
 }



//  public function readByArchive(){
//     $donnees = DB::request('SELECT * FROM article WHERE archive = 1 ORDER BY date_time_publication ');
//     if(!empty($donnees)) {
//         foreach($donnees as $key => $donnee){
//             $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
//             $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
//             $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
//             $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
//             $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
//             $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
//             $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
//          }
//         return $tabArticle;
//      } else {
//          return null;
//      }  
//  }


public function readByArchive($firstOfPage,$perPage){

    $donnees = DB::request('SELECT * FROM article WHERE archive = 1  ORDER BY date_time_publication DESC LIMIT '.$firstOfPage.','.$perPage.'');
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabArticle[$key]= new Article(htmlentities($donnee['title'],ENT_COMPAT), htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['urlseller'],ENT_COMPAT), htmlentities($donnee['cost'],ENT_COMPAT), htmlentities($donnee['info'],ENT_COMPAT), htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT)); 
            $tabArticle[$key]->setUserPseudo(htmlentities($donnee['user_id'],ENT_COMPAT));
            $tabArticle[$key]->setCategory(htmlentities($donnee['category'],ENT_COMPAT));
            $tabArticle[$key]->setImg(htmlentities($donnee['img'],ENT_COMPAT)); 
            $tabArticle[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
            $tabArticle[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
         }
        return $tabArticle;
     } else {
         return null;
     }  }





}












































?>