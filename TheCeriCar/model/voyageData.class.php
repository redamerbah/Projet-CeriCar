<?php
class VoyageData{


    // variables
    public $departFormat;
    public $arriveeFormat;
    public $voyage;
    public $dureeFormat;
    public $placeDisponible;
    public $reservations;
    public $arriveeHeure;
    public $arriveeMinute;
    public $placeReserve;
    // constructeur pour afficher le détail d'un voyage 
    public function __construct($voyage){
        $this->voyage = $voyage;
        // heure départ 
        $this->departFormat = (($voyage->heuredepart >= 10)?$voyage->heuredepart:"0".$voyage->heuredepart).":00";
        // heure arrivee
        $this->arriveeHeure = (intdiv ($this->voyage->trajet->distance , 60) + $voyage->heuredepart)%24;
        $this->arriveeMinute = $this->voyage->trajet->distance % 60;
        $heureFormat = ($this->arriveeHeure>=10)?$this->arriveeHeure:"0".$this->arriveeHeure;
        $minuteFormat = ($this->arriveeMinute>=10)?$this->arriveeMinute:"0".$this->arriveeMinute;
        $this->arriveeFormat = "$heureFormat:$minuteFormat";
        $this->reservations = reservationTable::getReservationByVoyage($voyage->id);
        $this->placeReserve = $voyage->nbplace - $this->placeDisponible;
        $dureeHeure = intdiv($this->voyage->trajet->distance , 60);
        $dureeMinute = $this->voyage->trajet->distance % 60;
        $this->dureeFormat = $dureeHeure."h".$dureeMinute;
        
    }
}
?>