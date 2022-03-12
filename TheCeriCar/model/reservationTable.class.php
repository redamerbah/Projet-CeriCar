<?php

require_once "reservation.class.php";

class reservationTable {


// methode pour ajouter une reservation 
  public static function addReservation($voyage, $voyageur){
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservation = new reservation();
        $reservation->voyage = $voyage;
        $reservation->voyageur = $voyageur;
        $reservationInstance = $em->persist($reservation);
        $em->flush();
       
        return $reservationInstance;
       // echo $reservationInstance;
       //$query = $em->prepare(" update  ");
  }



  // rechercher une reservation by voyage 
 public static function getReservationByVoyage($voyage)
  {
    $em = dbconnection::getInstance()->getEntityManager() ;
  
    $reservationRepository = $em->getRepository('reservation');
    $reservation = $reservationRepository->findBy(array('voyage' => $voyage));  
  
    return $reservation;
    //echo $reservation 

  }

// rechercher une reservation by voyageur
  public static function getReservationsByVoyageur($voyageur)
  {
    $em = dbconnection::getInstance()->getEntityManager() ;
  
    $reservationRepository = $em->getRepository('reservation');
    $reservation = $reservationRepository->findBy(array('voyageur' => $voyageur));  
  
    return $reservation;

  }
 
}


?>
