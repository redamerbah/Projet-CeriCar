<?php

require_once "voyage.class.php";

class voyageTable {

// on cherche un voyage par un trajet
  public static function getVoyagesByTrajet($trajet){
        $con = dbconnection::getInstance()->getEntityManager();
            $voyageRepository = $con->getRepository('voyage');
            $Listvoyages  = $voyageRepository->findBy(array('trajet' => $trajet));

            return $Listvoyages;    

}

// la fonction de l'etape 5 correspondance 
  public static function getCorrespondance($depart,$arrivee,$nbrvoyageurs){
    $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
    
     $query = $em->prepare(" select * from getcorespondance('{$depart}','{$arrivee}',{$nbrvoyageurs});");
     
     $bool = $query->execute();
     if ($bool == false){
       return NULL;
     }
     $voyages = $query->fetchAll();
     return $voyages; 
   }
// chercher un voyage par un id
   public static function getVoyageById($id){
    
    $em = dbconnection::getInstance()->getEntityManager() ;
    $voyageRepository = $em->getRepository('voyage');
    $voyages = $voyageRepository->findOneBy(array('id' => $id));  
    
    
    return $voyages;
  }
// on recuper un voyage par id de condicteur
  public static function getVoyagesByUser($id) {
    $em = dbconnection::getInstance()->getEntityManager();
    $voyageRepository = $em->getRepository('voyage');
    $voyages = $voyageRepository->findBy(array('conducteur' => $id));
    return $voyages;
  }


// réduire le nombre de places 
  public static function updateNbplaces($voyage){
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
        $query = $em->prepare("select nbplace from jabaianb.voyage where id =".$voyage.";");
        $bool = $query->execute();
        $res = $query->fetchAll();
        $a = $res[0]["nbplace"];
        if ($a <=0 ){
            return 0;

        }
        $query = $em->prepare("update jabaianb.voyage set nbplace = (nbplace-1) where id =".$voyage." and nbplace>0;");
        $bool = $query->execute();
        return 1;
    }

// le prof il a dit que l'utilisateur c'est lui meme un conducteur qui peut proposer un voyage
// methode pour proposer un voyage

  public static function nouveauVoyage($depart, $arrivee, $heuredepart, $nbplace, $tarifparkm, $contraintes, $user)
  {
    $em = dbconnection::getInstance()->getEntityManager() ;
    $voyageRepository = $em->getRepository('voyage');
    $trajet = trajetTable::getTrajet($depart,$arrivee);
    // calcule de tarif de voyage par Km
    $tarif = $tarifparkm * $trajet->distance;
    if($trajet && $user && $tarif>0){
      $voyage = new voyage();
      $voyage->trajet = $trajet;
      $voyage->conducteur = $user;
      $voyage->nbplace = $nbplace;
      $voyage->heuredepart = $heuredepart;
      $voyage->tarif = $tarif;
      // trim pour les espaces 
      $voyage->contraintes = trim($contraintes);
      $em->persist($voyage);
      $em->flush(); 
      return $voyage;
    }
    return null;
  }



}

?>