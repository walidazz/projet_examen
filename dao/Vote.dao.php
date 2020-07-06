<?php
require_once('modele/Vote.class.php');

class DaoVote {


    public function vote($vote){
 
        $donnees = DB::request('INSERT INTO vote (user_id, article_id, vote) VALUES (?,?,?)', array($vote->getUserId(),$vote->getArticleId(), $vote->getVote()));
        $vote->setId(DB::lastId());

        if(!empty($donnees)) {
            foreach($donnees as $key => $donnee){
                $tabVote[$key]= new Vote(htmlentities($donnee['user_id'],ENT_COMPAT) , htmlentities($donnee['article_id'],ENT_COMPAT), htmlentities($donnee['vote'],ENT_COMPAT));
                $tabVote[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT));  
             }
            return $tabVote;
         } else {
             return null;
         }  

        return $donnees;
        }



  public function verif($article,$userId){

        $donnees = DB::request('SELECT user_id FROM vote WHERE article_id = '.$article.' AND user_id ='.$userId.'');
        
            return $donnees;
         } 
     
 public function read($article){
        $donnees = DB::request('SELECT vote FROM vote WHERE article_id = '.$article.'');
        if(!empty($donnees)) {
            return $donnees;
         } else {
             return null;
         }
     }

     public function count($article){
        $donnees = DB::request('SELECT COUNT(vote) FROM vote WHERE article_id = '.$article.' AND vote = 1');
        if(!empty($donnees)) {
            return $donnees[0]['COUNT(vote)'];
         } else {
             return null;
         }
     }

     public function countVote(){
        $donnees = DB::request('SELECT COUNT(article_id) FROM vote WHERE vote = 1');
        if(!empty($donnees)) {
            return $donnees[0]['COUNT(article_id)'];
         } else {
             return null;
         }
     }


     

}


?>