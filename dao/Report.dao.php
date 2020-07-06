<?php
require_once('modele/Report.class.php');

class DaoReport {


    public function reportArticle($report){
 
        $donnees = DB::request('INSERT INTO report (reporter,reported_article_id, reportMessage) VALUES (?,?,?)', array($report->getReporter(),$report->getReported(), $report->getReportMessage()));
        $report->setId(DB::lastId());

        if(!empty($donnees)) {
            foreach($donnees as $key => $donnee){
                $tabReport[$key]= new Report(htmlentities($donnee['reporter'],ENT_COMPAT) , htmlentities($donnee['reported_article_id'],ENT_COMPAT), htmlentities($donnee['reportMessage'],ENT_COMPAT));
                $tabReport[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT));  
             }
            return $tabReport;
         } else {
             return null;
         }  

        return $donnees;
        }

        public function reportUser($report){
 
            $donnees = DB::request('INSERT INTO report (reporter,reported_user_id, reportMessage) VALUES (?,?,?)', array($report->getReporter(),$report->getReported(), $report->getReportMessage()));
            $report->setId(DB::lastId());
            if(!empty($donnees)) {
                foreach($donnees as $key => $donnee){
                    $tabReport[$key]= new Report(htmlentities($donnee['reporter'],ENT_COMPAT) , htmlentities($donnee['reported_user_id'],ENT_COMPAT), htmlentities($donnee['reportMessage'],ENT_COMPAT));
                    $tabReport[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT));  
                 }
                return $tabReport;
             } else {
                 return null;
             }  
    
            return $donnees;
            }
    







            public function verifReportArticle($reporter,$reported){

                $donnees = DB::request('SELECT reporter FROM report WHERE reported_article_id = '.$reported.' AND reporter ='.$reporter.'');
                
                    return $donnees;
                 } 
             
                 public function verifReportUser($reporter,$reported){

                    $donnees = DB::request('SELECT reporter FROM report WHERE reported_user_id = '.$reported.' AND reporter ='.$reporter.'');
                    
                        return $donnees;
                     } 
                 

                     public function readAllUsersReported(){

                        $donnees = DB::request('SELECT * FROM article WHERE archive = 0 LIMIT 50');
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
                    




//  public function read($reported){

//         $donnees = DB::request('SELECT vote FROM vote WHERE reported_user_id OR reported_article_id = '.$reported.'');
        
//         if(!empty($donnees)) {
 
//             return $donnees;
//          } else {
//              return null;
//          }
//      }

     public function count($reported){
        $donnees = DB::request('SELECT COUNT(reportMessage) FROM report WHERE reported_article_id OR reported_user_id = '.$reported.' AND reportMessage IS NOT NULL');
        if(!empty($donnees)) {
 
            return $donnees[0]['COUNT(reportMessage)'];
         } else {
             return null;
         }
     }

public function countUserReported(){
    $donnees = DB::request('SELECT COUNT(reported_user_id) FROM report ');
    if(!empty($donnees)) {

        return $donnees[0]['COUNT(reported_user_id)'];
     } else {
         return null;
     }
}
public function countArticleReported(){
    $donnees = DB::request('SELECT COUNT(reported_article_id) FROM report ');
    if(!empty($donnees)) {

        return $donnees[0]['COUNT(reported_article_id)'];
     } else {
         return null;
     }
}
     

}


?>