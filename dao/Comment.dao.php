<?php
require_once('modele/Comment.class.php');

class DaoComment {
    public function create($comment){
        DB::request('INSERT INTO comment (user_id, article_id, message) VALUES (?,?,?)', array($comment->getUserId(),$comment->getArticleId(), $comment->getMessage()));
        $comment->setId(DB::lastId());
        return $comment;
        }
        
        
    public function read($id){
        $donnees = DB::request('SELECT * FROM comment WHERE id = ? LIMIT 50 ', array($id));

        if (!empty($donnees)) {
    foreach ($donnees as $key => $donnee){
        $comment = new Comment(htmlentities($donnee['user_id'],ENT_COMPAT), htmlentities($donnee['article_id'], ENT_COMPAT), htmlentities($donnee['message'],ENT_COMPAT));
    $comment->setId(htmlentities($donnee['id'],ENT_COMPAT));   
    }
    return $comment;
        } else {
                return null;
        }
    }


 public function update($comment){
    DB::request('UPDATE article SET message = ?  WHERE id = ?', array(
        $comment->getMessage(),
        $comment->getId()
     )
    );
}

public function delete($id) {
    DB::request('DELETE FROM comment WHERE id = ?', array($id));
}

public function readByArticle($article){

    $donnees = DB::request('SELECT comment.id AS comment_id,user_id,article_id,message,user.id,user.avatar,user.pseudo FROM comment LEFT JOIN user ON comment.user_id = user.id  WHERE comment.article_id = ? ORDER BY date_time_publication DESC', array($article));
  
    if(!empty($donnees)) {
        foreach($donnees as $key => $donnee){
            $tabComment[$key]= new Comment(htmlentities($donnee['user_id'],ENT_COMPAT) , htmlentities($donnee['article_id'],ENT_COMPAT), htmlentities($donnee['message'], ENT_COMPAT));
            $tabComment[$key]->setId(htmlentities($donnee['comment_id'],ENT_COMPAT));
            $tabComment[$key]->setUserPseudo(htmlentities($donnee['pseudo'],ENT_COMPAT));
            $tabComment[$key]->setUserAvatar(htmlentities($donnee['avatar'],ENT_COMPAT));


         }
        return $tabComment;
     } else {
         return null;
     }  
 }


//  public function archive($id,$archive) {
//     DB::request('UPDATE comment SET archive = ? WHERE id = ?', array($archive, $id));
// }


}




?>