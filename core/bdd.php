<?php 
  // déclaration de constantes
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'projet');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');


// Déclaration de l'objet DB
class DB {
  // Attibut statique (qui peut etre utilisé sans intancier l'objet, pas besoin de new DB)
  private static $db;
  
  // déclaration de la fonction statique connect
  public static function connect(){
        // Si l'attribut statique $db de cette objet (self) est vide, :: sert à ciblé un element statique d'un objet
        if(empty(self::$db)){
            self::$db = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", 
            DB_USER, DB_PASS, [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_EMULATE_PREPARES => false,
            ]
          );  
        }
        return self::$db;
    }

    // Declaration de la methode statique select qui prend 2 arguments, une requete sql et un tableau de paramètre (qui peut etre null)
    
   

  public static function request($sql, $param=null) {
    $result = false;
    try {
      $request = self::connect()->prepare($sql);
      $request->execute($param);
      
      $result = $request->fetchAll();
      
    } catch (PDOException $ex) { die($ex->getMessage()); }
      $request = null;
    return $result;
  }

  public static function lastId() {
    return self::connect()->lastInsertId();
  }

 
}
