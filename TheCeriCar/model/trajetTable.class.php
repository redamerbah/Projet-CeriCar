<?php

require_once "trajet.class.php";

class trajetTable {

// pour recuperer la liste des villes et les mettres dans la liste déroulate
  public static function getVilles(){
  $em = dbconnection::getInstance()->getEntityManager() ;
  $qb = $em->createQueryBuilder();
  $query = $qb->select('t.depart ville')
         ->from(trajet::class, 't')->distinct()->orderBy('t.depart')->getQuery();
  $villes = $query->execute();
  return $villes;
}


// cherecher by dep et arr
  public static function getTrajet($depart,$arrivee)
  {
    $em = dbconnection::getInstance()->getEntityManager();
    if($em == null)
      return 'Erreur : La connection à la BDD a échouée';

    $trajetRepository = $em->getRepository('trajet');
    if($trajetRepository == null)
      return "Erreur : La table 'trajet' n'existe pas";

    $trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));  
    
    return $trajet;
  }

  
}

?>