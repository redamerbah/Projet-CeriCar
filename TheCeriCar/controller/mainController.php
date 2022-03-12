<?php

class mainController
{

	// --------- etape 1 ----------------
	// afficher hello word sur qur l'action helloword
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";

		return context::SUCCESS;
	}

	// comprendre context et request comment ca marche (url)
	public static function superTest($request,$context)
	{
		if(!empty($_GET['var1'] && !empty($_GET['var2']))){

		$context->var1=$_GET['var1'];
		$context->var2=$_GET['var2'];
		return context::SUCCESS ;

		}

		else{

		return context::ERROR ;
		}
		
	}


	// ----------------------  étape 2   -----------------------------
// methode afficher un utilisateur par son id
public static function getUserById($request,$context)
	
{
		$context->user=utilisateurTable::getUserById(1);

		
			return context::SUCCESS;
}
// methode afficher une reservation par id de voyage
public static function getReservationsByVoyage($request,$context)
	{
		

		$context->reservations=reservationTable::getReservationsByVoyage(1);
		return context::SUCCESS;
	}
// methode afficher un voyage par id de trajet
	public static function getVoyagesByTrajet($request,$context)
	{
		

		$context->voyages=voyageTable::getVoyagesByTrajet(383);
			return context::SUCCESS;
	}
// methode afficher un trajet avec une ville dep et ville arr

	public static function getTrajet($request,$context)
	{

		if(!isset($request["villeDepart"]))
		{
			$context->error="erreur ville depart";
			return context::ERROR;
		}
		if(!isset($request["villeArrivee"]))
		{
			$context->error="erreur ville arrivee";
			return context::ERROR;
		}

		$context->voyages=voyageTable::getVoyagesByTrajet(
			trajetTable::getTrajet($request["villeDepart"],$request["villeArrivee"])
		);
			return context::SUCCESS;
		

		 //$context->trajet=trajetTable::getTrajet("Dijon","Brest");
			//return context::SUCCESS;
	}

	


/*
	 public static function Test($request,$context) 
 {

    $context->trajet=trajetTable::getTrajet("Dijon","Brest");
    $context->voyage=voyageTable::getVoyagesByTrajet(383);
    $context->utilisateur=utilisateurTable::getUserById(1);
    $context->reservation=reservationTable::getReservationsByVoyage(1);

    
    return context::SUCCESS;
    
  }*/

// affichier les détailles de recherche quand on click sur le bouton
public static function afficherVoyage($request,$context){
		
		
		$context->voyages = new ArrayObject();
		foreach($request['voyage'] as $voy){
			$voyage = voyageTable::getVoyageById($voy);
			$context->voyages->append($voyage);

		}
		$context->depart=$request['depart'];
		$context->arrivee=$request['arrivee'];
		$context->distance=$request['distance'];
		$context->tarif=$request['tarif'];
		$context->heureDepart=$request['heureDepart'];
		$context->heureArrivee=$request['heureArrivee'];
		$context->contraintes=$request['contraintes'];
		$context->conducteurs = new ArrayObject();
		foreach($request['conducteur'] as $con){
			$conducteur = utilisateurTable::getUserById($con);
			$context->conducteurs->append($conducteur);

		}

		return context::SUCCESS;
	}
  


// action pour chercher un voyage 
public static function rechercheVoyage($request,$context)
	{
		
		if(key_exists("depart",$request) && key_exists("arrivee",$request)){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);
			if($context->voyages ) return context::SUCCESS;
			return context::ERROR;
		}
		
		return context::SUCCESS;
	}

	

// action par defaut
	public static function index($request,$context){
		
		return context::SUCCESS;
	}

//  action pour inclure un navbar en layout 
	public static function header($request,$context)
	{
		return context::SUCCESS;
	}

// methode pour se déconnecté
public static function logout($request, $context){
		
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_prenom"]);
		header('location: monApplication.php'); 
	}

// methode pour se connecter
public static function login($request,$context)
	{
		if(key_exists("identifiant",$request) && key_exists("password",$request)){
			// pseudo
			$context->identifiant =  $request['identifiant'];
			// mot de passe 
			$context->password =  $request['password'];
			$user = utilisateurTable::getUserByLoginAndPass($context->identifiant, $context->password);
			if($user){
				unset($_SESSION["user_id"]);
				unset($_SESSION["user_prenom"]);
				$context->setSessionAttribute('user_id',$user->id);
				$context->setSessionAttribute('user_prenom',$user->prenom);
				 
				
				return context::SUCCESS;
			}
			else{
				$context->errorMSG = "Pseudo ou mot de passe est incorrect";
				return context::ERROR;
			}
		}
		return context::SUCCESS;
	}	


//    methode pour s'inscrire

public static function register($request,$context)
	{
		// si la session user est set, faire une redirection vers index
		if(isset($_SESSION['user_prenom']))
		{
			return context::NONE;
		}

		if(key_exists("nom",$request) && key_exists("prenom",$request) && key_exists("dateOfBirth",$request) && key_exists("identifiant",$request) && key_exists("password",$request)){
			// nom
			$context->nom = $request['nom'];
			// prenom
			$context->prenom =  $request['prenom'];
			// date de naissance
			$context->dathofbirth =  $request['dateOfBirth'];
			// pseudo
			$context->identifiant =  $request['identifiant'];
			// mot de passe
			$context->password =  $request['password'];
			// verification si le meme pseudo 
			if(utilisateurTable::getUserByLogin($request['identifiant'])){
				$context->errorMSG = "pseudo est déja utilisé";
				return context::ERROR;
			}
			else{																						
				$user = utilisateurTable::addUser($context->nom, $context->prenom, $context->identifiant, $context->password);
				$context->success = true;																 		
			}
		} 
		return context::SUCCESS;
	
	}	
	
	


// methode pour afficher les reservations

    public static function mesReservations($request,$context) {

		$utilisateur = utilisateurTable::getUserById($_SESSION["user_id"]);
		$context->allReservations = reservationTable::getReservationsByVoyageur($utilisateur->id);
		$voyageData = array();
		foreach($context->allReservations  as $reservation){
			
			array_push($voyageData, new voyageData($reservation->voyage));
		}
		$context->voyages = $voyageData;
		return context::SUCCESS;

	}

// la reservation d'un voyage
	public static function reserverVoyage($request,$context){
		// debug 
		/*foreach ($request['voyage'] as $voyage){

		
		?>
		<script type="text/javascript">
			console.log('<?php echo $voyage; ?>');
		</script>

		<?php }*/
		?>
		
		<script type="text/javascript">
			console.log('<?php echo $context->getSessionAttribute('user_id'); ?>');
		</script>

		<?php 

		 $voyageur = $request['voyageur'];
		 if($context->getSessionAttribute('user_id')){
        $cmd = voyageTable::updateNbplaces($request['voyage'][0]);
        if ($cmd  == 0){
            return context::ERROR;
        }
        else{
            $res = reservationTable::addReservation(voyageTable::getVoyageById($request['voyage'][0]), utilisateurTable::getUserById($voyageur));
            return context::SUCCESS;
        }
    }
    else{
        return context::ERROR;
    }}



// rechercher une voyage direct et avec correspendance 
public static function ajaxRechercheVoyage($request,$context){
	   // test si les villes de dep et d'arr sont récupré
		if($request['depart'] != null && $request['arrivee'] != null){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			if($trajet){
					
					//Recuperer les voyages direct et par correspendance
					$Correspendances = voyageTable::getCorrespondance($request['depart'], $request['arrivee'],$request['nbrvoyageurs']);

					//voyages
					$context->listvoyages = new ArrayObject();

					//voyages par correspendance
					$context->voyagesCorrespendance =  new ArrayObject();

					//conducteurs
					$context->conducteurs = new ArrayObject();

					//heure d'arrivée
					$context->heurearrivee = new ArrayObject();

					for($i=0;$i<count($Correspendances);$i++){

							$voyage =voyageTable::getVoyageById($Correspendances[$i]['id']);
							$context->voyagesCorrespendance->append($voyage);
							$context->conducteurs[$voyage->id] = array(utilisateurTable::getUserById($voyage->conducteur->id)); 
							$context->listvoyages[$voyage->id] = array($voyage);
							
							$heure=explode('.',$voyage->trajet->distance/100);
						
							$context->heurearrivee[$voyage->id] = $voyage->heuredepart+$heure[0];
					
					}
					
					
					if($context->voyagesCorrespendance ){
						return context::SUCCESS;
					}
					else{
						$context->ERROR = "Aucun voyage trouvé";
						return context::ERROR;
					}
					
				
				
			}
			else{
			$context->ERROR = "Aucun trajet trouvé";
			return context::ERROR;
			}
		}
		$context->ERROR = "veulliez saisis depart ou arrvée !";
		return context::ERROR;
	}


// un nouveau Voyage e
	public static function newVoyagePost($request, $context){
		$context->success = "false";
		if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		else {
			$context->error = " non connecté";
			return context::ERROR;
		}


		// test si les information sont récupré
		if(key_exists("depart",$request) && key_exists("tarifparkm",$request) && key_exists("arrivee",$request) && key_exists("heuredepart",$request) && key_exists("nbplace",$request) && key_exists("contraintes",$request)){

			$context->tarifparkm = $request['tarifparkm'];
			$context->depart = $request['depart'];
			$context->arrivee = $request['arrivee'];
			$context->heuredepart = $request['heuredepart'];
			$context->nbplace = $request['nbplace'];
			$context->contraintes = $request['contraintes'];
			if($request['depart']==$request['arrivee']){
				$context->error = "ville de depart doit etre differente de celle d'arrivée";
				return context::ERROR;
			}
			// test pour le tarif il doit > 0
			if($context->tarifparkm<=0){
				$context->error = "Le tarif doit etre superieure à 0";
				return context::ERROR;	
			}
			// test pour le nb de place doit etre > 0 
			if($context->nbplace<=0){
				$context->error = "Le nombre de places doit etre superieure à 0";
				return context::ERROR;	
			}
			// test pour format d'heur inférieur ou égal 23h00
			if($context->heuredepart>23 || $context->heuredepart <0){
				$context->error = "choisire une format d'heur inférieur ou égal 23h00";
				return context::ERROR;	
			}
			else{

				$context->voyage = voyageTable::nouveauVoyage($context->depart, $context->arrivee, $context->heuredepart,$context->nbplace, $context->tarifparkm, $context->contraintes, $context->user);

				if(!$context->voyage){
					$context->error = "ERREUR: Le voyage n'est pas ajouté";
					return context::ERROR;	
				}
				$context->success = "daaz";
				return context::SUCCESS;
			}

		}
		$context->error = "il faut remplir tout les informations de votre voyage";
		return context::ERROR;
	}

// Afficher la vue d'ajout d'un nouveau voyage par un conducteur connecté 
	public static function newVoyage($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) {
			$context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		}
		else 
			return context::ERROR;
		$context->villes = trajetTable::getVilles();
		return context::SUCCESS;
	}

//methode pour Retourner les voyages d'un utilisateur 
	public static function mesVoyages($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		else return context::ERROR;
		$voyagesData = array();
		$voyages = voyageTable::getVoyagesByUser($context->user->id);
		foreach($voyages as $voyage){
			array_push($voyagesData, new voyageData($voyage));
		}
		$context->voyagesData = $voyagesData;
		return context::SUCCESS;
	}





}