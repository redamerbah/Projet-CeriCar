<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <!-- bootstrap style -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    
    <!-- w3schools style-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/utils.css"> 

    <!-- ajax -->
    <script src="js/layout.js" type="text/javascript"></script>
    <script src="js/rechercheVoyage.js" type="text/javascript" ></script>
    <script type="text/javascript" src="js/login.js"></script> 
   <!-- <script type="text/javascript" src="js/reservation.js"></script>-->
    <script type="text/javascript" src="js/newVoyage.js"></script> 
    <script type="text/javascript" src="js/mesVoyage.js"></script>
    <script type="text/javascript" src="js/afficherVoyage.js"></script>

    

    <title>
        monApp 
    </title>

</head>

<body>

    <!--header -->
    <header id="header">
      <?php include($nameApp."/view/headerSuccess.php"); ?>
    </header>

    <div id="page">
      <?php if($context->error): ?>
        <div id="flash_error" class="error">
            
        </div>
      
      <?php endif; ?>
      <div>
     
      </div>
      <div id="page_maincontent">   

        <?php include($template_view); ?>
      
      </div>
    </div>
      

  </body>

      <!-- bandeau -->
        <div id="bandeau">
            <?php
        if($context->error)
          echo 'Erreur ->  '  . $context->error;
        else
          echo 'action :  '. $action;
        ?>
            <div id="fermer">&#10006;</div>
        </div>
    </div>
</body>

</html>