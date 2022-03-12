<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {



// chercher un utilisateur par son id
	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		$user = $userRepository->findOneBy(array('id' => $id));	

		return $user; 
	}


   // chercher un utilisateur par son pseudo et mot de passe
  public static function getUserByLoginAndPass($login,$pass)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$userRepository = $em->getRepository('utilisateur');
	$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	
	
	if ($user == false){
		echo 'Erreur sql';
			   }
	return $user; 
	}



	public static function getUserByIdentifiant($identifiant)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		$user = $userRepository->findOneBy(array('identifiant' => $identifiant));

		return $user; 
	}

	public static function getUserByLogin($login)
    {
          $em = dbconnection::getInstance()->getEntityManager() ;

        $userRepository = $em->getRepository('utilisateur');
        $user = $userRepository->findOneBy(array('identifiant' => $login));

        return $user; 
    }

// pour ajouter user 
	public static function addUser($nom, $prenom, $login, $password)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
        $utilisateur = new utilisateur();
        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->identifiant = $login;
        $utilisateur->pass = sha1($password);
        $user = $em->persist($utilisateur);
        $em->flush();
        return $user;
	}

  
}


?>
