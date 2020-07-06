<?php 
require_once('modele/User.class.php');

class DaoUser {
    public function create($user) {
        DB::request('INSERT INTO user (pseudo,email,password) VALUES (?,?,?)', array($user->getPseudo(),$user->getEmail(),$user->getPassword()));
        $user->setId(DB::lastId());
        

        return $user;
    }

    public function read($id) {
        $donnees = DB::request('SELECT * FROM  user WHERE id = ?',array($id));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $user = new User(htmlentities($donnee['pseudo'],ENT_COMPAT),htmlentities($donnee['email'],ENT_COMPAT),htmlentities($donnee['password'],ENT_COMPAT));
                $user->setId(htmlentities($donnee['id'],ENT_COMPAT));
                $user->setLastName(htmlentities($donnee['lastname'],ENT_COMPAT));
                $user->setFirstName(htmlentities($donnee['firstname'],ENT_COMPAT));
                $user->setSex(htmlentities($donnee['sex'],ENT_COMPAT));
                $user->setBirthday(htmlentities($donnee['birthday'],ENT_COMPAT));
                $user->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
                $user->setAvatar(htmlentities($donnee['avatar'],ENT_COMPAT));
                $user->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
                $user->setToken(htmlentities($donnee['token'],ENT_COMPAT));
            }  
            return $user;
        } else {
            return null;
        }
    }
    
    
    public function readAll() {
        $donnees = DB::request('SELECT * FROM user '); 
        if(!empty($donnees)) {
            foreach($donnees as $key => $donnee){
                $tablUser[$key] = new User(htmlentities($donnee['pseudo'],ENT_COMPAT),htmlentities($donnee['email'],ENT_COMPAT), htmlentities($donnee['password'],ENT_COMPAT));
                $tablUser[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT));  
                $tablUser[$key]->setLastName(htmlentities($donnee['lastname'],ENT_COMPAT));
                $tablUser[$key]->setFirstName(htmlentities($donnee['firstname'],ENT_COMPAT));
                $tablUser[$key]->setSex(htmlentities($donnee['sex'],ENT_COMPAT));
                $tablUser[$key]->setBirthday(htmlentities($donnee['birthday'],ENT_COMPAT));
                $tablUser[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
                $tablUser[$key]->setAvatar(htmlentities($donnee['avatar'],ENT_COMPAT));
                $tablUser[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
                $tablUser[$key]->setToken(htmlentities($donnee['token'],ENT_COMPAT));
             }
            return $tablUser;
         } else {
             return null;
         }  
     }
     

     
    public function readByUsersReports($firstOfPage,$perPage) {
        $donnees = DB::request('SELECT COUNT(report.reportMessage) as nbReport, user.id, user.pseudo,user.password,user.avatar,user.statut,user.email,user.archive
        FROM report
        left JOIN user ON report.reported_user_id = user.id
        WHERE user.id IS NOT NULL 
           GROUP BY  user.id ORDER BY nbReport  DESC LIMIT '.$firstOfPage.','.$perPage.''); 
        if(!empty($donnees)) {
            foreach($donnees as $key => $donnee){
                $tablUser[$key] = new User(htmlentities($donnee['pseudo'],ENT_COMPAT), htmlentities($donnee['email'],ENT_COMPAT), htmlentities($donnee['password'],ENT_COMPAT));
                $tablUser[$key]->setId(htmlentities($donnee['id'],ENT_COMPAT));       
                $tablUser[$key]->setEmail(htmlentities($donnee['email'],ENT_COMPAT));
                $tablUser[$key]->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
                $tablUser[$key]->setAvatar(htmlentities($donnee['avatar'],ENT_COMPAT));   
                $tablUser[$key]->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));    
             }

            return $tablUser;
         } else {
             return null;
         }    
     }
    
    public function readByEmail($email) {
    $donnees = DB::request('SELECT * FROM user WHERE email = ?', array($email));
    if (!empty($donnees)) {
     foreach ($donnees as $key => $donnee) {
                $user = new User(htmlentities($donnee['pseudo'],ENT_COMPAT), htmlentities($donnee['email'],ENT_COMPAT), htmlentities($donnee['password'],ENT_COMPAT));
                $user->setId(htmlentities($donnee['id'],ENT_COMPAT));
                $user->setLastName(htmlentities($donnee['lastname'],ENT_COMPAT));
                $user->setFirstName(htmlentities($donnee['firstname'],ENT_COMPAT));
                $user->setSex(htmlentities($donnee['sex'],ENT_COMPAT));
                $user->setBirthday(htmlentities($donnee['birthday'],ENT_COMPAT));
                $user->setArchive(htmlentities($donnee['archive'],ENT_COMPAT));
                $user->setAvatar(htmlentities($donnee['avatar'],ENT_COMPAT));
                $user->setStatut(htmlentities($donnee['statut'],ENT_COMPAT));
                $user->setToken(htmlentities($donnee['token'],ENT_COMPAT));
            }
            return $user;
        } else {
            return null;
        }
    }


    public function update($user){
        DB::request('UPDATE user SET firstname = ?,lastname = ?, pseudo = ?, email = ?,password = ?, sex =?, birthday = ?, avatar = ?, statut = ? , token = ? , archive = ? WHERE id = ?', array(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getPseudo(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getSex(),
            $user->getBirthday(),
            $user->getAvatar(),
            $user->getStatut(),
            $user->getToken(),
            $user->getArchive(),
            $user->getId()
         )
        );
    }
  
    public function archive($id,$archive) {
        DB::request('UPDATE user SET archive = ? WHERE id = ?', array($archive, $id));
    }
   
    public function admin($id,$statut) {
        DB::request('UPDATE user SET statut = ? WHERE id = ?', array($statut, $id));
    }
   

    
    // on ne supprime jamais un utilisateur -> on archive toujours les données
    public function delete($id) {
        DB::request('DELETE FROM user WHERE id = ?', array($id));

    }


    public function countUser(){
        $donnees = DB::request('SELECT COUNT(id) FROM user');
        if(!empty($donnees)) {
            return $donnees[0]['COUNT(id)'];
         } else {
             return null;
         }
     }

}

 ?>
