<nav class="navbar navbar-expand-sm  navbar-dark bg-dark">
      <a class="navbar-brand" href="monApplication.php">CERICAR</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="monApplication.php?action=rechercheVoyage" >Rechercher un trajet </a>
          </li>
    </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php if(!isset($_SESSION["user_id"]) ) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="monApplication.php?action=login">login</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="monApplication.php?action=register">sing up</a>
      </li>
     <?php } else{?>
      <li class="nav-item active">
        <a id="affichermesVoyages" class="nav-link" href="monApplication.php?action=mesVoyages">Travels</a>
      </li>
      <li class="nav-item active">
        <a id="affichermesReservations" class="nav-link" href="monApplication.php?action=mesReservations">Reservations</a>
      </li>
      <li class="nav-item active">
     <a id="utilisateur-id" class="nav-link" data-id= "<?php echo  $context->getSessionAttribute('user_id') ?>"><?php echo  $context->getSessionAttribute('user_prenom') ?></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="monApplication.php?action=logout">logout</a>
      </li>
     <?php } ?>
    </ul>
      </div>
    </nav>





    

